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
                    <a wire:navigate href="{{ url()->previous() }}" class="text-muted d-inline-block">&larr;&nbsp;Back</a>
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
                            @php
                                if($order->order_status == 'completed') {
                                    $order_pill_class = 'btn-theme-pill-green';
                                }
                                elseif($order->order_status == 'received' || $order->order_status == 'delivered') 
                                {
                                    $order_pill_class = 'btn-theme-pill-blue';
                                }
                                elseif($order->order_status == 'cancelled') 
                                {
                                    $order_pill_class = 'btn-theme-pill-red';
                                }
                                elseif($order->order_status == 'pending delivery')
                                {
                                    $order_pill_class = 'btn-theme-pill-yellow';
                                } 
                                else
                                {
                                    $order_pill_class = 'btn-theme-pill-default';
                                }
                            @endphp
                            <div class="d-flex align-items-center d-md-none">
                                <span class="btn-theme-pill {{ $order_pill_class }} text-capitalize pill-order-status">
                                    {{ $order->order_status }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex align-items-center d-none d-md-block">
                        <span class="btn-theme-pill {{ $order_pill_class }} text-capitalize pill-order-status">
                            {{ $order->order_status }}</span>
                    </div>
                </div>
            </div>

            <div class="d-flex row">
                <div class="col-lg-8 d-flex flex-column mb-3">
                    @if($item !== null && $item->delivery_method == 'automatic' && $item->account_info != null) 
                        <!-- For Accounts -->
                        @if ($identity == 'seller')
                            <div class="d-flex flex-row border-theme-1 background-theme-body-1 text-theme-primary w-100 p-3 br-7 mb-3">
                                <div class="d-flex big-icon-bg mr-3">
                                    <i class="bi bi-check2 fs-md-50 brand-theme-dark"></i>
                                </div>
                                <div class="d-flex flex-column w-100">
                                    <h4 class="fw-bold">Order {{ $order->order_status }}:</h4>
                                    <div class="border-theme-1 background-theme-card br-7 p-2">
                                        <div style="white-space: pre-line; overflow: hidden;">{!! $item->account_info[$order->account_id]['info'] !!}</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary w-100 p-3 br-7 mb-3">
                                <h4 class="fw-bold">Account details:</h4>
                                <div class="border-theme-1 background-theme-card br-7 p-2">
                                    <div style="white-space: pre-line; overflow: hidden;">{!! $item->account_info[$order->account_id]['info'] !!}</div>
                                </div>
                            </div>
                        @endif
                    @else
                        <!-- Order Details -->
                        <livewire:seller-verification-component :order="$order" :identity="$identity" :conversation="$conversation" />
                    @endif
                    
                    <!-- Adding Review -->
                    @if($identity == 'buyer')
                    <div id="review-form" class="@if($order->order_status == 'pending delivery' || $order->order_status == 'delivered' || ($order->disputed == 1 && ($order->order_status == 'pending delivery' || $order->order_status == 'delivered')) || $order->feedback !== 0) d-none @endif order-feedback-container d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary p-4 br-7 mb-3">
                        <form method="post" action="{{ route('save-review') }}" class="d-flex flex-column align-items-center">
                            @csrf
                            <h5 class="fw-bold">Leave feedback for the seller</h5>
                            <div class="d-flex flex-row align-items-center mb-3">
                                <i class="fa-solid fa-crown mr-2"></i>
                                <div class="order-feedback-loyalty-text"> Write a review to complete achievements and receive rewards! </div>
                            </div>
                            <div class="d-flex flex-column w-100">
                                <div class="rating-icons d-flex flex-row justify-content-center mb-3">
                                    <label for="positive" class="feedback-icon {{ $order->feedback == 1 ? 'active' : '' }}  {{ $order->feedback == 0 ? 'active' : '' }} positive">
                                        <i class="fa fa-thumbs-up"></i>
                                        <input id="positive" type="radio" name="feedback" value="1" hidden {{ $order->feedback == 1 ? 'checked' : '' }} {{ $order->feedback == 0 ? 'checked' : '' }} >
                                    </label>
                                    <label for="negative" class="feedback-icon {{ $order->feedback == 2 ? 'active' : '' }} negative ml-2">
                                        <i class="fa fa-thumbs-down"></i>
                                        <input id="negative" type="radio" name="feedback" value="2" hidden {{ $order->feedback == 2 ? 'checked' : '' }}>
                                    </label>
                                    <!---->
                                </div>
                                <!---->
                                <div class="textarea-box w-100 mb-2">
                                    <div class="textarea-head d-flex flex-row justify-content-between">
                                        <label> Add a comment <span class="label-suffix">(Optional)</span></label>
                                        <span class="text-black-70"> 0/500</span>
                                    </div>
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <textarea name="feedback_comment" class="textarea input-theme-1 form-control" placeholder="Tell us about your experience" aria-label="Add a comment" maxlength="500">{{ $order->feedback !== 0 ? $order->feedback_comment : ''}}</textarea>
                                </div>
                                <!---->
                            </div>
                            <div>
                                <button id="submit-button" class="btn btn-theme btn-theme-default fw-bold">Leave Feedback</button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <!-- Showing Review -->
                    @if($order->review !== 0)
                        <div id="feedback-show" class="@if($order->order_status == 'pending delivery' || $order->order_status == 'delivered' || ($order->disputed == 1 && ($order->order_status == 'pending delivery' || $order->order_status == 'delivered')) || $order->feedback == 0) d-none @endif d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary p-4 br-7 mb-3">
                            <div class="d-flex flex-column" >
                                @if ($identity == 'buyer')
                                <p>Thank you for your feedback!</p>
                                @elseif ($identity == 'seller')
                                <p>Buyer feedback</p>
                                @endif
                                <div class="border-theme-1 background-theme-card br-7 p-3 px-4 d-flex flex-row align-items-center position-relative">
                                    @if($order->feedback == 1)
                                    <i class="fa fa-thumbs-up fs-25 pr-4 text-theme-teal"></i>
                                    @else
                                    <i class="fa fa-thumbs-down fs-25 pr-4 text-theme-cherry"></i>
                                    @endif
                                    <div class="d-flex fs-14"
                                                style="white-space: pre-line; overflow: hidden;">{!! $order->feedback_comment !!}</div>

                                    @if ($identity == 'buyer')
                                        <div class="position-absolute top-0 right-0 p-1 px-2 cursor-pointer" onclick="$('#review-form').removeClass('d-none');$('#feedback-show').addClass('d-none');"><i class="bi bi-pencil-square"></i></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Live Chat -->
                    <div class="live-chats m-0 p-0 chat">
                        @livewire('Openchat', ['buyerRequestConversation' => $conversation, 'identity' => $identity])
                        {{-- @livewire('OrderChat', ['conversation' => $conversation, 'identity' => $identity]) --}}
                    </div>
                </div>

                <!-- Right Side Bar -->
                <div class="col-lg-4 d-flex flex-column">
                    <div id="delivery-time-container" class="@if($order->cancelled_at !== null) d-none @endif d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary w-100 p-2 px-3 br-7 h-fit mb-3">
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
                            <span class="btn-theme-pill {{ $order_pill_class }} text-capitalize pill-order-status">
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
                                <span class="text-theme-primary"><a href="#" class="">{{ $item != null ? $item->seller->name : $offer->user->username }}</a></span>
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
                            <button class="btn btn-theme btn-theme-default w-100 py-2">Contact Seller</button>
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
                <h5 class="modal-title" id="orderConfirmationModalLabel">Order received confirmation</h5>
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
                        Livewire.dispatch('deliverOrder', { orderStatus: 'received' });
                        $('#orderConfirmationModal').modal('hide'); // jQuery-based close
                    } else {
                        $('#orderRecievedConfirmationError').removeClass('d-none');
                    }
                " class="btn btn-primary">Verify</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Cancelation Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="cancelOrderModalLabel">Cancel order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div x-data class="d-flex flex-column fs-14">
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="cancelation_reason" value="1" class="w-auto mr-2" checked="" id="radio_account_incorrect_info">
                            <label class="m-0" for="radio_account_incorrect_info">Buyer has provided incorrect account information</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="cancelation_reason" value="2" class="w-auto mr-2" id="radio_out_of_stock">
                            <label class="m-0" for="radio_out_of_stock">Out of stock</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="cancelation_reason" value="3" class="w-auto mr-2" id="radio_buyer_doesnt_meet_criteria">
                            <label class="m-0" for="radio_buyer_doesnt_meet_criteria">Buyer does not meet criteria for the order</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="cancelation_reason" value="4" class="w-auto mr-2" id="radio_buyer_is_unresponsive">
                            <label class="m-0" for="radio_buyer_is_unresponsive">Buyer is unresponsive</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="cancelation_reason" value="5" class="w-auto mr-2" id="radio_buyer_doesnt_need_it">
                            <label class="m-0" for="radio_buyer_doesnt_need_it">Buyer does not need it anymore</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="cancelation_reason" value="6" class="w-auto mr-2" id="radio_mutual_agreement">
                            <label class="m-0" for="radio_mutual_agreement">Mutual agreement</label>
                        </div>
                        <div class="form-check pb-2 mb-2 d-flex align-items-center dividor-border-theme-bottom">
                            <input type="radio" name="cancelation_reason" value="7" class="w-auto mr-2" id="radio_other">
                            <label class="m-0" for="radio_other">Other</label>
                        </div>
                        <div class="form-check textarea-box w-100 mb-2">
                            <div class="textarea-head d-flex flex-row justify-content-between">
                                <label>Share details</label>
                                <span class="text-black-70"> 0/500</span>
                            </div>
                            <textarea id="cancelation_details" class="textarea input-theme-1 form-control" placeholder="Tell us what happened" aria-label="Tell us what happened" maxlength="500" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="
                    if (document.getElementById('cancelation_details').value !== '') {
                        Livewire.dispatch('cancelOrder', { 
                            reason: document.querySelector('input[name=cancelation_reason]:checked').value, 
                            orderStatus: 'cancelled',
                            details: document.getElementById('cancelation_details').value,
                        });
                        $('#cancelation_details').removeClass('invalid');
                        $('#cancelOrderModal').modal('hide'); // jQuery-based close
                    } else {
                        $('#cancelation_details').addClass('invalid');
                    }
                "
                class="btn btn-danger"
                >Cancel Order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Dispute Modal -->
    <div class="modal fade" id="orderDisputeModal" tabindex="-1" role="dialog" aria-labelledby="orderDisputeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="orderDisputeModalLabel">Cancel order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div x-data class="d-flex flex-column fs-14">
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="dispute_reason" value="1" class="w-auto mr-2" checked="" id="radio_guaranteed_delivery_time_overdue">
                            <label class="m-0" for="radio_guaranteed_delivery_time_overdue">Guaranteed delivery time is overdue</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="dispute_reason" value="2" class="w-auto mr-2" id="radio_seller_claims_but_goods_not_received">
                            <label class="m-0" for="radio_seller_claims_but_goods_not_received">Seller claims goods were delivered, but the order was not received</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="dispute_reason" value="3" class="w-auto mr-2" id="radio_cannot_claim_purchase_due_to_ingame_issue">
                            <label class="m-0" for="radio_cannot_claim_purchase_due_to_ingame_issue">Cannot claim purchase due to in-game issues</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="dispute_reason" value="4" class="w-auto mr-2" id="radio_order_is_not_as_described">
                            <label class="m-0" for="radio_order_is_not_as_described">Order is not as described</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="dispute_reason" value="5" class="w-auto mr-2" id="radio_seller_is_unresponsive">
                            <label class="m-0" for="radio_seller_is_unresponsive">Seller is unresponsive</label>
                        </div>
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="dispute_reason" value="6" class="w-auto mr-2" id="radio_other">
                            <label class="m-0" for="radio_other">Other</label>
                        </div>
                        <div class="form-check textarea-box w-100 mb-2">
                            <div class="textarea-head d-flex flex-row justify-content-between">
                                <label>Share details</label>
                                <span class="text-black-70"> 0/500</span>
                            </div>
                            <textarea id="dispute_details" class="textarea input-theme-1 form-control" placeholder="Tell us what happened" aria-label="Tell us what happened" maxlength="500" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="
                    if (document.getElementById('dispute_details').value !== '') {
                        Livewire.dispatch('disputeOrder', { 
                            reason: document.querySelector('input[name=dispute_reason]:checked').value, 
                            details: document.getElementById('dispute_details').value,
                        });
                        $('#dispute_details').removeClass('invalid');
                        $('#orderDisputeModal').modal('hide'); // jQuery-based close
                    } else {
                        $('#dispute_details').addClass('invalid');
                    }
                "
                class="btn btn-danger"
                >Dispute Order</button>
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

                $('#review-form').submit();
                
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
        }

        $(document).ready(function() {
            setTimeout(() => {
                scroll_bottom('.msg_card_body');
            }, 500);
        });
        
        if (!window.messageUpdatedListener) {
            window.messageUpdatedListener = true;

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
        }

        if (!window.orderDeliveredListener) {
            window.orderDeliveredListener = true;

            Livewire.on('orderDelivered', (data) => {
                $('#delivery-time-title').text('Delivery time');
                $('.pill-order-status').text(data['orderStatus']).addClass('btn-theme-pill-blue');

                if(data['orderStatus'] == 'received' || data['orderStatus'] == 'completed'){
                    $('.order-feedback-container').removeClass('d-none');
                }
            });
        }

        if (!window.orderCancelledListener) {
            window.orderCancelledListener = true;

            Livewire.on('orderCancelled', (data) => {
                $('#delivery-time-title').text('Delivery time');
                $('.pill-order-status').text(data['orderStatus']).addClass('btn-theme-pill-red');

                $('.order-feedback-container').removeClass('d-none');
                $('#delivery-time-container').addClass('d-none');

            });
        }

        if (!window.orderDisputedListener) {
            window.orderDisputedListener = true;

            Livewire.on('orderDisputed', (data) => {
                // $('.order-feedback-container').removeClass('d-none');
            });
        }
    </script>

    <!-- Initialize Echo private channel listener for user notifications -->
    @auth
        <script>
            $(document).ready(function() {
                const userId = window.Laravel.user.id; // Pass user ID from Laravel to JS
                const orderId = {{ $order->id }};
                const conversationId = {{ $conversation->id }};

                let unreadCount = parseInt(document.querySelector('.count-notifications').textContent) || 0;

                if (!window.chat_channel) {
                    window.chat_channel = {};
                }
                if (!window.admin_chat_channel) {
                    window.admin_chat_channel = {};
                }
                if (!window.message_seen) {
                    window.message_seen = {};
                }
                if (!window.order_page_update) {
                    window.order_page_update = {};
                }

                if (!window.chat_channel[userId]) {
                    Echo.private(`chat-channel.${userId}`)
                        .listen('MessageSentEvent', (e) => {
                            Livewire.dispatch('message-received', [e.message]);
                        });
                    window.chat_channel[userId] = true;
                }

                if (!window.admin_chat_channel[userId]) {
                    Echo.private(`admin-chat-channel`)
                        .listen('AdminMessageSentEvent', (e) => {
                            Livewire.dispatch('message-received', [e.message]);
                        });
                    window.admin_chat_channel[userId] = true;
                }
                
                if (!window.message_seen[userId]) {
                    Echo.private(`message-seen.${userId}`)
                        .listen('MessageSeenEvent', (e) => {
                            Livewire.dispatch('chat-seen', [e]);
                        });                    
                    window.message_seen[userId] = true;
                }

                if (!window.order_page_update[orderId]) {
                    Echo.private(`order-page-update.${orderId}`)
                        .listen('OrderEvent', (e) => {
                            if (e['sender_id'] !== userId) {
                                Livewire.dispatch('order-update', [e]);
                            }
                        });
                    window.order_page_update[userId] = true;
                }
            });
        </script>
    @endauth

@endsection
