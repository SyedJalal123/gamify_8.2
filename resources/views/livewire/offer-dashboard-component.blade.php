
<div class="offer-container">
    <div class="mb-0">
        <form method="GET" id="desktopFilterForm">
            <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                <div class="mr-md-3 mb-2 select-2-dark position-relative p-w-100" style="min-width: 200px;">
                    <select class="form-control filter-select select2" 
                        onchange="Livewire.dispatch('game-filter', { 
                            gameId: document.getElementById('filter-game').value, 
                            pause: document.getElementById('filter-pause').value, 
                            search: document.getElementById('filter-search').value 
                        });" 
                        id="filter-game" name="filterStatus">
                        <option value="">All Games</option>
                        @foreach ($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                        @endforeach
                    </select>
                    <div style="min-width: 50px;min-height: 38px;opacity:1;" class="skeleton-overlay skeleton-overlay-start background-theme-body-2 br-2 d-flex align-items-center">
                        <div class="skeleton skeleton-text ml-2 py-2">&nbsp;</div>
                    </div>
                </div>
                <div class="mr-md-3 mb-2 select-2-dark position-relative p-w-100" style="min-width: 200px;">
                    <select class="form-control filter-select select2" 
                        onchange="Livewire.dispatch('game-filter', { 
                            gameId: document.getElementById('filter-game').value, 
                            pause: document.getElementById('filter-pause').value, 
                            search: document.getElementById('filter-search').value 
                        });" 
                        id="filter-pause" name="filterDuration">
                        <option value="">All offers</option>
                        <option value="0">Active offers({{ countOffers($category, 0) }})</option>
                        <option value="1">Paused offers({{ countOffers($category, 1) }})</option>
                        <option value="2">Closed offers({{ countOffers($category, 2) }})</option>
                    </select>
                    <div style="min-width: 50px;min-height: 38px;opacity:1;" class="skeleton-overlay skeleton-overlay-start background-theme-body-2 br-2 d-flex align-items-center">
                        <div class="skeleton skeleton-text ml-2 py-2">&nbsp;</div>
                    </div>
                </div>
                <div class="mr-md-3 @if($category->id == 3) d-none @endif mb-2 search-input-wrapper p-mw-100 p-w-100 h-38">
                    <input type="text" 
                        onkeyup="Livewire.dispatch('game-filter', { 
                            gameId: document.getElementById('filter-game').value, 
                            pause: document.getElementById('filter-pause').value, 
                            search: document.getElementById('filter-search').value 
                        });"
                        name="search" class="dark" placeholder="Search" id="filter-search" />
                    <i class="ml-2 fas fa-search"></i>
                </div>
            </div>
        </form>
    </div>

    @if (count($offers) != 0)    
        @foreach ($offers as $offer)
        <div class="d-flex flex-column offer-container background-theme-body-1 text-theme-primary border-theme-1 mb-2 drop-shadow-theme-1">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center px-2 px-md-4 py-2 dividor-border-theme-bottom">
                <div class="d-flex d-md-none justify-content-between align-items-center mb-2">
                    <div class="d-flex">
                        @if($offer->pause == 0)
                        <span class="btn-theme-pill py-1 btn-theme-pill-green">Active</span>
                        @else
                        <span class="btn-theme-pill py-1 btn-theme-pill-yellow">Paused</span>
                        @endif
                    </div>
                    <div class="d-flex ml-2">
                        <div wire:click="pauseOffer({{$offer->id}}, {{$offer->pause}})" class="d-flex align-items-center py-1 px-2 ml-1 hover-bg-body-2" data-toggle="tooltip" data-placement="top" @if($offer->pause == 0) title="Pause" @else title="Resume" @endif>
                            @if($offer->pause == 0)
                            <i class="bi bi-play-fill fs-18"></i>
                            @else
                            <i class="bi bi-pause fs-20"></i>
                            @endif
                        </div> <!-- Pause pc -->
                        <a wire:navigate href="{{ url('offers/edit') }}/{{$offer->id}}" class="text-theme-primary d-flex align-items-center py-1 px-2 ml-1 hover-bg-body-2" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="bi bi-pencil fs-18"></i>
                        </a> <!-- Edit pc -->
                        <div class="d-flex align-items-center py-1 px-2 ml-1 hover-bg-body-2" onclick="copyToClipboard('{{ url('item/') }}/{{$offer->id}}')" data-toggle="tooltip" data-placement="top" title="Share Offer">
                            <i class="bi bi-link fs-18"></i>
                        </div> <!-- Link pc -->
                        <div class="d-flex align-items-center py-1 px-2 ml-1 hover-bg-body-2" onclick="Livewire.dispatch('update-offer-id', { offerId: {{ $offer->id }}});" data-toggle="modal" data-target="#offer-del-model" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="bi bi-trash fs-18"></i>
                        </div> <!-- Delete pc -->
                    </div>
                </div>
                <div class="d-flex">
                    {{ $offer->categoryGame->game->name }}
                    @php $countr = 0; @endphp
                    @foreach ($offer->attributes as $key => $attribute)
                        @if ($attribute->applies_to == 1 && $attribute->topup == 0)
                            <strong>  @if($countr == 0)&nbsp;:&nbsp; @endif @if ($countr !== 0)&nbsp;. @endif {{ $attribute->pivot->value }}</strong>
                            @php $countr++; @endphp
                        @endif
                    @endforeach
                </div>
                <div class="d-flex flex-row d-none d-md-flex align-items-center">
                    <div class="d-flex">
                        @if($offer->pause == 0)
                        <span class="btn-theme-pill py-1 btn-theme-pill-green">Active</span>
                        @else
                        <span class="btn-theme-pill py-1 btn-theme-pill-yellow">Paused</span>
                        @endif
                    </div>
                    <div class="d-flex ml-2">
                        <div wire:click="pauseOffer({{$offer->id}}, {{$offer->pause}})" class="d-flex align-items-center py-1 px-2 ml-1 hover-bg-body-2" data-toggle="tooltip" data-placement="top" @if($offer->pause == 0) title="Pause" @else title="Resume" @endif>
                            @if($offer->pause == 0)
                            <i class="bi bi-play-fill fs-18"></i>
                            @else
                            <i class="bi bi-pause fs-20"></i>
                            @endif
                        </div> <!-- Pause pc -->
                        <a wire:navigate href="{{ url('offers/edit') }}/{{$offer->id}}" class="text-theme-primary d-flex align-items-center py-1 px-2 ml-1 hover-bg-body-2" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="bi bi-pencil fs-18"></i>
                        </a> <!-- Edit pc -->
                        <div class="d-flex align-items-center py-1 px-2 ml-1 hover-bg-body-2" onclick="copyToClipboard('{{ url('item/') }}/{{$offer->id}}')" data-toggle="tooltip" data-placement="top" title="Share Offer">
                            <i class="bi bi-link fs-18"></i>
                        </div> <!-- Link pc -->
                        <div class="d-flex align-items-center py-1 px-2 ml-1 hover-bg-body-2" onclick="Livewire.dispatch('update-offer-id', { offerId: {{ $offer->id }}});" data-toggle="modal" data-target="#offer-del-model" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="bi bi-trash fs-18"></i>
                        </div> <!-- Delete pc -->
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center px-2 px-md-4 py-3">
                <div class="d-flex flex-row align-items-center min-w-40 mb-3">
                    <img src="{{ asset($offer->feature_image!==null ? $offer->images_path.'thumbnails/'.$offer->feature_image : $offer->categoryGame->feature_image) }}" alt="" width="50px">
                    <span class="ml-2 fw-bold fs-13 mr-md-3">
                        @if ($offer->categoryGame->category_id == 3)
                            @foreach ($offer->attributes as $key => $attribute)
                                @if ($attribute->topup == 1)
                                    <strong>@if ($key !== 0).@endif {{ $attribute->pivot->value }}</strong>
                                @endif
                            @endforeach
                            {{ $offer->title ? $offer->title : $offer->categoryGame->title }}
                        @else
                            {{ $offer->categoryGame->feature_image == null ? $offer->title : $offer->categoryGame->category->name }}
                        @endif
                    </span>
                </div>
                <div class="d-flex flex-column {{ in_array($offer->categoryGame->category_id, [2, 3]) ? 'justify-content-around' : 'justify-content-between' }} flex-md-row w-md-60">
                    <div class="d-flex flex-row flex-md-column justify-content-between mb-2">
                        <span class="text-theme-secondary">Quantity:</span>
                        <span>{{ number_format($offer->quantity_available) }} {{ $offer->categoryGame->currency_type }}</span>
                    </div>
                    @if(!in_array($offer->categoryGame->category_id, [2, 3]))
                    <div class="d-flex flex-row flex-md-column justify-content-between mb-2">
                        <span class="text-theme-secondary">Min qty:</span>
                        <span>{{ number_format($offer->minimum_quantity) }} {{ $offer->categoryGame->currency_type }}</span>
                    </div>
                    @endif
                    <div class="d-flex flex-row flex-md-column justify-content-between mb-3">
                        <span class="text-theme-secondary">Delivery time:</span>
                        <span>{{ $offer->delivery_time }}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-center min-w-25">
                    <div class="tag-input-container ml-md-5">
                        <div class="input-tag-1 input-tag">$</div>
                        <input type="text" class="form-control px-4 text-center input-theme-1 tag-input" 
                            oninput="checkPriceChanged({{ $offer->id }});"
                            onblur="changePriceValue({{ $offer->id }});"
                            data-original="{{ $offer->price }}"
                            id="offer-price-{{ $offer->id }}" value="{{ $offer->price }}">
                        <div class="input-tag-2 input-tag">{{ $offer->categoryGame->currency_type ? $offer->categoryGame->currency_type : 'unit' }}</div>
                    </div>
                    <button class="btn-sm text-theme-secondary ml-2" id="price-update-button-{{ $offer->id }}" disabled 
                        onclick="Livewire.dispatch('update-offer-price', { price: document.getElementById('offer-price-{{ $offer->id }}').value, offerId: {{ $offer->id }}});">
                        <i class="bi bi-check2"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="text-theme-primary">No data found</div>
    @endif
</div>
