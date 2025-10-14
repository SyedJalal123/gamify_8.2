<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
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
use App\Models\Transaction;
use App\Models\RequestOffer;
use App\Models\BuyerRequestConversation;
use App\Events\GroupServiceSellerEvent;
use App\Models\ItemAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\BoostingOfferNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class NowPaymentController extends Controller
{
    /**
     * Create a new NOWPayments invoice and redirect to payment page
     */

    public function create(Request $request)
    {
        // dd($request->all());

        if(auth()->user()->role == 'admin') {
            return redirect()->back()->with('error', 'You can\'t perform this action.');
        }

        $validated = $request->validate([
            'total_price' => 'required|numeric|min:0.01',
            'main_total_price' => 'required|numeric|min:0.01',
            'product_name' => 'required|string',
            'offer_id' => 'nullable|exists:request_offers,id',
            'item_id' => 'nullable|exists:items,id',
            'quantity' => 'required|numeric',
            'discountPercentage' => 'nullable|numeric',
            'delivery_type' => 'nullable|string',
            'payment_method' => 'required|string',
            'payment_fees' => 'nullable|numeric',
            'price' => 'required|numeric',
        ]);

        $orderId = Str::uuid()->toString();

        $payload = [
            'price_amount' => $validated['total_price'],
            // 'price_amount' => 13,
            'price_currency' => 'usd',
            // 'pay_currency' => 'usdttrc20',
            'order_id' => $orderId,
            'order_description' => 'Test Order',
            'ipn_callback_url' => route('nowpayments.callback'),
            'success_url' => route('nowpayments.success', [
                'order_id' => $orderId,
                'offer_id' => $request->offer_id,
                'item_id' => $request->item_id,
                // 'product_name' => $request->product_name,
                'quantity' => $request->quantity,
                'discountPercentage' => $request->discountPercentage,
                'delivery_type' => $request->delivery_type,
                'payment_method' => $request->payment_method,
                'payment_fees' => $request->payment_fees,
                'price' => $request->price,
                'total_price' => $request->total_price,
                'main_total_price' => $request->main_total_price,
                'remaining_to_pay' => $request->remaining_to_pay,
                'cut_price'        => $request->cut_price,
            ]),
            'cancel_url' => route('nowpayments.cancel'),
        ];

        if(isset($request->product_name)){
            $description = $request->product_name;
        }else {
            $description = 'Order#'.$orderId;
        }

        $response = Http::withHeaders([
            'x-api-key' => env('NOWPAYMENTS_API_KEY'),
        ])->post('https://api.nowpayments.io/v1/invoice', $payload);
        
        $invoice = $response->json();

        if (isset($invoice['invoice_url'])) {
            return redirect($invoice['invoice_url']);
        }

        return redirect()->back()->with('error', 'Unable to initiate payment.');
    }

    /**
     * Handle IPN callback from NOWPayments
     */
    public function callback(Request $request)
    {
        dd($request);
        // Security
            $sigHeader = $request->header('x-nowpayments-sig'); // signature from NOWPayments
            $rawBody   = $request->getContent(); // the raw POST JSON payload
            $secret    = env('NOWPAYMENTS_IPN_SECRET'); // your secret from dashboard

            // Decode payload and sort keys
            $data = json_decode($rawBody, true);
            ksort($data);

            // Create JSON string with sorted data
            $sortedJson = json_encode($data, JSON_UNESCAPED_SLASHES);

            // Compute HMAC-SHA512 using your secret
            $calculatedHash = hash_hmac('sha512', $sortedJson, $secret);

            // Securely compare signatures
            $validSignature = hash_equals($sigHeader, $calculatedHash);

            if (! $validSignature) {
                Log::warning('NOWPayments: Invalid IPN signature', [
                    'received' => $sigHeader,
                    'expected' => $calculatedHash,
                ]);
                return response()->json(['error' => 'Invalid signature'], 400);
            }
        // Security

        // ✅ At this point, request is trusted
        $status   = $request->input('payment_status');
        $metadata = json_decode($request->input('metadata'), true) ?? [];

        if ($status === 'partially_paid') {
            $metadata['payment_status'] = 'partially_paid';
        } elseif (in_array($status, ['confirmed', 'finished'])) {
            $metadata['payment_status'] = 'paid';
        } else {
            Log::info('NOWPayments: Ignored status', ['status' => $status]);
            return response()->json(['message' => 'Ignored']);
        }
        
        $this->createOrder((object) $metadata);

        return response()->json(['message' => 'IPN processed']);



        // Log::info('NOWPayments IPN', $request->all());

        // $paymentStatus = $request->input('payment_status');
        // $orderId = $request->input('order_id');

        // // You should verify hash here if you want to be extra secure
        // if ($paymentStatus === 'finished') {
        //     // You could also finalize order here, if not already done
        // }

        // return response()->json(['message' => 'IPN received'], 200);
    }

    /**
     * Handle successful payment redirect
     */
    public function success(Request $request)
    {

        $orderId = $request->input('order_id'); // this is the UUID you sent when creating invoice

        // Fetch the order you created in callback()
        $order = Order::where('order_id', $orderId)->with('buyer', 'seller', 'item')->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        return redirect()->route('order-detail', ['order_id' => $order->order_id])
            ->with('success', 'Payment successful!');


        // // Trust your IPN to verify actual payment, this just redirects for user
        // $order = $this->createOrder((object) $request->all());

        // if ($order && $order->order_id) {
        //     return redirect()->route('order-detail', ['order_id' => $order->order_id])
        //         ->with('success', 'Payment successful!');
        // }

        // return redirect()->back()->with('error', 'Something went wrong!');
    }

    protected function createOrder($data)
    {
        try {
            $request = $data;

            if ($request->item_id) {
                $item = Item::with('categoryGame', 'seller')->find($request->item_id);
                $categoryGameId = $item->category_game_id;
                $seller_id = $item->seller_id;
                $account_id = null;
            } else {
                $offer = RequestOffer::with('buyerRequest.service.categoryGame', 'user')->find($request->offer_id);
                $categoryGameId = $offer->buyerRequest->service->categoryGame->id;
                $seller_id = $offer->user_id;
            }

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
                'account_id'         => $account_id ?? null,
                'discount_in_per'    => $request->discountPercentage ?? 0,
                'payment_fees'       => $request->payment_fees ?? 0,
                'total_price'        => $request->total_price,
                'remaining_to_pay'   => $request->remaining_to_pay,
                'cut_price'          => $request->cut_price,
                'payment_method'     => $request->payment_method,
                'order_status'       => 'pending delivery',
                'payment_status'     => $request->payment_status ?? 'pending',
                'delivery_type'      => $request->delivery_type ?? null,
            ]);

            Transaction::create([
                'user_id'        => auth()->id(),
                'order_id'       => $order->id,
                'balance'        => $request->total_price - ($request->payment_fees ?? 0),
                'description'    => 'Order created via NOWPayments',
                'payment_type'   => 'purchase',
                'user_type'      => 'buyer',
                'payment_method' => 'NOWPayments',
            ]);

            Transaction::create([
                'user_id'        => $seller_id,
                'order_id'       => $order->id,
                'balance'        => $request->total_price - ($request->payment_fees ?? 0),
                'description'    => 'Order sale via NOWPayments',
                'payment_type'   => 'sale',
                'user_type'      => 'seller',
                'payment_method' => 'NOWPayments',
            ]);

            // You can copy over your full buyer/seller chat and item updates logic if needed
            return $order;

        } catch (\Throwable $e) {
            Log::error('NOWPayments Order Creation Failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ]);
            return null;
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
