<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\CategoryGame;
use App\Models\Game;
use App\Models\Category;
use App\Models\BuyerRequest;
use App\Models\EmailNotifications;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\BuyerRequestConversation;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Pagination\LengthAwarePaginator;

class SellerDashboardController extends Controller
{
    public function orderDetail($order_id, Request $request) 
    {
        $order = Order::where('order_id', $order_id)->with('item.attributes', 'item.seller', 'item.categoryGame.game', 'item.categoryGame.attributes', 'chat.buyerRequest.service', 'offer', 'offer.buyerRequest.service.categoryGame', 'offer.buyerRequest.attributes', 'offer.conversation', 'offer.user')->firstOrFail();
        $conversation = $order->chat;
        $categoryGame = $order->categoryGame;
        
        $item = null; $offer = null;

        if($order->item_id == null){
            $offer = $order->offer;
            $maxDeliveryTime = $order->offer->delivery_time;
        }else {
            $item = $order->item;
            $maxDeliveryTime = $order->item->delivery_time;
        }
        
        if(auth()->user()->role == 'admin'){
            $identity = 'admin';
        }else if($conversation->seller_id == auth()->user()->id){
            $identity = 'seller';
        }elseif($conversation->buyer_id == auth()->user()->id) {
            $identity = 'buyer';
        }else {
            $identity = 'unknown';
        }
        
        if($identity == 'unknown'){
            return redirect('/')->with('error', 'You are not authorized to perform this action.');
        }else {
            return view('frontend.order-detail', compact('order', 'item', 'offer', 'categoryGame', 'identity', 'conversation', 'maxDeliveryTime'));
        }
    }

    public function saveReview(Request $request) 
    {
        // dd($request->all());
        $order = Order::find($request->order_id);
        
        $order->update([
            'feedback' => $request->feedback,
            'feedback_comment' => $request->feedback_comment ?? 'GGWP!',
            'feedback_at' => now(),
        ]);

        return redirect()->back();
    }

    public function orders(Request $request, $tag) {

        if($tag == 'purchased'){
            $orders = Order::where('buyer_id', auth()->user()->id)->with('categoryGame.game', 'categoryGame.category', 'buyer', 'seller');
        }else {
            $orders = Order::where('seller_id', auth()->user()->id)->with('categoryGame.game', 'categoryGame.category', 'buyer', 'seller');
        } 

        if($request->ajax()){

            $filterStatus = $request->filterStatus ?? null;
            $filterDuration = $request->filterDuration ?? null;
            $filterDuration = $request->filterDuration ?? null;

            if($filterStatus != null) {

                if($filterStatus == 'received' || $filterStatus == 'completed' || $filterStatus == 'cancelled') {
                    $orders->where('order_status', $filterStatus);
                }
                elseif($filterStatus == 'disputed') {
                    $orders->where('disputed', '1')->whereIn('order_status', ['pending delivery', 'delivered']);
                }
                elseif($filterStatus == 'delivered' || $filterStatus == 'pending delivery') {
                    $orders->where('order_status', $filterStatus)->where('disputed', '0');
                }

            }

            if($filterDuration != null) {
                $orders->where('created_at', '<', Carbon::now()->subMonths(3));
            }else {
                $orders->where('created_at', '>=', Carbon::now()->subMonths(3));
            }

            return DataTables::eloquent($orders)
            ->addColumn('title_data', function($order) {
                return '
                <div class="d-flex flex-row">
                    <img class="mr-3" style="width:36px;max-height:36px;" src="'.asset($order->categoryGame->game->image).'" alt="">
                    <div class="d-flex flex-column">
                        <div class="text-theme-secondary fs-13 lh-1_3">'.$order->categoryGame->game->name.'</div>
                        <div class="three-line-ellipsis fs-14 lh-1_3" style="max-width:225px;">'.$order->title.'</div>
                    </div>
                </div>
                ';
            })
            ->addColumn('created_at_data', function($order) {
                return Carbon::parse($order->created_at)->format('M d,Y, h:i A');
            })
            ->addColumn('price', function($order) {
                return '$'.number_format($order->total_price, 2);
            })
            ->addColumn('order_status', function($order) {
                if($order->order_status == 'completed') {
                    $order_pill_class = 'btn-theme-pill-green';
                    $order_status = $order->order_status;
                }
                elseif($order->order_status == 'received' || $order->order_status == 'delivered') 
                {
                    $order_pill_class = 'btn-theme-pill-blue';
                    $order_status = $order->order_status;
                }
                elseif($order->order_status == 'cancelled') 
                {
                    $order_pill_class = 'btn-theme-pill-red';
                    $order_status = $order->order_status;
                }
                elseif($order->disputed == 1) 
                {
                    $order_pill_class = 'btn-theme-pill-red';
                    $order_status = 'disputed';
                }
                elseif($order->order_status == 'pending delivery')
                {
                    $order_pill_class = 'btn-theme-pill-yellow';
                    $order_status = "Pending&nbsp;delivery";
                } 
                else
                {
                    $order_pill_class = 'btn-theme-pill-default';
                    $order_status = $order->order_status;
                }
                return '
                <span class="'.$order_pill_class.' br-6 p-1 text-capitalize">'.$order_status.'</span>
                ';
            })
            ->addColumn('quantity', function ($order) {
                return $order->quantity .' '. $order->categoryGame->currency_type;
            })
            ->addColumn('mobile_summary', function ($order) {
                if($order->order_status == 'completed') {
                    $order_pill_class = 'btn-theme-pill-green';
                    $order_status = $order->order_status;
                }
                elseif($order->order_status == 'received' || $order->order_status == 'delivered') 
                {
                    $order_pill_class = 'btn-theme-pill-blue';
                    $order_status = $order->order_status;
                }
                elseif($order->order_status == 'cancelled') 
                {
                    $order_pill_class = 'btn-theme-pill-red';
                    $order_status = $order->order_status;
                }
                elseif($order->disputed == 1) 
                {
                    $order_pill_class = 'btn-theme-pill-red';
                    $order_status = 'disputed';
                }
                elseif($order->order_status == 'pending delivery')
                {
                    $order_pill_class = 'btn-theme-pill-yellow';
                    $order_status = "Pending&nbsp;delivery";
                } 
                else
                {
                    $order_pill_class = 'btn-theme-pill-default';
                    $order_status = $order->order_status;
                }
                return '
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center mb-2">
                        <img class="mr-3" style="width:36px;max-height:36px;" src="'.asset($order->categoryGame->game->image).'" alt="">
                        <div class="d-flex flex-column">
                            <div class="three-line-ellipsis fs-14 lh-1_3">'.$order->title.'</div>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="'.$order_pill_class.' br-6 px-1 py-0 text-capitalize">'.$order_status.'</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Type</div>
                        <div>'.$order->categoryGame->category->name.'</div>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Buyer</div>
                        <div>'.$order->buyer->username.'</div>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Ordered date</div>
                        <div>'.Carbon::parse($order->created_at)->format('M d,Y, h:i A').'</div>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Price($)</div>
                        <div>$'.$order->total_price.'</div>
                    </div>
                </div>
                ';
            })
            ->addColumn('row_url', function ($order) {
                return route('order-detail', $order->order_id);
            })
            ->rawColumns(['title_data', 'order_status', 'mobile_summary', 'row_url'])
            ->make(true);
        }

        $orders = $orders;

        return view('frontend.dashboard.orders', compact('orders', 'tag'));
    }

    public function offers(Request $request, $category) {

        $category = Category::where('name',$category)->first();
        $games = Game::whereHas('categoryGames', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })->get();

        $offers = Item::where('seller_id', auth()->id())->with('categoryGame.attributes', 'categoryGame.game')->whereHas('categoryGame', function ($query) use  ($category){
            return $query->where('category_id', $category->id);
        })->orderBy('created_at', 'desc')->get();


        return view('frontend.dashboard.offers', compact('offers', 'category', 'games'));
    }

    public function boosting(Request $request, $tag) {

        if($tag == 'my-requests') {
            $boostingRequests = BuyerRequest::with('requestOffers')->where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate('20');
        }else if($tag == 'received-requests') {
            $boostingRequests = auth()->user()
                ->notifications()
                ->where('type', 'App\Notifications\BoostingRequestNotification')
                ->orderBy('created_at', 'desc')
                ->paginate('20');
        }
        return view('frontend.dashboard.boosting', compact('boostingRequests', 'tag'));
    }

    public function wallet(Request $request) {

        if($request->ajax()){
            $transactions = Transaction::with('order')->where('user_id', auth()->id());
        } else {
            $transactions = Transaction::with('order')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
        }


        $pending_transactions = Order::where('seller_id', auth()->id())
            ->whereIn('order_status', ['delivered', 'received'])
            ->get()
            ->sum(function ($order) {
                return $order->total_price - $order->other_taxes - $order->payment_fees;
        });


        if($request->ajax()){

            $filterStatus = $request->filterStatus ?? null;
            $filterDuration = $request->filterDuration ?? null;

            if($filterStatus != null && $filterStatus != '') {
                $transactions->where('payment_type', $filterStatus);
            }

            // if($filterDuration != null && $filterDuration != '') {
            //     $transactions = $transactions
            //         ->whereMonth('created_at', 1)
            //         ->whereYear('created_at', 2025);
            // }else {
            //     $transactions = $transactions
            //         ->whereMonth('created_at', Carbon::now()->month)
            //         ->whereYear('created_at', Carbon::now()->year);
            // }

            if($filterDuration != null) {
                $transactions = $transactions->where('created_at', '<', Carbon::now()->subMonths(3));
            }else {
                $transactions = $transactions->where('created_at', '>=', Carbon::now()->subMonths(3));
            }

            return DataTables::eloquent($transactions)
            ->addColumn('date', function($transaction) {
                return $transaction->created_at->format('M j, Y, g:i:s A');
            })
            ->addColumn('balance', function($transaction) {
                if($transaction->payment_type == 'withdraw') {
                    $class = 'text-cherry';
                    $status = '-';
                }
                else  {
                    $class = 'text-theme-emerald';
                    $status = '+';
                }
                

                return '
                <span class="'. $class .' text-capitalize">'. $status . '$' . number_format($transaction->balance, 2) .'</span>
                ';
            })
            ->addColumn('description', function($transaction) {
                return '
                <span class="text-capitalize fs-13">'. $transaction->description .'</span>
                ';
            })
            ->addColumn('mobile_summary', function ($transaction) {
                if($transaction->payment_type == 'withdraw') {
                    $class = 'text-cherry';
                    $status = '-';
                }
                else  {
                    $class = 'text-theme-emerald';
                    $status = '+';
                }
                
                return '
                <div class="d-flex flex-column">
                    <div class="d-flexmb-2">'.$transaction->created_at->format('M j, Y, g:i:s A').'</div>
                    <span class="'. $class .' text-capitalize mb-2">'. $status . '$' . number_format($transaction->balance, 2) .'</span>
                    <div class="fs-13 mb-2">'.$transaction->description.'</div>
                </div>
                ';
            })
            ->addColumn('row_url', function ($order) {
                return route('order-detail', $order->order_id);
            })
            ->rawColumns(['date', 'balance', 'description', 'mobile_summary', 'row_url'])
            ->make(true);
        }
                
        // $transactions = $transactions->sortByDesc(function ($transaction) {
        //     return optional($transaction->messages->sortByDesc('created_at')->first())->created_at 
        //         ?? $transaction->created_at;
        // })->values();

        return view('frontend.dashboard.wallet', compact('transactions','pending_transactions'));
    }

    public function withdraw(Request $request) {


        return view('frontend.dashboard.withdraw');
    }

    public function messages(Request $request) {
        $messageType = $request->messageType;


        if($messageType == 'Boosting') {
            $conversations = BuyerRequestConversation::with('buyerRequest.service', 'order.categoryGame.category', 'messages')
                ->where(function ($query) {
                    $query->where('buyer_request_id', '!=', null)
                        ->where('order_id', null)
                        ->where(function ($q) {
                            $q->where('buyer_id', auth()->id())
                                ->orWhere('seller_id', auth()->id());
                        });
                })
                ->get();
        }elseif($messageType == 'Orders') {
            $conversations = BuyerRequestConversation::with('buyerRequest.service', 'order.categoryGame.category', 'messages')
                ->where(function ($query) {
                    $query->where('order_id', '!=', null)
                        ->where(function ($q) {
                            $q->where('buyer_id', auth()->id())
                                ->orWhere('seller_id', auth()->id());
                        });
                })
                ->get();
        }elseif($messageType == 'All'){
            $conversations = BuyerRequestConversation::with('buyerRequest.service', 'order.categoryGame.category', 'messages')->where('buyer_id', auth()->id())->orWhere('seller_id', auth()->id())->get();
        }else {
            $conversations = BuyerRequestConversation::with('buyerRequest.service', 'order.categoryGame.category', 'messages')->where('buyer_id', '786fdsjf')->get();
        }
        
        $conversations = $conversations->sortByDesc(function ($conversation) {
            return optional($conversation->messages->sortByDesc('created_at')->first())->created_at 
                ?? $conversation->created_at;
        })->values();

        return view('frontend.dashboard.messages', compact('messageType', 'conversations'));
    }

    public function feedback(Request $request) {
        $feedbackRating = $request->feedbackRating;

        if($feedbackRating == 'Positive') {
            $orders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) {
                    $query->where('feedback', 1)
                        ->where(function ($q) {
                            $q->where('seller_id', auth()->id());
                                // ->orWhere('buyer_id', auth()->id());
                        });
                })
                ->orderBy('feedback_at', 'desc')
                ->get();
        }elseif($feedbackRating == 'Negative') {
            $orders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) {
                    $query->where('feedback', 2)
                        ->where(function ($q) {
                            $q->where('seller_id', auth()->id());
                                // ->orWhere('buyer_id', auth()->id());
                        });
                })
                ->orderBy('feedback_at', 'desc')
                ->get();
        }elseif($feedbackRating == 'All'){
            $orders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) {
                    $query->where('feedback','!=', 0)
                    ->where(function ($q) {
                            $q->where('seller_id', auth()->id());
                                // ->orWhere('buyer_id', auth()->id());
                        });
                })
                ->orderBy('feedback_at', 'desc')
                ->get();
        }

        return view('frontend.dashboard.feedback', compact('feedbackRating', 'orders'));
    }

    public function profile(Request $request, $username) {
        // dd($request->all());

        if($request->tab == null){
            $tab = 'Offers';
        }else {
            $tab = $request->tab;
        }

        if($request->category == null){
            $category = 'Currency';
        }else {
            $category = $request->category;
        }

        if($request->feedbackRating == null){
            $feedbackRating = 'All';
        }else {
            $feedbackRating = $request->feedbackRating;
        }

        $user = User::where('username',$username)->first();

        $games = null;
        $items = null;
        $orders = null;

        if($tab == 'Offers'){
            if($category == 'TopUp')
            $category = 'Top up';
    
            $categoryQ = Category::where('name', $category)->first();
    
            $itemsQuery = Item::where('seller_id', $user->id)
                ->whereHas('categoryGame', function ($query) use ($categoryQ) {
                    $query->where('category_id', $categoryQ->id);
            });
    
    
            ////// FILTERS ////////////////////////////////////////////////////////////
                // Apply attribute filters
                
                if ($request->game != null) {
                    $game_id = $request->game;
    
                    $itemsQuery->whereHas('categoryGame', function ($query) use ($game_id) {
                        $query->where('game_id', $game_id);
                    });
                }
                
                // Apply search filter
                if ($searchTerm = $request->input('search')) {
                    $itemsQuery->where(fn($query) => $query->where('title', 'like', "%$searchTerm%")
                        ->orWhereHas('attributes', fn($q) => $q->where('value', 'like', "%$searchTerm%"))
                        ->orWhere('price', 'like', "%$searchTerm%"));
                }
            ///////////////////////////////////////////////////////////////////////////
    
            $items = $itemsQuery->paginate('30');
            $games = Game::all();
    
            if($category == 'Top up')
            $category = 'TopUp';
    
            if ($request->ajax()) {
                // Optional: render differently if needed
                return view('frontend.catalog._items', compact('items'))->render();
            }
        }elseif($tab == 'Feedback') {
            if($feedbackRating == 'Positive') {
                $orders = Order::with('buyer','seller','categoryGame.category')
                    ->where(function ($query) use ($user) {
                        $query->where('feedback', 1)
                            ->where(function ($q) use ($user) {
                                $q->where('seller_id', $user->id);
                                    // ->orWhere('buyer_id', auth()->id());
                            });
                    })
                    ->orderBy('feedback_at', 'desc')
                    ->get();
            }elseif($feedbackRating == 'Negative') {
                $orders = Order::with('buyer','seller','categoryGame.category')
                    ->where(function ($query) use ($user) {
                        $query->where('feedback', 2)
                            ->where(function ($q) use ($user) {
                                $q->where('seller_id', $user->id);
                                    // ->orWhere('buyer_id', auth()->id());
                            });
                    })
                    ->orderBy('feedback_at', 'desc')
                    ->get();
            }elseif($feedbackRating == 'All'){
                $orders = Order::with('buyer','seller','categoryGame.category')
                    ->where(function ($query) use ($user) {
                        $query->where('feedback','!=', 0)
                        ->where(function ($q) use ($user) {
                                $q->where('seller_id', $user->id);
                                    // ->orWhere('buyer_id', auth()->id());
                            });
                    })
                    ->orderBy('feedback_at', 'desc')
                    ->get();
            }
        }else {

        }

        return view('frontend.profile', compact('user','tab','category','games','items','feedbackRating','orders'));
    }

    public function notifications(Request $request) {    
        $notifications = auth()->user()->notifications()->whereIn('type', [
            'App\Notifications\BoostingRequestNotification',
            'App\Notifications\UserOrderDisputedNotification',
            'App\Notifications\BoostingOfferNotification',
        ])->paginate('20');

        return view('frontend.dashboard.notifications', compact('notifications'));
    }

    public function settings(Request $request) {
        $user = auth()->user();
        $email_notifications = EmailNotifications::all();
        return view('frontend.dashboard.account-settings', compact('user','email_notifications'));
    }

    public function update_account(Request $request) {
        // dd($request->all());

        $user = User::findOrFail(auth()->id());

        if($request->username) {
            $userSearch = User::where('username', $request->username)->first();
            if($userSearch == null) {
                $user->username = $request->username;
            }else {
                return redirect()->back()->with('error', 'Username already exists.');
            }
        }

        if($request->old_password != null){
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Password is invalid.');
            }

            // Password is correct — update to new one
            $user->password = Hash::make($request->new_password);
        }

        if ($request->hasFile('profile')) {
            if ($user->profile && file_exists(public_path('uploads/profile/' . $user->profile))) {
                unlink(public_path('uploads/profile/' . $user->profile));
                unlink(public_path('uploads/profile/thumbnails/' . $user->profile));
            }

            $image = $request->file('profile');

            // Generate unique filename
            $randomNumber = rand(1, 99999);
            $filename = time() . '.' . $randomNumber . '.' . $image->getClientOriginalExtension();

            // Original upload path
            $originalPath = public_path('uploads/profile/' . $filename);
            $image->move(public_path('uploads/profile'), $filename);

            // Initialize Intervention Image
            $imgManager = new ImageManager(new Driver());

            // Resize to 125x125
            $img125 = $imgManager->read($originalPath)->cover(125, 125);
            $savePath125 = public_path('uploads/profile/' . $filename);
            $img125->save($savePath125);

            // Resize to 44x44
            $img44 = $imgManager->read($originalPath)->cover(44, 44);
            $savePath44 = public_path('uploads/profile/thumbnails/' . $filename);
            $img44->save($savePath44);

            // Save the base filename (you can adjust this to store both if needed)
            $user->profile = $filename;
        }
        

        if($request->description != null) {
            $user->description = $request->description;
        }


        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function toggle_email_notification(Request $request){
        $notificationId = $request->input('notification_id');
        $totalAvailable = $request->input('total_available');
        $subscribed = $request->input('subscribed');

        $user = auth()->user(); // or auth('seller')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $notification = EmailNotifications::find($notificationId);

        if ($subscribed === 'true') {
            $user->emailNotifications()->syncWithoutDetaching([$notificationId]);
        } else {
            $user->emailNotifications()->detach($notificationId);
        }


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function editOffer(Request $request, $offer_id) {
        $offer = Item::with('categoryGame.category', 'categoryGame.game')->find($offer_id);
        $categoryId = $offer->categoryGame->category->id;

        return view('frontend.dashboard.edit-offers', compact('offer', 'categoryId'));
    }
}
