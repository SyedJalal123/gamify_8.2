

<div class="d-flex flex-row align-items-center border-theme-1 background-theme-body-1 text-theme-primary p-4 br-7 mb-3">
    @if ($identity == 'buyer')
        @if ($order->order_status == 'pending_delivery' || $order->order_status == 'delivered')
            
            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-chat-right-text brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-3">Chat with seller to arrange delivery</h5>
                <div class="d-flex flex-column flex-md-row">
                    <button data-toggle="modal" data-target="#orderConfirmationModal" class="btn form__btn mb-2 mr-2 py-2">Mark as recieved</button>
                    <button class="btn btn-theme-red py-2">Dispute Order</button>
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

        @if ($order->order_status == 'pending_delivery')

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-chat-right-text brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-3">Chat with buyer to arrange delivery</h5>
                <div class="d-flex flex-column flex-md-row">
                    <button wire:click="deliverOrder('delivered')" class="btn form__btn mb-2 mr-2 py-2">Order delivered</button>
                    <button class="btn btn-theme-red py-2">Cancel order</button>
                </div>
            </div>
            
        @else

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-check2 fs-md-50 brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-2">Order {{ $order->order_status }}</h5>                
            </div>

        @endif

    @endif
</div>