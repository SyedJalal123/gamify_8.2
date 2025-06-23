<div class="col-12 mb-1 p-0 text-white" id="itemCount">
    <p class="m-0 text-theme-grey fs-14">{{ $items->count() }} items found</p>
</div>
<div id="itemsContainer">
    @if ($items->count() > 0)
    <div class="row-3-2-1">
        @foreach ($items as $item)
        <div class="position-relative">
            <a wire:navigate href="{{ route('item.detail', $item->id) }}" class="text-dark text-decoration-none animate-class">
                <div class="drop-box">
                    <div class="d-flex flex-row">
                        @if (Request::segment(1) == 'user-profile')
                            <img src="{{ url('uploads/games/28_'.$item->categoryGame->game->image_name) }}" alt="" width="28px" height="28px" class="mr-2">
                        @endif
                        <p class="">
                            @php $topupValue = 1; @endphp
                            @foreach ($item->attributes as $key => $attribute)
                                @if ($attribute->applies_to == 1)
                                    <strong>@if ($key !== 0).@endif {{ $attribute->pivot->value }}</strong>
                                @endif
                                @php
                                    if($attribute->topup == 1) {
                                        $topupValue = $attribute->pivot->value;
                                    }
                                @endphp
                            @endforeach
                        </p>
                    </div>
                    <div class="d-flex justify-content-between mb-4 fs-14 text-muted">
                        <p class="two-line-ellipsis lh-1_2 mr-2">{{ $item->title!=null ? $item->title : $item->categoryGame->title }}</p>
                        <div class="mb-2 d-flex flex-column align-items-end">
                            <img src="{{ asset($item->feature_image!==null ? $item->images_path.'thumbnails/'.$item->feature_image : $item->categoryGame->feature_image) }}" alt="" width="58px">
                        </div>
                    </div>
                    <p class="m-0">
                        @php
                        $price = floor($item->price * 10000) / 10000;

                        $num = strlen(substr(strrchr($price, "."), 1));
                        @endphp
                        @if($num >= 4)
                        <strong class="fs-20">${{ number_format($price * (int) $topupValue, 4, '.', '') }}</strong>
                        @else
                        <strong class="fs-20">${{ number_format($price * (int) $topupValue, 2, '.', '') }}</strong>
                        @endif
                    </p>
                </div>
                <div class="drop-box skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1;">
                    <p class="">
                        <strong class="skeleton px-2 br-4">&nbsp;</strong>
                        <strong class="skeleton px-2 br-4">&nbsp;</strong>
                        <strong class="skeleton px-2 br-4">&nbsp;</strong>
                    </p>
                    <div class="d-flex justify-content-between mb-4 fs-14 text-muted">
                        <div class="d-flex flex-column w-100">
                            <p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>
                            <p class="skeleton skeleton-text mt-0">&nbsp;</p>
                        </div>
                        <div class="mb-2 d-flex flex-column align-items-end">
                            <div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>
                        </div>
                    </div>
                    <p class="m-0">
                        <strong class="fs-20 px-5 skeleton">&nbsp</strong>
                    </p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="row-3-2-1"></div>
    <div class="col-12 text-center text-muted py-5">
        <h5>No results found.</h5>
    </div>
    @endif

    @if ($items->hasPages())
    <div class="col-12 d-flex justify-content-center mt-4">
        {!! $items->links('pagination::bootstrap-4') !!}
    </div>
    @endif
</div>
