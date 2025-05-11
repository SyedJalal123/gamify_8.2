<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
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
                        'name' => $request->input('product_name', 'Default Product'),
                    ],
                    'unit_amount' => $amountInCents, 
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }
    public function success()
    {
        return redirect()->back()->with('success','Payment was successful! Thank you.');
    }

    /**
     * Handle canceled payment redirect
     */
    public function cancel()
    {
        return redirect()->back()->with('error','Something went wrong! payment was unsuccessful.');

    }
}
    