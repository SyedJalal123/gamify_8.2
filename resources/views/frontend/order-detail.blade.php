@extends('frontend.app')

@section('css')
    <style>
        .section--first {
            padding-top: 144px !important;
        }
        @media (max-width: 768px) { 
           .section--first {
                padding-top: 144px !important;
            } 
        }
        .d-none {
            display: none !important;
        }
        @media (min-width: 768px) {
            .d-md-block {
                display: block !important;
            }
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="{{asset('css/live-chat.css')}}">
@endsection

@section('content')
    
    @php
        $quantity = $order->quantity;
        $unitPrice = $order->price;
        $paymentFee = $order->payment_fee;
        $totalPrice = $order->total_price - $order->payment_fee;
        $grandTotal = $order->total_price;
        $discountPercentage = $order->discount_in_per;
        $loyaltyPoints = floor($totalPrice * 100);
    @endphp

    <section class="section section--bg section--first fs-14" style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
        <div class="container pb-5"> 

            <div class="top-bar-page text-white mt-2 mb-4">
                <div class="d-flex flex-row justify-content-between align-items-center gap-4">
                    <a href="{{ url()->previous() }}" class="text-muted d-inline-block">&larr;&nbsp;Back</a>
                    <div class="text-theme-secondary fs-14 d-md-none one-line-ellipsis"><span class="">Order ID: {{ $order->order_id }}</span></div>
                    <button class="btn btn-small-1 d-md-none">Copy</button>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-between my-4">
                    <div class="d-flex">
                        <img src="{{ asset($categoryGame->feature_image ? $categoryGame->feature_image : ($item == null ? $categoryGame->game->image : $item->images_path.'thumbnails/'.$item->feature_image)) }}" alt="Image" width="65" height="65" class="rounded mr-3 mt-1 mt-md-0">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-column">
                                <span class="mb-2 text-theme-primary fw-bold fs-14 two-line-ellipsis">{{ $order->title }}</span>
                                <span class="text-theme-secondary fs-14 d-none d-md-block">Order ID: {{ $order->order_id }}</span>
                            </div>
                            <div class="d-flex align-items-center d-md-none">
                                <span class="@if($order->order_status == 'pending delivery') btn-theme-pill-yellow @elseif($order->order_status == 'recieved' || $order->order_status == 'delivered') btn-theme-pill-blue @else btn-theme-pill @endif text-capitalize pill-order-status">
                                    {{ $order->order_status }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex align-items-center d-none d-md-block">
                        <span class="@if($order->order_status == 'pending delivery') btn-theme-pill-yellow @elseif($order->order_status == 'recieved' || $order->order_status == 'delivered') btn-theme-pill-blue @else btn-theme-pill  @endif text-capitalize pill-order-status">
                            {{ $order->order_status }}</span>
                    </div>
                </div>
            </div>

            <div class="d-flex row">
                <div class="col-lg-8 d-flex flex-column mb-3">
                    @if($item !== null && $item->account_info != null)
                    <div class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary w-100 p-3 br-7 mb-3">
                        <h4 class="fw-bold">Account details:</h4>
                        <div class="border-theme-1 background-theme-card br-7 p-2">
                            @foreach (json_decode($item->account_info) as $account)
                                <div style="white-space: pre-line; overflow: hidden;">{!! $account !!}</div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <livewire:seller-verification-component :order="$order" :identity="$identity" />
                    
                    @if($identity == 'buyer')
                    <div class="@if($order->order_status == 'pending delivery' || $order->order_status == 'delivered') d-none @endif order-feedback-container d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary p-4 br-7 mb-3">
                        <form method="post" action="#" class="d-flex flex-column align-items-center">
                            <h5 class="fw-bold">Leave feedback for the seller</h5>
                            <div class="d-flex flex-row align-items-center mb-3">
                                <i class="fa-solid fa-crown mr-2"></i>
                                <div class="order-feedback-loyalty-text"> Write a review to complete achievements and receive rewards! </div>
                            </div>
                            <div class="d-flex flex-column w-100">
                                <div class="rating-icons d-flex flex-row justify-content-center mb-3">
                                    <label for="positive" class="feedback-icon active positive">
                                        <i class="fa fa-thumbs-up"></i>
                                        <input id="positive" type="radio" name="feedback" value="1" hidden checked>
                                    </label>
                                    <label for="negative" class="feedback-icon negative ml-2">
                                        <i class="fa fa-thumbs-down"></i>
                                        <input id="negative" type="radio" name="feedback" value="2" hidden>
                                    </label>
                                    <!---->
                                </div>
                                <!---->
                                <div class="textarea-box w-100 mb-2">
                                    <div class="textarea-head d-flex flex-row justify-content-between">
                                        <label> Add a comment <span class="label-suffix">(Optional)</span></label>
                                        <span class="text-black-70"> 0/500</span>
                                    </div>
                                    <textarea class="textarea input-theme-1 form-control" placeholder="Tell us about your experience" aria-label="Add a comment" maxlength="500" required></textarea>
                                </div>
                                <!---->
                            </div>
                            <div>
                                <button id="submit-button" class="btn btn-theme-1 fw-bold">Leave Feedback</button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <div class="live-chats m-0 p-0 chat">
                        @livewire('OrderChat', ['conversation' => $conversation, 'identity' => $identity])
                    </div>
                </div>
                <div class="col-lg-4 d-flex flex-column">
                    <div class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary w-100 p-2 px-3 br-7 h-fit mb-3">
                        <span class="fw-bold mb-3" id="delivery-time-title">{{ $order->delivered_at ? 'Delivery time' : 'Guaranteed delivery time'}}</span>
                        <div class="text-center fs-18 pb-4">
                            @if($item !== null && $item->delivery_method == 'automatic') 
                               <i class="bi bi-lightning-charge-fill text-light-blue mr-2"></i><span>Instant delivery</span>
                            @else 
                                <livewire:countdown-component :order="$order" :maxDeliveryTime="$maxDeliveryTime" />
                                {{-- <i class="bi bi-clock text-default mr-2"></i><span>{{ $item !== null ? $item->delivery_time : $offer->delivery_time}} </span> --}}
                            @endif
                        </div>
                    </div>
                    <div class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary w-100 p-3 pb-4 br-7 h-fit mb-3">
                        <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                            <span class="fw-bold">Order details</span>
                            <span class="@if($order->order_status == 'pending delivery') btn-theme-pill-yellow @elseif($order->order_status == 'recieved' || $order->order_status == 'delivered') btn-theme-pill-blue @else btn-theme-default  @endif text-capitalize pill-order-status">
                                {{ $order->order_status }}</span>
                        </div>
                        <div class="d-flex flex-column gap-12px">
                            <div class="d-flex justify-content-between">
                                <span class="text-theme-secondary">Game</span>
                                <span class="text-theme-primary">{{ $categoryGame->game->name }}</span>
                            </div>
                            @if ($item != null)
                                @foreach ($item->attributes as $attribute)
                                    <div class="d-flex justify-content-between">
                                        <span class="text-theme-secondary">{{ $attribute->name }}</span>
                                        <span class="text-theme-primary">{{ $attribute->pivot->value }}</span>
                                    </div>
                                @endforeach
                            @endif
                            <div class="d-flex justify-content-between">
                                <span class="text-theme-secondary">Seller</span>
                                <span class="text-theme-primary"><a href="#" class="">{{ $item != null ? $item->seller->name : $offer->user->name }}</a></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-theme-secondary">Total Price</span>
                                <span class="text-theme-primary">${{ $order->total_price }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-theme-secondary">Receipt sent</span>
                                <span class="text-theme-primary">{{ $order->buyer->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary w-100 p-3 pb-4 br-7 h-fit mb-3 gap-12px">
                        <div class="d-flex flex-row align-items-center">
                            <img src="{{ asset('images/helping-hand.svg') }}" class="mr-2" alt="Need Help">
                            <span class="fw-bold fs-15">Need Help?</span>
                        </div>
                        <div class="d-flex">
                            <p class="m-0 text-theme-secondary">Have questions or issues with your order? Contact the seller directly – they're ready to assist!</p>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-theme-1 w-100 py-2">Contact Seller</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="pageOverlay">
        <div class="spinner-border text-light" role="status"></div>
    </div>

    <!-- Order Confirmation Modal -->
    <div class="modal fade" id="orderConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="orderConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="orderConfirmationModalLabel">Order recieved confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <div class="form-check mb-2">
                            <input class="w-auto form-check-input" type="checkbox" id="orderRecievedConfirmation" name="orderRecievedConfirmation" required>
                            <label class="form-check-label fs-13 fs-md-15">
                                <p>By clicking "Mark as received", I confirm that I fully received my order, and the product matches the offer description.</p>
                                
                                <p class="fs-13 fs-md-15">After this, you are no longer eligible for a refund. Never confirm early, even if the seller has asked you to.</p>
                                <p id="orderRecievedConfirmationError" class="text-theme-cherry d-none">Please confirm you received your order before continuing.</p>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="
                    if (document.getElementById('orderRecievedConfirmation').checked) {
                        Livewire.dispatch('deliverOrder', { orderStatus: 'recieved' });
                        $('#orderConfirmationModal').modal('hide'); // jQuery-based close
                    } else {
                        $('#orderRecievedConfirmationError').removeClass('d-none');
                    }
                " class="btn btn-primary">Verify</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $('#submit-button').on('click', function() {
            // Check if the form is valid
            if (validateForm()) {
                const overlay = document.getElementById('pageOverlay');
                overlay.style.display = 'flex';

                $('#checkout-form').submit();
                
            }
        });

        document.querySelectorAll('.feedback-icon').forEach(input => {
            input.addEventListener('click', function () {
                // Remove active from all labels
                document.querySelectorAll('.feedback-icon').forEach(label => {
                    label.classList.remove('active');
                });

                // Add active to the label of the checked input
                this.closest('label').classList.add('active');
            });
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
            alert();
        }

        $(document).ready(function() {
            setTimeout(() => {
                scroll_bottom('.msg_card_body');
            }, 0.1);
            
        });

        Livewire.on('message-updated', () => {
            setTimeout(() => {
                let buffer = 350; // pixels from bottom
                let $el = $('.msg_card_body');
                let isNearBottom = $el.scrollTop() + $el.innerHeight() >= $el[0].scrollHeight - buffer;

                if(isNearBottom){
                    scroll_bottom('.msg_card_body');
                }
            }, 0.1);
        });

        Livewire.on('orderDelivered', (data) => {
            $('#delivery-time-title').text('Delivery time');
            $('.pill-order-status').text(data['orderStatus']).addClass('btn-theme-pill-blue');

            if(data['orderStatus'] == 'recieved' || data['orderStatus'] == 'completed'){
                $('.order-feedback-container').removeClass('d-none');
            }

        });
    </script>

    <!-- Initialize Echo private channel listener for user notifications -->
    @auth
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const userId = window.Laravel.user.id; // Pass user ID from Laravel to JS
                let unreadCount = parseInt(document.querySelector('.count-notifications').textContent) || 0;

                Echo.private(`chat-channel.${userId}`)
                    .listen('MessageSentEvent', (e) => {
                        Livewire.dispatch('message-received', [e.message]);
                    });

                Echo.private(`message-seen.${userId}`)
                    .listen('MessageSeenEvent', (e) => {
                        Livewire.dispatch('chat-seen', [e]);
                    });
            });
        </script>
    @endauth

    @endsection
