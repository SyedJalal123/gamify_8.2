<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NowPaymentController extends Controller
{
    /**
     * Create a new NOWPayments invoice and redirect to payment page
     */
    public function create(Request $request)
    {
        // dd($request->all());

        if(isset($request->product_name)){
            $description = $request->product_name;
        }else {
            $description = 'Order#'.$orderId;
        }

        $orderId = Str::uuid()->toString();

        $validatedData = $request->validate([
            'total_price' => 'required|numeric|min:0.01',
            // 'price_currency' => 'required|string',
            // 'order_description' => 'required|string',
            // 'order_id' => 'required|string|unique:orders,order_id',
        ]);

        $response = Http::withHeaders([
            'x-api-key' => env('NOWPAYMENTS_API_KEY'),  
            'x-nowpayments-sandbox' => 'true',
        ])->post('https://api.nowpayments.io/v1/invoice', [
            'price_amount' => $validatedData['total_price'],
            'price_currency' => 'usd',
            'order_id' => $orderId,
            'order_description' => $description,
            'ipn_callback_url' => route('nowpayments.callback'),
            'success_url' => route('nowpayments.success', ['order_id' => $orderId]),
            'cancel_url' => route('nowpayments.cancel'),
        ]);

        $invoice = $response->json();


        if (isset($invoice['invoice_url'])) {
            return redirect($invoice['invoice_url']);
        }

        return response()->json(['error' => 'Unable to create invoice', 'details' => $invoice], 500);
    }

    /**
     * Handle IPN callback from NOWPayments
     */
    public function callback(Request $request)
    {
        dd($request->all());

        $paymentStatus = $request->input('payment_status');
        $orderId = $request->input('order_id');

        // Update your order in database here based on $orderId and $paymentStatus

        return response()->json(['message' => 'IPN received successfully']);
    }

    /**
     * Handle successful payment redirect
     */
    public function success(Request $request)
    {
        dd($request->all());
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
