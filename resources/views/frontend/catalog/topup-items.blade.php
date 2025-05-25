@if ($paginatedItems->count() > 0)
<div class="row-5-1">
    @php $i = 0; @endphp
    @foreach ($paginatedItems as $key => $item)
        <div class="position-relative">
            @php $i++ @endphp
            @foreach ($item->attributes as $attribute)
                @php if($attribute->topup == 1) {$topup_value = $attribute->pivot->value;} @endphp
            @endforeach
            <div class="drop-box d-flex flex-column br-10 item-select cursor-pointer topup_boxes topup_box_{{$topup_value}} animate-class @if($i==1) topup_active @endif" data-id="{{ $item->id }}">
                <div class="d-flex flex-column">
                    <img class="br-5"
                        src="{{ asset($item->feature_image !== null ? $item->feature_image : $item->categoryGame->feature_image) }}" width="40px">
                    
                    <strong class="fs-15">{{$topup_value}}</strong>
                    <span class="small">{{ $item->title != null ? $item->title : $item->categoryGame->title }}</span>
                </div>
                <div class="mt-3">
                    <strong>${{ number_format($item->price * $topup_value, 2) }}</strong>
                </div>
            </div>
            <div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">
                <div class="d-flex flex-column">
                    <div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>
                    
                    <div>
                        <span class="small px-5 skeleton">&nbsp;</span>
                    </div>
                </div>
                <div class="mt-3">
                    <strong class="px-4 skeleton">&nbsp;</strong>
                </div>
            </div>
        </div>
    @endforeach
</div>
@else
    <div class="row-5-1"></div>
    <div class="col-12 text-center text-muted py-5">
        <h5 class="no-data">No results found.</h5>
    </div>
@endif

@if ($paginatedItems->hasPages())
    <div class="col-12 d-flex justify-content-center mt-4">
        {!! $paginatedItems->links('pagination::bootstrap-4') !!}
    </div>
@endif