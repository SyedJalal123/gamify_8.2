<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\CategoryGame;
use App\Models\Game;
use App\Models\Category;
use App\Models\BuyerRequest;
use App\Models\Order;
use App\Models\BuyerRequestConversation;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class SellerDashboardController extends Controller
{
    public function orderDetail($order_id, Request $request) 
    {
        $order = Order::where('order_id', $order_id)->with('item.attributes', 'item.seller', 'item.categoryGame.game', 'item.categoryGame.attributes', 'chat', 'offer', 'offer.buyerRequest.service.categoryGame', 'offer.buyerRequest.attributes', 'offer.conversation', 'offer.user')->firstOrFail();
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
        // dd($conversation);
        
        if($conversation->seller_id == auth()->user()->id){
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

            if($filterStatus != null) {

                if($filterStatus == 'received' || $filterStatus == 'completed' || $filterStatus == 'cancelled') {
                    $orders->where('order_status', $filterStatus);
                }
                elseif($filterStatus == 'disputed') {
                    $orders->where('disputed', '1');
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
                if($order->order_status == 'received' || $order->order_status == 'delivered') 
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
                if($order->order_status == 'received' || $order->order_status == 'delivered') 
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
                        <div>'.$order->buyer->name.'</div>
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
            $boostingRequests = BuyerRequest::with('requestOffers')->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        }else if($tag == 'received-requests') {
            $boostingRequests = auth()->user()
                ->notifications()
                ->where('type', 'App\Notifications\BoostingRequestNotification')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('frontend.dashboard.boosting', compact('boostingRequests', 'tag'));
    }

    public function editOffer(Request $request, $offer_id) {
        $offer = Item::with('categoryGame.category', 'categoryGame.game')->find($offer_id);
        $categoryId = $offer->categoryGame->category->id;

        return view('frontend.dashboard.edit-offers', compact('offer', 'categoryId'));
    }
}
