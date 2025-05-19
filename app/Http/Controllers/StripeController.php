<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Checkout\Session;
use App\Models\Order;
use Stripe\Checkout\Session as CheckoutSession;
use Carbon\Carbon;

class StripeController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());
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
                'quantity' => $request->input('quantity'),
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}', // important!
            'cancel_url' => route('stripe.cancel'),
            'metadata' => [
                'order_id' => $request->order_id,
                'conversation_id' => $request->conversation_id,
                'user_id' => auth()->id(), // or $request->user_id
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session_id = $request->get('session_id');  

        if (!$session_id) {
            return redirect()->route('home')->with('error', 'No session ID found.');
        }

        $session = CheckoutSession::retrieve($session_id);

        // dd($session->metadata);

        // Access the metadata
        $order_id = $session->metadata->order_id;
        $conversation_id = $session->metadata->conversation_id;
        $user_id = $session->metadata->user_id;

        

        // Marking order as paid
        $order = Order::with('item')->find($order_id);

        if($order->item_id != null && $order->item->delivery_method == 'automatic'){
            $order->update(['payment_status' => 'paid', 'order_status' => 'received']);
        }else {
            $order->update(['payment_status' => 'paid', 'created_at' => Carbon::now()]);
        }

        return redirect()->route('order-detail', ['order_id' => $order->order_id])->with('success', 'Payment successful!');
    }

    /**
     * Handle canceled payment redirect
     */
    public function cancel()
    {
        return redirect()->back()->with('error','Something went wrong! payment was unsuccessful.');

    }
}
    