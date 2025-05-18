

<div class="d-flex flex-row align-items-center border-theme-1 background-theme-body-1 text-theme-primary p-4 br-7 mb-3">
    @if ($identity == 'buyer')
        @if ($order->order_status == 'pending delivery' || $order->order_status == 'delivered')
            
            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-chat-right-text brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-3">Chat with seller to arrange delivery</h5>
                <div class="d-flex flex-column flex-md-row">
                    <button data-toggle="modal" data-target="#orderConfirmationModal" class="btn form__btn mb-2 mr-2 py-2">Mark as recieved</button>
                    <button class="btn btn-theme btn-theme-red py-2">Dispute Order</button>
                </div>
            </div>

        @elseif ($order->order_status == 'cancelled')

            <div class="d-flex flex-row border-theme-1 background-theme-body-1 text-theme-primary w-100 p-3 br-7 mb-3">
                <div class="d-flex big-icon-bg mr-3">
                    <i class="bi bi-exclamation-circle fs-md-50 brand-theme-dark"></i>
                </div>
                <div class="d-flex flex-column w-100">
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
            </div>

        @else

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-check2 fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-2">Order {{ $order->order_status }}</h5>
                
                <p class="text-theme-secondary mb-0">Any questions? Chat with seller</p>
                
            </div>

        @endif
    @else

        @if ($order->order_status == 'pending delivery')

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-chat-right-text brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-3">Chat with buyer to arrange delivery</h5>
                <div class="d-flex flex-column flex-md-row">
                    <button wire:click="deliverOrder('delivered')" class="btn form__btn mb-2 mr-2 py-2">Order delivered</button>
                    <button data-toggle="modal" data-target="#cancelOrderModal" class="btn btn-theme btn-theme-red py-2">Cancel order</button>
                </div>
            </div>
            
        @elseif ($order->order_status == 'cancelled')

            <div class="d-flex flex-row border-theme-1 background-theme-body-1 text-theme-primary w-100 p-3 br-7 mb-3">
                <div class="d-flex big-icon-bg mr-3">
                    <i class="bi bi-exclamation-circle fs-md-50 brand-theme-dark"></i>
                </div>
                <div class="d-flex flex-column w-100">
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
            </div>

        @else

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-check2 fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-2">Order {{ $order->order_status }}</h5>
                @if($order->order_status == 'delivered')
                <div class="d-flex flex-column flex-md-row">
                    <button data-toggle="modal" data-target="#cancelOrderModal" class="btn btn-theme btn-theme-red py-2">Cancel order</button>
                </div>            
                @endif
            </div>

        @endif

    @endif
</div>