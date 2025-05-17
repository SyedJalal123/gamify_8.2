
<div class="col-12 mb-1 p-0 text-white" id="itemCount">
    <p class="m-0 text-theme-grey fs-14">{{ $items->count() }} items found</p>
</div>
<div id="itemsContainer">
    @if ($items->count() > 0)
    <div class="row-3-2-1">
        @foreach ($items as $item)
        <div class="position-relative">
            <a href="{{ route('item.detail', $item->id) }}" class="text-dark text-decoration-none animate-class">
                <div class="drop-box">
                    <p class="">
                        @foreach ($item->attributes as $key => $attribute)
                            @if ($attribute->applies_to == 1)
                                <strong>@if ($key !== 0).@endif {{ $attribute->pivot->value }}</strong>
                            @endif
                        @endforeach
                    </p>
                    <div class="d-flex justify-content-between mb-4 fs-14 text-muted">
                        <p class="two-line-ellipsis lh-1_2 mr-2">{{ $item->title!=null ? $item->title : $item->categoryGame->title }}</p>
                        <div class="mb-2 d-flex flex-column align-items-end">
                            <img src="{{ asset($item->feature_image!==null ? $item->images_path.'thumbnails/'.$item->feature_image : $item->categoryGame->feature_image) }}" alt="" width="50px">
                        </div>
                    </div>
                    <p class="m-0">
                        @php
                            $price = floor($item->price * 10000) / 10000;
                            $num = strlen(substr(strrchr($price, "."), 1));
                        @endphp
                        @if($num >= 4)
                        <strong class="fs-20">${{ number_format($price, 4, '.', '') }}</strong>
                        @else
                        <strong class="fs-20">${{ number_format($price, 2, '.', '') }}</strong>
                        @endif
                    </p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
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
