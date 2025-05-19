

<div class="d-flex flex-row border-theme-1 background-theme-body-1 text-theme-primary p-4 br-7 mb-3">
    @if ($identity == 'buyer')        
    
        @if ($order->order_status == 'received' || $order->order_status == 'completed')

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-check2 fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h5 class="d-flex mb-2">Order {{ $order->order_status }}</h5>
                
                <p class="text-theme-secondary mb-0">Any questions? Chat with seller</p>
            </div>

        @elseif ($order->order_status == 'cancelled')

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-exclamation-circle fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column justify-content-center w-100">
                <h4 class="fw-bold">Order {{ $order->order_status }}:</h4>
                <div class="border-theme-1 background-theme-card br-7 p-3 px-4">
                    <div class="d-flex flex-column gap-1 mb-4">
                        <span class="text-theme-secondary">Cancelled by:</span>
                        <span>Seller</span>
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <span class="text-theme-secondary">Cancelation reason:</span>
                        <span>
                            @if ($order->cancelation_reason == 1)
                                Buyer has provided incorrect account information
                            @elseif ($order->cancelation_reason == 2)
                                Out of stock
                            @elseif ($order->cancelation_reason == 3)
                                Buyer does not meet criteria for the order
                            @elseif ($order->cancelation_reason == 4)
                                Buyer is unresponsive
                            @elseif ($order->cancelation_reason == 5)
                                Buyer does not need it anymore
                            @elseif ($order->cancelation_reason == 6)
                                Mutual agreement
                            @else
                                Other
                            @endif
                        </span>
                    </div>
                </div>
            </div>

        @elseif ($order->disputed == 1)

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-exclamation-circle fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column justify-content-center w-100">
                <h4 class="fw-bold">Order disputed:</h4>
                <div class="d-flex flex-column py-3 fs-13">
                    <p>Please try to resolve the problem directly with the seller</p>
                    <p>The Gamify team will review your case within 15 minutes</p>
                    <p>If we cannot settle it immediately, we will give the seller up to 24 hours to respond</p>
                    <p>Join support live chat if you have any questions!</p>
                </div>
                <div class="border-theme-1 background-theme-card br-7 p-3 px-4 mb-3">
                    <div class="d-flex flex-column gap-1 mb-4">
                        <span class="text-theme-secondary">Dispute reason:</span>
                        <span>
                            @if ($order->dispute_reason == 1)
                                Guaranteed delivery time is overdue
                            @elseif ($order->dispute_reason == 2)
                                Seller claims goods were delivered, but the order was not received
                            @elseif ($order->dispute_reason == 3)
                                Cannot claim purchase due to in-game issues
                            @elseif ($order->dispute_reason == 4)
                                Order is not as described
                            @elseif ($order->dispute_reason == 5)
                                Seller is unresponsive
                            @else
                                Other
                            @endif
                        </span>
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <span class="text-theme-secondary">Comment:</span>
                        <span>
                            {{$order->dispute_details}}
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row">
                    <button data-toggle="modal" data-target="#orderConfirmationModal" class="btn form__btn mb-2 mr-2 py-2">Mark as received</button>
                </div>
            </div>

        @elseif ($order->order_status == 'pending delivery' || $order->order_status == 'delivered')
            
            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-chat-right-text brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h5 class="d-flex mb-3">Chat with seller to arrange delivery</h5>
                <div class="d-flex flex-column flex-md-row">
                    <button data-toggle="modal" data-target="#orderConfirmationModal" class="btn form__btn mb-2 mr-2 py-2">Mark as received</button>
                    <button data-toggle="modal" data-target="#orderDisputeModal" class="btn btn-theme btn-theme-red py-2">Dispute Order</button>
                </div>
            </div>

        @endif
    @else
        @if($order->order_status == 'received' || $order->order_status == 'completed' || ($order->order_status == 'delivered' && $order->disputed == 0))

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-check2 fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h5 class="d-flex mb-2">Order {{ $order->order_status }}</h5>
                @if($order->order_status == 'delivered')
                <div class="d-flex flex-column flex-md-row">
                    <button data-toggle="modal" data-target="#cancelOrderModal" class="btn btn-theme btn-theme-red py-2">Cancel order</button>
                </div>            
                @endif
            </div>

        @elseif ($order->order_status == 'cancelled')

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-exclamation-circle fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column justify-content-center w-100">
                <h4 class="fw-bold">Order {{ $order->order_status }}:</h4>
                <div class="border-theme-1 background-theme-card br-7 p-3 px-4">
                    <div class="d-flex flex-column gap-1 mb-4">
                        <span class="text-theme-secondary">Cancelled by:</span>
                        <span>Seller</span>
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <span class="text-theme-secondary">Cancelation reason:</span>
                        <span>
                            @if ($order->cancelation_reason == 1)
                                Buyer has provided incorrect account information
                            @elseif ($order->cancelation_reason == 2)
                                Out of stock
                            @elseif ($order->cancelation_reason == 3)
                                Buyer does not meet criteria for the order
                            @elseif ($order->cancelation_reason == 4)
                                Buyer is unresponsive
                            @elseif ($order->cancelation_reason == 5)
                                Buyer does not need it anymore
                            @elseif ($order->cancelation_reason == 6)
                                Mutual agreement
                            @else
                                Other
                            @endif
                        </span>
                    </div>
                </div>
            </div>

        @elseif($order->disputed == 1)

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-exclamation-circle fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column justify-content-center w-100">
                <h4 class="fw-bold">Order disputed:</h4>
                <div class="d-flex flex-column py-3 fs-15">
                    <p class="mb-1">Please try to resolve the problem directly with the buyer</p>
                    <p>The Gamify team will review your case within 24 hours</p>
                </div>
                <div class="border-theme-1 background-theme-card br-7 p-3 px-4 mb-3">

                    <div class="d-flex flex-column gap-1 mb-4">
                        <span class="text-theme-secondary">Dispute reason:</span>
                        <span>
                            @if ($order->dispute_reason == 1)
                                Guaranteed delivery time is overdue
                            @elseif ($order->dispute_reason == 2)
                                Seller claims goods were delivered, but the order was not received
                            @elseif ($order->dispute_reason == 3)
                                Cannot claim purchase due to in-game issues
                            @elseif ($order->dispute_reason == 4)
                                Order is not as described
                            @elseif ($order->dispute_reason == 5)
                                Seller is unresponsive
                            @else
                                Other
                            @endif
                        </span>
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <span class="text-theme-secondary">Comment:</span>
                        <span>
                            {{$order->dispute_details}}
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row">
                    @if($order->delivered_at == null)
                    <button wire:click="deliverOrder('delivered')" class="btn form__btn mb-2 mr-2 py-2">Order delivered</button>
                    @endif
                    <button data-toggle="modal" data-target="#cancelOrderModal" class="btn btn-theme btn-theme-red py-2">Cancel order</button>
                </div>
            </div>

        @elseif ($order->order_status == 'pending delivery')

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-chat-right-text brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h5 class="d-flex mb-3">Chat with buyer to arrange delivery</h5>
                <div class="d-flex flex-column flex-md-row">
                    <button wire:click="deliverOrder('delivered')" class="btn form__btn mb-2 mr-2 py-2">Order delivered</button>
                    <button data-toggle="modal" data-target="#cancelOrderModal" class="btn btn-theme btn-theme-red py-2">Cancel order</button>
                </div>
            </div>
            
        @endif

    @endif
</div>