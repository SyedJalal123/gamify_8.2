<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\BuyerRequestConversation;


class SellerDashboardController extends Controller
{
    public function orderDetail($order_id, Request $request) {
        $order = Order::where('order_id', $order_id)->with('item.attributes', 'item.seller', 'item.categoryGame.game', 'item.categoryGame.attributes', 'chat', 'offer', 'offer.buyerRequest.service.categoryGame', 'offer.buyerRequest.attributes', 'offer.buyerRequest.buyerRequestConversation', 'offer.user')->firstOrFail();
        
        $item = null; $offer = null;

        if($order->item_id == null){
            $offer = $order->offer;
            $categoryGame = $order->offer->buyerRequest->service->categoryGame;
            $conversation = $order->offer->buyerRequest->buyerRequestConversation->first();
            $maxDeliveryTime = $order->offer->delivery_time;
        }else {
            $item = $order->item;
            $categoryGame = $order->item->categoryGame;
            $conversation = $order->chat;
            $maxDeliveryTime = $order->item->delivery_time;
        }
        
        if($conversation->seller_id == auth()->user()->id){
            $identity = 'seller';
        }else {
            $identity = 'buyer';
        }
        
        return view('frontend.order-detail', compact('order', 'item', 'offer', 'categoryGame', 'identity', 'conversation', 'maxDeliveryTime'));
    }
}
