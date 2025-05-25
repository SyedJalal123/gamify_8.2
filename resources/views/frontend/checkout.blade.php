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
        @media (max-width: 768px) { 
            .section--first {
                padding-top: 155px !important;
            } 
        }
    </style>
@endsection

@section('content')
    
    @php
        $quantity = request()->get('quantity', 1);
        $unitPrice = $price;
        $paymentFee = 1.74;
        $grandTotal = $totalPrice + $paymentFee;
        $loyaltyPoints = floor($totalPrice * 100);
    @endphp

    <section class="section section--bg section--first">
        <div class="container p-0"> 
            <div class="sessions">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="top-bar-page px-3">
                <a wire:navigate href="{{ url()->previous() }}" class="text-muted mb-4 d-inline-block">&larr; Back</a>
                <h3 class="mb-4 color-white">Checkout</h3>
            </div>

            <form action="{{ route('checkout.create') }}" method="post" class="checkout-wrapper" id="checkout-form">
                @csrf
                <input type="hidden" name="total_price" value="{{ $grandTotal}}">
                <input type="hidden" name="quantity" value="{{ $quantity }}">
                <input type="hidden" name="discountPercentage" value="{{ $discountPercentage }}">

                <!-- LEFT: Game Info + Payment -->
                <div class="checkout-left p-3 p-md-4 br-4">
                    <div class="d-flex pb-4 align-items-start border-bottom">
                        @if($item != null)
                            <input type="hidden" name="product_name" value="{{ $item->title != null ? $item->title : $item->categoryGame->game->name .' '. $item->categoryGame->title }}">
                            <input type="hidden" name="item_id" value="{{ $item->id}}">

                            <img src="{{ asset($item->categoryGame->feature_image ? $item->categoryGame->feature_image : $item->images_path.'thumbnails/'.$item->feature_image) }}" alt="Item" width="50" class="rounded mr-3">
                            <div>
                                <h6 class="mb-1 fw-bold fs-14">
                                    @if ($item->categoryGame->category_id == 3)
                                        @foreach ($item->attributes as $key => $attribute)
                                            @if ($attribute->topup == 1)
                                                <strong>@if ($key !== 0).@endif {{ $attribute->pivot->value }}</strong>
                                            @endif
                                        @endforeach
                                    @endif
                                    {{ $item->title ? $item->title : $item->categoryGame->title }}
                                </h6>
                                <div class="text-muted small">
                                    @php $count = 0; @endphp
                                    @foreach ($item->attributes as $key => $attribute)
                                        @if($attribute->topup == 0)
                                            <strong>@if ($count !== 0).@endif {{ $attribute->pivot->value }}</strong>
                                            @php $count++; @endphp
                                        @endif
                                    @endforeach
                                    @if($count != 0) <span>&nbsp;|&nbsp;</span> @endif
                                    <span>Delivery time: {{ ($item->delivery_method == 'automatic') ? 'Instant' : $item->delivery_time }}</span>
                                    <span>&nbsp;|&nbsp;</span>
                                    <span>Quantity: {{ $quantity ?? '1' }}</span>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="product_name" value="{{ $offer->buyerRequest->service->name }}">
                            <input type="hidden" name="offer_id" value="{{ $offer->id}}">
                            
                            <img src="{{ asset($offer->buyerRequest->service->categoryGame->feature_image ? $offer->buyerRequest->service->categoryGame->feature_image : $offer->buyerRequest->service->categoryGame->game->image ) }}" alt="Item" width="50" class="rounded mr-3">
                            <div>
                                <h6 class="mb-1 fw-bold fs-14">
                                    {{ $offer->buyerRequest->service->name }}
                                </h6>
                                <div class="text-muted small d-flex flex-wrap">
                                    @php $count = 0; @endphp
                                    @foreach ($offer->buyerRequest->attributes as $key => $attribute)
                                        <span class="offer-attributes">
                                            @if ($count !== 0)&nbsp;|&nbsp;@endif
                                            @php if($attribute->type == 'select') { $label = 'Select your '; } else { $label = 'Input your '; } @endphp
                                            <span class="fw-bold">{{$label}}{{$attribute->name}}:</span> {{ $attribute->pivot->value }}
                                        </span>
                                        @php $count++; @endphp
                                    @endforeach
                                    <span class="offer-attributes">
                                        @if($count != 0) <span>&nbsp;|&nbsp;</span> @endif
                                        @if ($offer->buyerRequest->service == 'Custom Request')
                                            <span class="fw-bold">Provide any additional information:</span> {{ $offer->buyerRequest->description }}
                                        @else
                                            <span class="offer-attributes"><span class="fw-bold">Describe your request:</span> {{ $offer->buyerRequest->description }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex flex-column my-3">
                        @if($item != null && $item->categoryGame->delivery_type !== null && $item->categoryGame->delivery_type !== "")
                            <div class="d-flex flex-column my-3">
                                <label class="form-label">
                                    {{ $item->categoryGame->game->name }} {{ $item->categoryGame->delivery_type }}
                                    <span title="Your order will be delivered to this character, ex. `Dragon499`." style="cursor: help; margin-right: 5px;"><i class="bi-question-circle text-black-60"></i></span>
                                </label>
                                <input type="text" name="delivery_type" id="delivery-type" class="form-control" placeholder="{{ $item->categoryGame->game->name }} {{ $item->categoryGame->delivery_type }}" required>
                            </div>
                        @elseif ($offer != null)
                            <div class="d-flex flex-column my-3">
                                <label class="form-label">
                                    {{ $offer->buyerRequest->service->categoryGame->game->name }} {{ $offer->buyerRequest->service->categoryGame->delivery_type }}
                                    <span title="Your order will be delivered to this character, ex. `Dragon499`." style="cursor: help; margin-right: 5px;"><i class="bi-question-circle text-black-60"></i></span>
                                </label>
                                <input type="text" name="delivery_type" id="delivery-type" class="form-control" placeholder="{{ $offer->buyerRequest->service->categoryGame->game->name }} {{ $offer->buyerRequest->service->categoryGame->delivery_type }}" required>
                            </div>
                        @endif

                        <div class="d-flex flex-column my-3">
                            <h6 class="mb-3 fs-15">Payment method</h6>
        
                            <div class="payment-method credit_card active cursor-pointer">
                                <label class="d-flex cursor-pointer justify-content-between align-items-center m-0">
                                    <span class="fs-14">Credit/Debit Card</span>
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
                                    <input type="radio" name="payment_method" value="stripe" checked hidden>
                                </label>
                            </div>
        
                            <div class="payment-method cryptocurrency cursor-pointer">
                                <label class="d-flex cursor-pointer justify-content-between align-items-center m-0">
                                    <span class="fs-14">Cryptocurrency</span>
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
                                    <input type="radio" name="payment_method" value="nowpayments" hidden>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout-right p-3 p-md-4 br-4">
                    <h6 class="pb-3 mb-3 fw-bold border-bottom">Order Summary</h6>
                    <ul class="list-unstyled mb-3 pb-3 border-bottom">
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-black-70">Order Price</span>
                            <strong>${{ number_format($totalPrice, 2) }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-black-70">Payment Fees</span>
                            <strong>${{ number_format($paymentFee, 2) }}</strong>
                            <input type="hidden" name="payment_fees" value="{{$paymentFee}}">
                            <input type="hidden" name="price" value="{{$unitPrice}}">
                        </li>
                        {{-- <li class="d-flex justify-content-between mb-2">
                            <span>Loyalty Points</span>
                            <strong>+ {{ $loyaltyPoints }} 🪙</strong>
                        </li> --}}
                    </ul>

                    <div class="d-flex justify-content-between mb-4">
                        <span><strong>Total:</strong></span>
                        <strong class="h5 fw-bold">${{ number_format($grandTotal, 2) }}</strong>
                    </div>

                    <div class="d-flex flex-column">
                        {{-- <button class="btn btn-dark w-100 mb-2" id="stripe-checkout-button">Stripe Checkout</button> --}}
                        <button type="button" id="submit-button" class="btn btn-dark w-100 py-3 fw-bold">Continue to payment <i class="ml-2 bi-chevron-right"></i></button>
                    </div>
                
                    <div class="mt-4 small text-muted">
                        <p><strong>Safe & Secure Payment</strong><br>100% Secure payments by TradeShield.</p>
                        <p><strong>Account Warranty</strong><br>All purchases covered by 14-day warranty.</p>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div id="pageOverlay">
        <div class="spinner-border text-light" role="status"></div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        document.getElementById('submit-button').addEventListener('click', () => {
            // Check if the form is valid
            if (validateForm()) {
                const overlay = document.getElementById('pageOverlay');
                overlay.style.display = 'flex';

                $('#checkout-form').submit();
                
            }
        });


        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("section");
            y = x[0].getElementsByTagName("input");
            var checkboxes = Array.from(y).filter(input => input.type === 'checkbox');
            var y = Array.from(y).filter(input => input.type !== 'checkbox');
            z = x[0].getElementsByTagName("select");
            t = x[0].getElementsByTagName("textarea");

            // checkboxes
            for (i = 0; i < checkboxes.length; i++) {
                // If a field is empty...
                if ($(checkboxes[i]).attr('required') && $(checkboxes[i]).attr('type') == 'checkbox' && !$(checkboxes[i]).is(':checked')) {
                    if(checkboxes[i].name == 'termsService' || checkboxes[i].name == 'sellerRules'){
                        // $('.rules_error').removeClass("d-none");
                    }
                    valid = false;
                }else if($(checkboxes[i]).attr('required')){
                    // $('.rules_error').addClass("d-none");
                }
            }
            // inputs
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "" && $(y[i]).attr('required')) {
                    y[i].classList.add("invalid");
                    valid = false;
                }else {
                    y[i].classList.remove("invalid");
                }
            }
            // select boxes
            for (i = 0; i < z.length; i++) {
                // If a field is empty...
                if (z[i].value == "" && $(z[i]).attr('required')) {
                    $('#'+z[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid red');
                    // and set the current valid status to false:
                    valid = false;
                }else {
                    $('#'+z[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid #aaaaaa');
                }
            }
            // text areas
            for (i = 0; i < t.length; i++) {
                // If a field is empty...
                if (t[i].value == "" && $(t[i]).attr('required')) {
                    // add an "invalid" class to the field:
                    t[i].classList.add("invalid");
                    // and set the current valid status to false:
                    valid = false;
                }else {
                    t[i].classList.remove("invalid");
                }
            }

            return valid; // return the valid status
        }

        const form = document.querySelector('form.checkout-wrapper');

        document.querySelectorAll('.payment-method').forEach(box => {
            box.addEventListener('click', () => {
                document.querySelectorAll('.payment-method').forEach(b => b.classList.remove('active'));
                box.classList.add('active');

                if (box.classList.contains('cryptocurrency')) {
                    // form.action = "{{ url('pay/now') }}";

                    form.method = "post";
                } else if (box.classList.contains('credit_card')) {
                    // form.action = "{{ route('stripe.session') }}";

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
