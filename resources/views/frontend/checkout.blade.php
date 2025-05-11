    @extends('frontend.app')

    @section('css')
    <style>
        .checkout-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: space-between;
        }
        .checkout-left, .checkout-right {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .checkout-right {
            flex: 1 1 320px;
            max-width: 500px;
        }
        .checkout-left {
            flex: 1 1 520px;
        }
        .payment-method {
            border: 1px solid #e2e2e2;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
        }
        .payment-method.active {
            border-color: #000;
            background: #f8f8f8;
        }
        .checkout-title {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
    @endsection

    @section('content')
    
    @php
        $isGold = strtolower($item->category->name) === 'gold';
        $quantity = request()->get('quantity', 1);
        $unitPrice = $item->price;
        $totalPrice = $unitPrice * $quantity;
        $paymentFee = 1.74;
        $grandTotal = $totalPrice + $paymentFee;
        $loyaltyPoints = floor($totalPrice * 100);
    @endphp

    <section class="section section--bg section--first">
        <div class="container">
            @if (session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            @if (session('error'))
                <p style="color: red;">{{ session('error') }}</p>
            @endif
            <a href="{{ url()->previous() }}" class="text-muted mb-4 d-inline-block">&larr; Back</a>
            <h3 class="mb-4 color-white">Checkout</h3>

            <div class="checkout-wrapper">
                <!-- LEFT: Game Info + Payment -->
                <div class="checkout-left">
                    <div class="d-flex mb-3 align-items-start">
                        <img src="{{ asset($item->feature_image ?? $item->game->image) }}" alt="Item" width="80" class="rounded mr-3">
                        <div>
                            <h5 class="mb-1">{{ $item->title }}</h5>
                            <div class="text-muted small">
                                {{ $item->game->name ?? 'Game' }} &nbsp;|&nbsp;
                                Delivery: {{ $item->delivery_method ?? 'Instant' }}
                            </div>
                        </div>
                    </div>


                    <h6 class="mb-3">Payment method</h6>

                    <div class="payment-method credit_card active">
                        <label class="d-flex justify-content-between align-items-center">
                            <span>Credit/Debit Card</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="28" viewBox="0 0 42 28" fill="none" crosspilot="">
                                    <g clip-path="url(#clip0_22031_301)">
                                        <path d="M0.5 6C0.5 2.96614 2.96614 0.5 6 0.5H36C39.0339 0.5 41.5 2.96614 41.5 6V22C41.5 25.0339 39.0339 27.5 36 27.5H6C2.96614 27.5 0.5 25.0339 0.5 22V6Z" fill="white" stroke="#E7E7E7" />
                                        <path d="M25.4357 9.25171C23.3546 9.25171 21.4948 10.3304 21.4948 12.3234C21.4948 14.6089 24.7932 14.7668 24.7932 15.915C24.7932 16.3984 24.2392 16.8312 23.2929 16.8312C21.9499 16.8312 20.9462 16.2265 20.9462 16.2265L20.5167 18.2376C20.5167 18.2376 21.673 18.7484 23.2081 18.7484C25.4835 18.7484 27.2739 17.6167 27.2739 15.5897C27.2739 13.1746 23.9617 13.0214 23.9617 11.9557C23.9617 11.577 24.4165 11.162 25.3601 11.162C26.4247 11.162 27.2934 11.6018 27.2934 11.6018L27.7137 9.65943C27.7137 9.65943 26.7686 9.25171 25.4357 9.25171ZM6.39536 9.39831L6.34497 9.6915C6.34497 9.6915 7.22051 9.85173 8.00907 10.1714C9.02441 10.5379 9.09674 10.7513 9.26773 11.414L11.1311 18.5972H13.629L17.4771 9.39831H14.985L12.5123 15.6527L11.5033 10.3512C11.4108 9.74443 10.9421 9.39831 10.3684 9.39831H6.39536ZM18.4793 9.39831L16.5243 18.5972H18.9007L20.8488 9.39831H18.4793ZM31.7336 9.39831C31.1606 9.39831 30.8569 9.70511 30.6341 10.2412L27.1525 18.5972H29.6446L30.1268 17.2046H33.1629L33.4561 18.5972H35.6551L33.7367 9.39831H31.7336ZM32.0577 11.8836L32.7964 15.3355H30.8174L32.0577 11.8836Z" fill="#1434CB" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_22031_301">
                                            <rect width="42" height="28" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="28" viewBox="0 0 42 28" fill="none" crosspilot="">
                                    <g clip-path="url(#clip0_20665_832)">
                                        <path d="M0.5 6C0.5 2.96614 2.96614 0.5 6 0.5H36C39.0339 0.5 41.5 2.96614 41.5 6V22C41.5 25.0339 39.0339 27.5 36 27.5H6C2.96614 27.5 0.5 25.0339 0.5 22V6Z" fill="white" stroke="#E7E7E7" />
                                        <path d="M23.3799 14.05C23.3799 18.5 19.7099 22.1 15.1899 22.1C4.32992 21.67 4.32992 6.41999 15.1899 5.98999C19.7099 5.98999 23.3799 9.59999 23.3799 14.04V14.05Z" fill="#ED0006" />
                                        <path d="M34 14.05C34 18.5 30.33 22.1 25.81 22.1C14.95 21.67 14.95 6.41999 25.81 5.98999C30.33 5.98999 34 9.59999 34 14.04V14.05Z" fill="#F9A000" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5 20.18C16.72 17.24 16.72 10.86 20.5 7.92004C24.28 10.86 24.28 17.24 20.5 20.18Z" fill="#FF5E00" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_20665_832">
                                            <rect width="42" height="28" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="28" viewBox="0 0 42 28" fill="none" crosspilot="">
                                    <g clip-path="url(#clip0_22026_320)">
                                        <path d="M36 0H6C2.68629 0 0 2.68629 0 6V22C0 25.3137 2.68629 28 6 28H36C39.3137 28 42 25.3137 42 22V6C42 2.68629 39.3137 0 36 0Z" fill="#006FCE" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.52497 9.77502L3.59497 18.225H8.29497L8.87497 16.875H10.205L10.785 18.225H15.965V17.195L16.425 18.225H19.105L19.565 17.175V18.225H30.335L31.645 16.915L32.875 18.225H38.405L34.465 14.025L38.405 9.77502H32.955L31.685 11.065L30.495 9.77502H18.775L17.765 11.955L16.735 9.77502H12.045V10.765L11.525 9.77502H7.51497H7.52497ZM23.605 10.975H29.785L31.675 12.965L33.625 10.975H35.515L32.645 14.025L35.515 17.035H33.535L31.645 15.025L29.685 17.035H23.595V10.975H23.605ZM25.135 13.335V12.225H28.995L30.675 13.995L28.915 15.775H25.135V14.565H28.505V13.335H25.135ZM8.43497 10.975H10.725L13.335 16.705V10.975H15.845L17.855 15.085L19.715 10.975H22.215V17.045H20.695V12.295L18.465 17.045H17.105L14.875 12.295V17.045H11.745L11.155 15.685H7.95497L7.36497 17.045H5.68497L8.44497 10.975H8.43497ZM8.49497 14.425L9.55497 12.005L10.605 14.425H8.49497Z" fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_22026_320">
                                            <rect width="42" height="28" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <input type="radio" name="payment_method" value="card" checked hidden>
                        </label>
                    </div>

                    <div class="payment-method cryptocurrency">
                        <label class="d-flex justify-content-between align-items-center">
                            <span>Cryptocurrency</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="28" viewBox="0 0 42 28" fill="none" crosspilot="">
                                    <g clip-path="url(#clip0_20664_748)">
                                        <path d="M0.5 6C0.5 2.96614 2.96614 0.5 6 0.5H36C39.0339 0.5 41.5 2.96614 41.5 6V22C41.5 25.0339 39.0339 27.5 36 27.5H6C2.96614 27.5 0.5 25.0339 0.5 22V6Z" fill="white" stroke="#E7E7E7" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M29 14C29 18.42 25.4105 22 20.9787 22C10.3404 21.58 10.3404 6.42 20.9787 6C25.4105 6 29 9.58 29 14ZM22.9038 11.03C24.0168 11.41 24.8389 11.98 24.6785 13.05C24.5582 13.83 24.1271 14.21 23.5455 14.34C24.3376 14.75 24.6083 15.53 24.3577 16.47C23.8764 17.82 22.7434 17.94 21.2394 17.66L20.8684 19.12L19.9861 18.9L20.347 17.46C20.1164 17.4 19.8858 17.34 19.6452 17.28L19.2842 18.72L18.4018 18.5L18.7628 17.04L16.9781 16.59L17.4192 15.58C17.4192 15.58 18.071 15.75 18.0609 15.74C18.3116 15.8 18.4219 15.64 18.462 15.53L19.4546 11.58C19.4647 11.39 19.4045 11.16 19.0436 11.07C19.0536 11.07 18.4018 10.91 18.4018 10.91L18.6325 9.97L20.4172 10.41L20.7782 8.97L21.6605 9.19L21.3096 10.6C21.5502 10.65 21.7909 10.71 22.0215 10.77L22.3724 9.36L23.2547 9.58L22.8938 11.02H22.9038V11.03ZM20.7882 13.43C21.3898 13.59 22.7033 13.94 22.9239 13.03C23.1545 12.1 21.8811 11.82 21.2594 11.68C21.1893 11.66 21.1291 11.65 21.079 11.64L20.6378 13.39C20.6378 13.39 20.728 13.41 20.7882 13.43ZM20.1064 16.26C20.8283 16.45 22.4025 16.86 22.6531 15.86C22.9038 14.74 21.2093 14.47 20.4172 14.28L19.9359 16.21C19.9359 16.21 20.0462 16.24 20.1064 16.25V16.26Z" fill="#F7931A" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_20664_748">
                                            <rect width="42" height="28" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="28" viewBox="0 0 42 28" fill="none" crosspilot="">
                                    <g clip-path="url(#clip0_20665_1226)">
                                        <path d="M0.5 6C0.5 2.96614 2.96614 0.5 6 0.5H36C39.0339 0.5 41.5 2.96614 41.5 6V22C41.5 25.0339 39.0339 27.5 36 27.5H6C2.96614 27.5 0.5 25.0339 0.5 22V6Z" fill="white" stroke="#E7E7E7" />
                                        <path d="M21 22C25.4183 22 29 18.4183 29 14C29 9.58172 25.4183 6 21 6C16.5817 6 13 9.58172 13 14C13 18.4183 16.5817 22 21 22Z" fill="#6481E7" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0901 8.37V16.45L24.6801 14.33L21.0901 8.38V8.37Z" fill="#C1CCF5" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 14.33L21.09 16.45V8.37L17.5 14.32V14.33Z" fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.09 12.6899L17.5 14.3199L21.09 16.4399L24.68 14.3199L21.09 12.6899Z" fill="#8299EC" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0901 17.13V20.07L24.6801 15.01L21.0901 17.13Z" fill="#C1CCF5" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.09 12.6899L17.5 14.3199L21.09 16.4399V12.6899Z" fill="#C1CCF5" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 15.01L21.09 20.07V17.13L17.5 15.01Z" fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_20665_1226">
                                            <rect width="42" height="28" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="28" viewBox="0 0 42 28" fill="none" crosspilot="">
                                    <g clip-path="url(#clip0_21955_571)">
                                        <path d="M0.5 6C0.5 2.96614 2.96614 0.5 6 0.5H36C39.0339 0.5 41.5 2.96614 41.5 6V22C41.5 25.0339 39.0339 27.5 36 27.5H6C2.96614 27.5 0.5 25.0339 0.5 22V6Z" fill="white" stroke="#E7E7E7" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M29 14C29 18.4183 25.4183 22 21 22C16.5817 22 13 18.4183 13 14C13 9.58172 16.5817 6 21 6C25.4183 6 29 9.58172 29 14ZM19.049 14L20.2194 9.60971H22.7561L21.8781 13.0245L23.049 12.5367L22.7561 13.6097L21.5852 14L21 16.1464H25.1954L24.8051 17.7072H18.073L18.7561 15.073L17.7806 15.4633L18.073 14.3903L19.049 14Z" fill="#A5A8A9" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_21955_571">
                                            <rect width="42" height="28" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <input type="radio" name="payment_method" value="crypto" hidden>
                        </label>
                    </div>
                </div>

                <form action="{{ route('stripe.session') }}" method="post" class="checkout-right">
                    @csrf
                    <input type="hidden" name="product_name" value="{{$item->title}}">
                    <input type="hidden" name="total_price" value="{{$grandTotal}}">
                    <h5 class="mb-4">Order Summary</h5>
                    <ul class="list-unstyled mb-3">
                        <li class="d-flex justify-content-between mb-2">
                            <span>Order Price</span>
                            <strong>${{ number_format($totalPrice, 2) }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span>Payment Fees</span>
                            <strong>${{ number_format($paymentFee, 2) }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span>Loyalty Points</span>
                            <strong>+ {{ $loyaltyPoints }} 🪙</strong>
                        </li>
                        <li class="border-top pt-3 d-flex justify-content-between">
                            <span><strong>Total:</strong></span>
                            <strong class="h5">${{ number_format($grandTotal, 4) }}</strong>
                        </li>
                    </ul>
                    <button class="mb-5" id="stripe-checkout-button">Stripe Checkout</button>
                    <br><br>
                    <button type="submit" class="btn btn-dark w-100">Continue to payment &rarr;</button>
                
                    <div class="mt-4 small text-muted">
                        <p><strong>Safe & Secure Payment</strong><br>100% Secure payments by TradeShield.</p>
                        <p><strong>Account Warranty</strong><br>All purchases covered by 14-day warranty.</p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        const form = document.querySelector('form.checkout-right');

        document.querySelectorAll('.payment-method').forEach(box => {
            box.addEventListener('click', () => {
                document.querySelectorAll('.payment-method').forEach(b => b.classList.remove('active'));
                box.classList.add('active');

                if (box.classList.contains('cryptocurrency')) {
                    form.action = "{{ url('pay/now') }}";
                    form.method = "GET";
                } else if (box.classList.contains('credit_card')) {
                    form.action = "{{ route('stripe.session') }}";
                    form.method = "post";
                }

                const radio = box.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;
            });
        });
    </script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');

        document.getElementById('stripe-checkout-button').addEventListener('click', function () {
            fetch('/payment/stripe/create-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    @endsection
