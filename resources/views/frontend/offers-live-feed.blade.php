@if (count($buyerRequest->requestOffers) !== 0)
    @foreach ($buyerRequest->requestOffers as $key => $offer)    
        <div class="row w-100 p-0 px-md-3 py-md-3 align-items-center border-bottom-thick">
            <div class="seller_details d-flex col-12 col-md-3 text-left border-m-bottom p-2 pt-3 p-md-0">
                <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                    {{ strtoupper(substr($offer->user->name,0,1)) }}
                </div>
                <div class="d-flex flex-column">
                    <div id="sellerName" class="fs-15 fw-bold">{{$offer->user->name}}</div>
                    <div class="d-flex align-items-center">
                        <i class="text-success bi bi-star-fill"></i>
                        <span class="text-black-70 mx-1 fs-13">99.3%</span>
                        <a href="#" class="fs-13">27,066 reviews</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 align-items-start align-items-md-end d-flex flex-column border-m-bottom p-2 p-md-0">
                <span class="d-none d-md-block fs-15 text-black-70">Delivery Time</span>
                <span><i class="bi bi-clock d-md-none"></i> {{$offer->delivery_time}}</span>
            </div>
            <div class="col-6 col-md-3 align-items-end d-flex flex-column align-items-end border-m-bottom p-2 p-md-0">
                <span class="d-none d-md-block fs-15 text-black-70">Price</span>
                <strong class="f-15">${{$offer->price}}</strong>
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-start align-items-center justify-content-md-end border-bottom-0_5 border-md-none mt-1 p-2 pb-3 p-md-0">
                @if($buyerRequest->user_id == auth()->user()->id)
                <form method="GET" action="{{ route('checkout') }}" class="">
                    @csrf
                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                    <input type="hidden" name="price" value="{{ $offer->price }}">
                    <input type="hidden" id="total-price" name="totalPrice" value="{{ $offer->price }}">
                    
                    @if(count($buyerRequest->buyerRequestConversation->where('seller_id', $offer->user_id)) == 0)
                    <button type="button" onclick="Livewire.dispatch('start-chat', { buyerId: {{ $buyerRequest->user_id }}, sellerId: {{ $offer->user->id }} });HideById('chat-btn-{{ $key }}');scrollToClass('live-chat');" id="chat-btn-{{$offer->user->id}}" class="btn btn-secondary fs-14 p-2 px-3 mr-2">Chat</button>
                    @endif
                    <button type="submit" class="btn btn-dark fs-14 p-2 px-3">Checkout</button>
                </form>
                @else
                    @if($buyerRequest->status == 'closed')
                        @if($buyerRequest->seller_id == $offer->user_id)
                            <span class="text-theme-emerald fw-bold mr-2">SOLD</span>
                        @endif

                        @if($offer->user_id == auth()->id())
                            @if($buyerRequest->seller_id == auth()->id())
                                <a wire:navigate href="{{ url('order') }}/{{ $offer->order->order_id }}" class="btn btn-dark">View Order</a>
                            @else
                                {{-- Delete edit buttons --}}
                            @endif
                        @endif
                    @else
                        {{-- Delete edit buttons --}}
                    @endif
                @endif
            </div>
        </div>
    @endforeach
@elseif (1 == 1)
    @if($buyerRequest->user_id !== auth()->user()->id)
    <div class="d-flex flex-column align-items-center p-5">
        <div class="fs-17 fw-bold mb-1">Create your offer</div>
        <div class="fs-13 text-black-70 text-center">You will also see offers from other sellers so you can compare them and give a better offer.</div>
    </div>
    @else
    <div class="d-flex flex-column align-items-center p-5">
        <img src="{{asset('images/working.gif')}}" width="166px" class="mb-2">
        <div class="fs-17 fw-bold mb-1">Sellers are prepairing offers...</div>
        <div class="fs-15 text-center">Just relax and wait. It takes up to 5 minutes to recieve the first offer.</div>
    </div>
    @endif
@elseif ($offer->status == 'cancelled')
    <div class="p-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="red" class="bi bi-x mb-3" viewBox="4 4 8 8">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
        </svg>
        <div class="text-black-80 fw-bold">Boosting request is canceled</div>
    </div>
@endif