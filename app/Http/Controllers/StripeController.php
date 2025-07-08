<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\Item;
use App\Models\Category;
use App\Models\Game;
use App\Models\Attribute;
use App\Models\BuyerRequest;
use App\Models\User;
use App\Models\RequestOffer;
use App\Models\BuyerRequestConversation;
use App\Events\GroupServiceSellerEvent;
use App\Models\ItemAttribute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\BoostingOfferNotification;
use Illuminate\Support\Facades\Notification;
use Stripe\Checkout\Session as CheckoutSession;
use Carbon\Carbon;

class StripeController extends Controller
{
    public function create(Request $request)
    {
        if(auth()->user()->role == 'admin') {
            return redirect()->back()->with('error', 'You can\'t perform this action.');
        }
        
        $amountInCents = (int) round($request->total_price * 100); // 65.543 → 6554

        
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $request->input('product_name'),
                    ],
                    'unit_amount' => $amountInCents,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}', // important!
            'cancel_url' => route('stripe.cancel'),
            'metadata' => [
                // 'order_id' => $request->order_id,
                // 'conversation_id' => $request->conversation_id,
                'offer_id' => $request->offer_id,
                'item_id' => $request->item_id,
                'total_price' => $request->total_price,
                'quantity' => $request->quantity,
                'discountPercentage' => $request->discountPercentage,
                'product_name' => $request->product_name,
                'delivery_type' => $request->delivery_type,
                'payment_method' => $request->payment_method,
                'payment_fees' => $request->payment_fees,
                'price' => $request->price,
                'user_id' => auth()->id(),
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        // dd($request->all());
        Stripe::setApiKey(config('services.stripe.secret'));

        $session_id = $request->get('session_id');  

        if (!$session_id) {
            return redirect()->route('home')->with('error', 'No session ID found.');
        }

        $session = CheckoutSession::retrieve($session_id);

        $order = $this->createOrder($session->metadata);

        // Access the metadata
            // $order_id = $session->metadata->order_id;
            // $conversation_id = $session->metadata->conversation_id;
            // $user_id = $session->metadata->user_id;

            // $order = Order::with('buyer', 'item.seller', 'offer.user', 'item.categoryGame.game', 'item.categoryGame.category', 'offer.buyerRequest.service.categoryGame.game', 'offer.buyerRequest.service.categoryGame.category')->find($order_id);

            // if($order->item_id == null){
            //     $seller = $order->offer->user;
            //     $categoryGame = $order->offer->buyerRequest->service->categoryGame;
            // }else {
            //     $seller = $order->item->seller;
            //     $categoryGame = $order->item->categoryGame;
            // }

            // $data = [
            //     'title' => 'New Order',
            //     'data1' => $categoryGame->game->name.' - '.$categoryGame->category->name,
            //     'data2' => 'Buyer: '.$order->buyer->name,
            //     'link' => url('order/' . $order->order_id),
            // ];

            // Notification::send($seller, new BoostingOfferNotification($data));

            // if($order->item_id != null && $order->item->delivery_method == 'automatic'){
            //     $order->update(['payment_status' => 'paid', 'order_status' => 'received']);
            // }else {
            //     $order->update(['payment_status' => 'paid', 'created_at' => Carbon::now()]);
            // }
        /////////////////////
        
        if($order->order_id){
            return redirect()->route('order-detail', ['order_id' => $order->order_id])->with('success', 'Payment successful!');
        }else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function createOrder($request) 
    {
        
        // dd($request);
        if($request->item_id){
            $item = Item::with('categoryGame','seller')->find($request->item_id);
            $categoryGameId = $item->category_game_id;
            $seller_id = $item->seller_id;
            $account_id = null;

            if($item->account_info != null) {
                foreach($item->account_info as $info) {
                    if($info['sold'] === 'no') {
                        $account_id = $info['id'];
                        break;
                    }
                }
            }

        }else {
            $offer = RequestOffer::with('buyerRequest.service.categoryGame','user')->find($request->offer_id);
            $categoryGameId = $offer->buyerRequest->service->categoryGame->id;
            $seller_id = $offer->user_id;
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'order_id'           => Str::uuid()->toString(),
                'item_id'            => $request->item_id ?? null,
                'request_offer_id'   => $request->offer_id ?? null,
                'category_game_id'   => $categoryGameId,
                'buyer_id'           => Auth::id(),
                'seller_id'          => $seller_id,
                'title'              => $request->product_name,
                'quantity'           => $request->quantity,
                'price'              => $request->price,
                'account_id'         => $account_id,
                'discount_in_per'    => $request->discountPercentage ?? 0,
                'payment_fees'       => $request->payment_fees ?? 0,
                'total_price'        => $request->total_price,
                'payment_method'     => $request->payment_method,
                'order_status'       => ($request->item_id && $item->delivery_method == 'automatic') ? 'received' : 'pending delivery',
                'payment_status'     => 'paid',
                'delivery_type'      => $request->delivery_type ?? null,
            ]);


            // Creating conversation
            if($request->offer_id){
                $buyerRequest = BuyerRequest::find($offer->buyer_request_id);

                $buyerRequest->update([
                    'seller_id' => $seller_id,
                    'status' => 'closed',
                ]);

                $offer = RequestOffer::with([
                    'buyerRequest.buyerRequestConversation' => function ($query) use ($offer) {
                            $query->where('seller_id', $offer->user_id)
                                ->where('buyer_id', $offer->buyerRequest->user_id);
                        }
                    ])->find($request->offer_id);

                $conversation = $offer->buyerRequest->buyerRequestConversation->first();

                if($conversation == null){
                    $conversation = BuyerRequestConversation::create([
                        'buyer_request_id' => $offer->buyerRequest->id,
                        'order_id' => $order->id,
                        'buyer_id' => $offer->buyerRequest->user_id,
                        'seller_id' => $offer->user_id
                    ]);
                }else {
                    $conversation->update([
                        'order_id' => $order->id,
                    ]);
                }
                
            }else {
                $item = Item::find($request->item_id);
                $conversation = BuyerRequestConversation::create([
                    'order_id' => $order->id,
                    'buyer_id' => Auth::id(),
                    'seller_id' => $item->seller_id
                ]);
            }

            if($request->item_id == null){
                $seller = $offer->user;
                $categoryGame = $offer->buyerRequest->service->categoryGame;

                broadcast(new GroupServiceSellerEvent('closed', $offer->buyerRequest->service_id));
            }else {
                $seller = $item->seller;
                $categoryGame = $item->categoryGame;
                $pause = 0;

                if($item->categoryGame->category_id != 2 || ($item->categoryGame->category_id == 2 && $item->delivery_method == 'manual')) {
                    $available_quantity = (float) $item->quantity_available - (float) $request->quantity;
                    
                    if ($available_quantity == 0) {
                        $pause = 1;
                    }

                    $item->update([
                        'quantity_available'    => $available_quantity,
                        'pause'                 => $pause,
                    ]);
                }elseif ($account_id != null) {
                    $available_quantity = (int) $item->quantity_available - 1;
                    $accountInfo = $item->account_info;

                    if ($available_quantity == 0) {
                        $pause = 1;
                    }
                    
                    if (isset($accountInfo[$account_id])) {
                        $accountInfo[$account_id]['sold'] = 'yes';

                        $item->update([
                            'quantity_available' => $available_quantity,
                            'account_info' => $accountInfo,
                            'pause'                 => $pause,
                        ]);
                    }
                }

            }

            $admins = User::where('role','admin')->get();
            
            $data = [
                'title'     => 'New Order',
                'data1'     => $categoryGame->game->name.' - '.$categoryGame->category->name,
                'data2'     => 'Buyer: '.auth()->user()->username,
                'link'      => url('order/' . $order->order_id),
                'game_id'   => $categoryGame->game_id,
                'admin'     => '0',
            ];

            $data1 = [
                'title'     => 'New Order',
                'data1'     => $categoryGame->game->name.' - '.$categoryGame->category->name,
                'data2'     => 'Buyer: '.auth()->user()->username,
                'link'      => url('order/' . $order->order_id),
                'game_id'   => $categoryGame->game_id,
                'admin'     => '1',
            ];

            Notification::send($seller, new BoostingOfferNotification($data));

            // Notification::send($admins, new BoostingOfferNotification($data1));

            DB::commit();
            return $order;

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to place your order. Please try again.');
        }
    }

    /**
     * Handle canceled payment redirect
     */
    public function cancel()
    {
        return redirect()->back()->with('error','Something went wrong! payment was unsuccessful.');

    }
}
    