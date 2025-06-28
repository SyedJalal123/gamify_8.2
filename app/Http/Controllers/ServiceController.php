<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Attribute;
use App\Models\BuyerRequest;
use App\Models\Seller;
use App\Models\Service;
use App\Models\RequestOffer;
use App\Models\User;
use App\Models\CategoryGame;
use App\Events\GroupServiceSellerEvent;
use App\Models\BuyerRequestAttribute;
use App\Notifications\BoostingOfferUpdate;
use App\Notifications\BoostingRequestNotification;
use App\Notifications\BoostingOfferNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function store(Request $request) {

        if(auth()->user()->role == 'admin') {
            return redirect()->back()->with('error', 'You can\'t perform this action.');
        }

        // dd($request->all());
        try {
            // Validate the input
            $request->validate([
                'service_id' => 'required',
            ]);

            DB::beginTransaction(); // Start transaction
    
            // Save item
            $buyerRequest = BuyerRequest::create([
                'request_id'        => Str::uuid()->toString(),
                'service_id'        => $request->service_id,
                'user_id'           => Auth::id(),
                'description'       => $request->description,
                'expires_at'        => Carbon::now()->addDays(20),
            ]);
    
            // Save attributes
            $attributes = [];
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'attribute_') && $value != null) {
                    $attributeId = str_replace('attribute_', '', $key);
                    $attributes[] = [
                        'buyer_request_id' => $buyerRequest->id,
                        'attribute_id' => $attributeId,
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            if (!empty($attributes)) {
                BuyerRequestAttribute::insert($attributes);
            }
    
            DB::commit(); // All done safely!
            
            // Notify all the realted sellers
            $boostingOffer = BuyerRequest::where('id', $buyerRequest->id)->with('service.categoryGame.game','user','attributes')->first();

            $serviceId = $boostingOffer->service_id;

            $sellers = Seller::whereHas('user.services', function ($query) use ($serviceId) {
                $query->where('services.id', $serviceId);
            })->with('user')->get();
            
            $users = $sellers->pluck('user')->filter(function ($user) {
                return $user->id !== Auth::id(); // Exclude the current authenticated user
            });

            $data = [
                'title' => $boostingOffer->service->categoryGame->game->name.' ('.$boostingOffer->service->name.')',
                'data1' => $boostingOffer->attributes[0]->pivot->value,
                'data2' => $boostingOffer->attributes[1]->pivot->value,
                'link' => url('boosting-request/' . $boostingOffer->id),
                'id' => $boostingOffer->id,
                'game_id' => $boostingOffer->service->categoryGame->game_id,
            ];

            Notification::send($users, new BoostingRequestNotification($data));


            return redirect('boosting-request/'.$buyerRequest->id);
            return redirect()->back()->with('success', 'Offer created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create_offer(Request $request) {
        // dd($request->all());

        if(auth()->user()->role == 'admin') {
            return redirect()->back()->with('error', 'You can\'t perform this action.');
        }

        $request->validate([
            'buyer_request_id' => 'required|exists:buyer_requests,id',
            'price'            => 'required|numeric|min:1',
            'delivery_time'    => 'required|string',
        ]);

        RequestOffer::create([
            'buyer_request_id' => $request->buyer_request_id,
            'price'            => $request->price,
            'delivery_time'    => $request->delivery_time,
            'user_id'          => auth()->id(),
        ]);
        
        $boostingOffer = BuyerRequest::where('id', $request->buyer_request_id)->with('service.categoryGame.game','user','attributes','requestOffers.user')->first();

        $data = [
            'title'     => 'New Boosting Offer',
            'data1'     => $boostingOffer->service->categoryGame->game->name.' - '.$boostingOffer->service->name,
            'data2'     => '$'.$request->price,
            'link'      => url('boosting-request/' . $boostingOffer->id),
            'game_id'   => $boostingOffer->service->categoryGame->game_id,
        ];

        $user = User::where('id', $boostingOffer->user_id)->first();
        $service_id = $boostingOffer->service_id;

        $other_users = User::whereHas('services', function ($query) use ($service_id) {
            $query->where('services.id', $service_id);
        })->whereNotIn('id', [$boostingOffer->user_id, auth()->user()->id])->get();


        Notification::send($user, new BoostingOfferNotification($data));

        broadcast(new GroupServiceSellerEvent('update', $service_id));
        // if($other_users)
        // Notification::send($other_users, new BoostingOfferUpdate($data));

        return redirect()->back();
    }

    public function boostingRequest(Request $request = null, $id){
        $buyerRequest = BuyerRequest::with([
            'service.categoryGame.game',
            'attributes',
            'requestOffers.user',
            'requestOffers.order',
            'buyerRequestConversation' => function ($query) {
                $query->with(['buyer', 'seller', 'messages.sender','messages.reciever', 'order.categoryGame.category', 'buyerRequest.service']);
            },
        ])->find($id);

        // Sort the conversations manually
        $buyerRequest->buyerRequestConversation = $buyerRequest->buyerRequestConversation->sortByDesc(function ($conversation) {
            $latestMessage = $conversation->messages->sortByDesc('created_at')->first();
            return $latestMessage ? $latestMessage->created_at : $conversation->created_at;
        })->values(); // Reset keys
        
        if($buyerRequest->user_id !== auth()->user()->id){
            $identity = 'seller';
        }else {
            $identity = 'buyer';
        }
        

        if ($request->ajax()) {
            return view('frontend.offers-live-feed', compact('buyerRequest'))->render();
        }

        return view('frontend.boosting-request', compact('buyerRequest','identity'));
    }

    public function cancelRequest(Request $request) {
        $buyerRequest = BuyerRequest::find($request->id);
        $serviceId = $buyerRequest->service_id;

        $buyerRequest->update([
            'status' => 'cancelled',
        ]);

        $fakeAjaxRequest = Request::create(
            url('cancel-request'),
            'GET',
            ['id' => $request->id],
            [],
            [],
            ['HTTP_X-Requested-With' => 'XMLHttpRequest'] // <- AJAX header
        );
        

        broadcast(new GroupServiceSellerEvent('cancelled', $serviceId));

        $data = $this->boostingRequest($fakeAjaxRequest, $request->id);

        return $data;
    }

    public function getServiceAttributes(Request $request){
        $serviceId = $request->service_id;
        $service = Service::where('id',$serviceId)->with('attributes')->first();

        return $service;
    }
}
