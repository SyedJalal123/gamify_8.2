

<div class="d-flex flex-row border-theme-1 background-theme-body-1 text-theme-primary p-4 br-7 mb-3">
    @if ($order->delivered_at)

        <button class="bg-green-500 text-white px-4 py-2" disabled>Order Delivered</button>

    @else

        @if ($identity === 'seller')

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-chat-right-text brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-3">Chat with seller to arrange delivery</h5>
                <div class="d-flex flex-row">
                    <button data-toggle="modal" data-target="#orderConfirmationModal" class="btn form__btn mr-2 py-2">Mark as recieved</button>
                    <button class="btn btn-theme-red py-2">Dispute Order</button>
                </div>
            </div>

        @elseif ($identity === 'buyer')

            <div class="d-flex big-icon-bg mr-3">
                <i class="bi bi-chat-right-text brand-theme-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="d-flex mb-3">Chat with buyer to arrange delivery</h5>
                <div class="d-flex flex-row">
                    <button wire:click="deliverOrder" class="btn form__btn mr-2 py-2">Order delivered</button>
                    <button class="btn btn-theme-red py-2">Cancel order</button>
                </div>
            </div>

        @endif

    @endif
</div>