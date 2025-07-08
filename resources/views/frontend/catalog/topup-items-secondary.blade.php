@if ($secondary != null && $secondary->count() > 0)
    @php $i = 0; @endphp
    @foreach ($secondary as $key => $item)
        @php $i++ @endphp
        @foreach ($item->attributes as $attribute)
            @php if($attribute->topup == 1) {$topup_value = $attribute->pivot->value;} @endphp
        @endforeach
        @if ($i == 1)
            <h5 class="text-white">Other Sellers ({{$secondary->count()}})</h5>
        @endif
        <div class="bg-white brand-theme-dark br-2 mb-2">
            <div class="row p-3 px-4 align-items-center">
                <div class="d-flex col-7 col-md-3 text-left p-0">
                    @if($item->seller->profile !== null)
                        <img src="{{ url('uploads/profile/thumbnails') }}/{{$item->seller->profile}}" class="br-40 mr-2" alt="">
                    @else
                        <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                            {{ strtoupper(substr($item->seller->username,0,1)) }}
                        </div>
                    @endif
                    <div class="d-flex flex-column">
                        <div id="sellerName" class="small fw-bold">{{$item->seller->username}}</div>
                        <div class="d-flex align-items-center">
                            <i class="text-success bi bi-star-fill"></i>
                            <span class="text-black-70 mx-1 fs-13">{{ userFeedbackScore($item->seller->id) }}%</span>
                            <a target="_blank" href="{{ url('user-profile') }}/{{ $item->seller->username }}?tab=Feedback&feedbackRating=All" class="fs-13">
                                @php $totalFeedbacks = count(userPositiveFeebacks($item->seller->id)) + count(userNegativeFeebacks($item->seller->id)); @endphp
                                {{ number_format($totalFeedbacks) }} reviews
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-5 col-md-3 align-items-end d-flex flex-column align-items-end p-0">
                    <span class="d-none d-md-block fs-15 text-black-70">Delivery Time</span>
                    <span><i class="bi bi-clock d-md-none"></i> 12 h</span>
                </div>
                <div class="col-7 d-md-none p-0"></div>
                <div class="col-5 col-md-3 align-items-end d-flex flex-column align-items-end p-0">
                    <span class="d-none d-md-block fs-15 text-black-70">Price</span>
                    @if (isset($topup_value))
                    <strong class="f-15">${{ number_format($item->price * $topup_value, 2) }}</strong>
                    @elseif ($item->categoryGame->category_id == 1)
                    <strong class="f-15">${{ number_format($item->price , 4) }}</strong>
                    @else
                    <strong class="f-15">${{ number_format($item->price, 2) }}</strong>
                    @endif
                </div>
                <div class="col-7 d-md-none p-0"></div>
                <div class="col-5 col-md-3 d-flex justify-content-end mt-1 p-0">
                    <a href="{{ url('item/'.$item->id) }}" class="btn btn-dark fs-14 p-2 px-3">Buy now</a>
                </div>
            </div>
        </div>
    @endforeach
@endif
