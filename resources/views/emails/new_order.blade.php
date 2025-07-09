<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
        }
        .content {
            padding: 20px;
            text-align: center;
            color: #333;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .status {
            font-weight: bold;
            color: #28a745;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #666;
            padding: 15px;
            border-top: 1px solid #ddd;
        }
        .btn-1 {
            background: #007bff;
            color: #ffff !important;
            text-decoration: none;
            padding: 10px 21px;
            font-size: 15px;
            border-radius: 7px;
            font-weight: 600;
        }
        .mb-36px {
            margin-bottom: 36px;
        }
        .mt-36px {
            margin-top: 36px;
        }
        .mt-0 {
            margin-top: 0px;
        }
        .mb-0 {
            margin-bottom: 0px;
        }
        .color-light {
            color: #777777;
        }
        .fs-14 {
            font-size: 14px !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"><img src="{{ url('logo-sm.png') }}" alt="" style="width: 120px;"></div>
        <div class="content">
            {{-- @if ($data['admin'] == 0)
                <h2>Hello, {{ $data['name'] }} 👋</h2>
            @endif --}}

            <h2 class="mt-0">{{ $data['title'] }}</h2>

            <p style="font-size:15px;padding:0px 65px;">
                {{ $data['data'] }}
            </p>

            @if (isset($data['reason']))
                <p class="fs-14 color-light"><strong>Reason:</strong> {{ $data['reason'] }}</p>
            @endif

            @if(isset($data['data3']))
            @php $user = get_user($data['buyer_id']); $order = get_order($data['data3']); @endphp
            <p class="fs-14 color-light"><strong>Order ID:</strong> {{ $data['data3'] }}</p>
            @endif

            @if (isset($data['data1']))    
            <p class="color-light fs-14 mb-0">
                <strong>Game:</strong> {{ $data['data1'] }}
            </p>
            @endif
            @if (isset($order))
            <p class="mt-0 mb-0 color-light fs-14">
                <strong>Order price:</strong> {{ $order->total_price }} USD
            </p>
            @endif
            @if (isset($user) && $data['title'] !== 'Order Delivered' && $data['title'] !== 'Order Cancelled' && $data['title'] !== 'New Boosting Offer')
            <p class="mt-0 mb-0 color-light fs-14">
                <strong>Buyer:</strong> {{ $user->username }}
            </p>
            @endif


            @if (isset($data['seller_id']))
            @php $seller = get_user($data['seller_id']);@endphp
            <p class="mt-0 mb-0 color-light fs-14">
                <strong>Seller:</strong> {{ $seller->username }}
            </p>
            @endif
            @if (isset($data['price']))
            <p class="mt-0 mb-0 color-light fs-14">
                <strong>Price:</strong> ${{ $data['price'] }}
            </p>
            @endif
            @if (isset($data['delivery_time']))
            <p class="mt-0 mb-0 color-light fs-14">
                <strong>Delivery time:</strong> {{ $data['delivery_time'] }}
            </p>
            @endif

            <br><br>

            @if ($data['title'] == 'New Boosting Request' || $data['title'] == 'New Boosting Offer')
            <a href="{{ $data['link'] }}" target="_blank" class="btn-1">View Offer</a>
            @elseif ($data['title'] == 'Seller account verified')
            <a href="{{ $data['link'] }}" target="_blank" class="btn-1">Start Selling</a>
            @elseif($data['title'] == 'Seller verification failed')
            <a href="{{ $data['link'] }}" target="_blank" class="btn-1">Try again</a>
            @else
            <a href="{{ $data['link'] }}" target="_blank" class="btn-1">View Order</a>
            @endif
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Gamify | All rights reserved.
        </div>
    </div>
</body>
</html>
