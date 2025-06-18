<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Game;
use App\Models\Attribute;
use App\Models\BuyerRequest;
use App\Models\RequestOffer;
use App\Models\Order;
use App\Models\BuyerRequestConversation;
use App\Models\ItemAttribute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        if($request->offer_id){
            $offer = RequestOffer::with(['buyerRequest.service.categoryGame', 'buyerRequest.attributes'])->findOrFail($request->offer_id);
            $item = null;
        }else {
            $item = Item::with(['categoryGame.game', 'seller', 'attributes'])->findOrFail($request->item_id);
            $offer = null;
        }

        $price = $request->price;
        $discountPercentage = $request->discountPercentage;
        $quantity = max(1, (int) $request->quantity);
        $totalPrice = $request->totalPrice;

        return view('frontend.checkout', compact('item', 'offer', 'quantity', 'discountPercentage', 'price', 'totalPrice'));
    }

    public function checkout(Request $request)
    {
        // dd($request->all());
        $item = Item::with(['attributes', 'game', 'category'])->findOrFail($request->item_id);
        $quantity = $request->quantity ?? null;

        return view('frontend.checkout', compact('item', 'quantity'));
    }

    public function create(Request $request) {
        
        // dd($request->all());
        // if($request->item_id){
        //     $item = Item::with('categoryGame')->find($request->item_id);
        //     $categoryGameId = $item->category_game_id;
        //     $seller_id = $item->seller_id;
        // }else {
        //     $offer = RequestOffer::with('buyerRequest.service.categoryGame')->find($request->offer_id);
        //     $categoryGameId = $offer->buyerRequest->service->categoryGame->id;
        //     $seller_id = $offer->user_id;
        // }

        $validated = $request->validate([
            'payment_method'      => 'required|in:stripe,nowpayments',
            'total_price'         => 'required|numeric|min:0',
            'item_id'             => 'nullable|integer|exists:items,id',
            'offer_id'            => 'nullable|integer|exists:request_offers,id',
            'product_name'        => 'required|string|max:255',
            'quantity'            => 'required|integer|min:1',
            'price'               => 'required|numeric|min:0',
            'discountPercentage'  => 'nullable|numeric|min:0|max:100',
            'payment_fees'        => 'nullable|numeric|min:0',
            'delivery_type'       => 'nullable|string',
        ]);

        // DB::beginTransaction();

        // try {
        //     $order = Order::create([
        //         'order_id'           => Str::uuid()->toString(),
        //         'item_id'            => $validated['item_id'] ?? null,
        //         'request_offer_id'   => $validated['offer_id'] ?? null,
        //         'category_game_id'   => $categoryGameId,
        //         'buyer_id'           => Auth::id(),
        //         'seller_id'          => $seller_id,
        //         'title'              => $validated['product_name'],
        //         'quantity'           => $validated['quantity'],
        //         'price'              => $validated['price'],
        //         'discount_in_per'    => $validated['discountPercentage'] ?? 0,
        //         'payment_fees'       => $validated['payment_fees'] ?? 0,
        //         'total_price'        => $validated['total_price'],
        //         'payment_method'     => $validated['payment_method'],
        //         'delivery_type'      => $validated['delivery_type'] ?? null,
        //     ]);


        //     // Creating conversation
        //     if($request->offer_id){
        //         $buyerRequest = BuyerRequest::find($offer->buyer_request_id);

        //         $buyerRequest->update([
        //             'seller_id' => $seller_id,
        //             'status' => 'closed',
        //         ]);

        //         $offer = RequestOffer::with([
        //             'buyerRequest.buyerRequestConversation' => function ($query) use ($offer) {
        //                     $query->where('seller_id', $offer->user_id)
        //                         ->where('buyer_id', $offer->buyerRequest->user_id);
        //                 }
        //             ])->find($validated['offer_id']);

        //         $conversation = $offer->buyerRequest->buyerRequestConversation->first();

        //         if($conversation == null){
        //             $conversation = BuyerRequestConversation::create([
        //                 'buyer_request_id' => $offer->buyerRequest->id,
        //                 'order_id' => $order->id,
        //                 'buyer_id' => $offer->buyerRequest->user_id,
        //                 'seller_id' => $offer->user_id
        //             ]);
        //         }else {
        //             $conversation->update([
        //                 'order_id' => $order->id,
        //             ]);
        //         }
                
        //     }else {
        //         $item = Item::find($validated['item_id']);
        //         $conversation = BuyerRequestConversation::create([
        //             'order_id' => $order->id,
        //             'buyer_id' => Auth::id(),
        //             'seller_id' => $item->seller_id
        //         ]);
        //     }

        //     $request->merge(['order_id' => $order->id, 'conversation_id' => $conversation->id]);

        //     DB::commit();

            return match ($request->payment_method) {
                'stripe'       => app(StripeController::class)->create($request),
                'nowpayments'  => app(NowPaymentController::class)->create($request),
            };

        // } catch (\Throwable $e) {
        //     DB::rollBack();

        //     Log::error('Order creation failed', [
        //         'error' => $e->getMessage(),
        //         'trace' => $e->getTraceAsString(),
        //     ]);

        //     return redirect()->back()->with('error', 'Failed to place your order. Please try again.');
        // }
    }
}