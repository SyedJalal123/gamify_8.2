@extends('frontend.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item-detail.css') }}">
<style>
    .section--first {
        padding-top: 144px !important;
    }

    table td {
        padding: 0.55rem 1.2rem !important;
    }

</style>
@endsection

@section('content')
<section class="section section--bg section--first">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ url()->previous() }}" class="text-muted mb-3 d-inline-block text-small">&larr; Back to all offers</a><br>
                <div class="gold-badge mb-2 d-inline-flex align-items-center">
                    <img src="{{ asset($item->categoryGame->game->image) }}" width="24" class="mr-1">
                    <strong>{{$item->categoryGame->game->name}} {{$item->categoryGame->title}}</strong>
                </div>
                @if ($isCurrency)
                <div class="row gold-layout mt-2">
                    <div class="col-lg-7">
                        <div class="seller-box rounded text-black bg-white mb-4">
                            <div class="seller_details d-flex text-left border-m-bottom px-3 py-3">
                                <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                                    {{ strtoupper(substr($item->seller->name, 0, 1)) }}
                                </div>
                                <div class="d-flex flex-column">
                                    <div id="sellerName" class="fs-15 fw-bold">{{$item->seller->name}}</div>
                                    <div class="d-flex align-items-center">
                                        <i class="text-success bi bi-star-fill"></i>
                                        <span class="text-black-70 mx-1 fs-13">99.3%</span>
                                        <a href="#" class="fs-13">27,066 reviews</a>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-borderless mb-0">
                                @foreach ($item->attributes as $attribute)
                                <tr class="border">
                                    <td class="text-black-70">{{ $attribute->name }}</td>
                                    <td class="fw-bold float-right">{{ $attribute->pivot->value }}</td>
                                </tr>
                                @endforeach
                                <tr class="border">
                                    <td class="text-black-70">Guaranteed delivery time</td>
                                    <td class="fw-bold float-right">
                                        <i class="bi-shield-check fw-bold text-success"></i>
                                        <span class="ml-2">{{ $item->delivery_time }}</span>
                                    </td>
                                </tr>
                                <tr class="border">
                                    <td class="text-black-70">Average delivery time</td>
                                    <td class="fw-bold float-right">
                                        <i class="bi-clock fw-bold text-success"></i>
                                        <span class="ml-2">{{ $item->delivery_time }}</span>
                                    </td>
                                </tr>
                            </table>

                            @php
                            $lineCount = substr_count($item->description, "\n") + 1;
                            @endphp

                            <div id="desc-{{ $item->id }}" class="limited-text d-flex px-3 pt-1 pb-3 fs-14" style="white-space: pre-line; overflow: hidden;">
                                {{ e($item->description) }}
                            </div>

                            @if($lineCount > 5)
                            <div class="px-3 pb-4">
                                <button class="btn btn-light-2" onclick="toggleReadMore({{ $item->id }})" id="toggle-btn-{{ $item->id }}">
                                    Read More
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- make this whole section qty volumne discount and other sellers after reviews --}}
                    <div class="col-lg-5 p-0">
                        <div class="price-box text-black bg-white p-0 rounded text-center">
                            <div class="d-flex justify-content-between border-bottom px-4 py-3">
                                <p class="m-0 text-muted">Price</p>
                                <div class="d-flex flex-row">
                                    <h5 class="m-0 fw-bold">${{ number_format($item->price, 3) }}</h5>
                                    <span class="pl-1">/ {{$item->categoryGame->currency_type}}</span>
                                </div>
                            </div>

                            <form method="GET" action="{{ route('checkout') }}" class="p-3">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <input type="hidden" name="price" value="{{ $item->price }}">
                                <div class="d-flex flex-column p-2">

                                    <div class="input-group mb-2">
                                        <button class="btn btn-minus mr-1" type="button">-</button>
                                        <span class="input-group-text">Qty</span>
                                        <input type="number" class="form-control text-center input-group-text-input currency_r topup_r items_r" required value="{{ $item->minimum_quantity }}" min="{{ $item->minimum_quantity }}" step="1">
                                        <span class="input-group-text">{{ $item->categoryGame->currency_type }}</span>
                                        <button class="btn btn-plus ml-1" type="button">+</button>
                                    </div>

                                    {{-- <div class="d-flex justify-content-center align-items-center my-3">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="adjustQty(-1)">-</button>
                                        <input type="number" id="goldQty" name="quantity" value="1000" min="1" class="form-control mx-2 text-center" style="max-width: 80px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="adjustQty(1)">+</button>
                                    </div> --}}
                                    <div class="d-flex flex-row justify-content-between">
                                        <small class="d-block mb-2 text-muted">Min Qty: {{ number_format($item->minimum_quantity) ?? '1000' }} {{ $item->categoryGame->currency_type }}</small>
                                        <small class="d-block mb-2 text-muted">In Stock: {{ number_format($item->quantity_available) ?? 'N/A' }} {{ $item->categoryGame->currency_type }}</small>
                                    </div>

                                </div>


                                @if($item->categoryGame->currency_type == 'K')
                                    @php $currencyVal = 1000; @endphp
                                @elseif ($item->categoryGame->currency_type == 'M')
                                    @php $currencyVal = 100000; @endphp
                                @endif

                                <button type="submit" class="btn btn-dark w-100 mb-2">
                                    $<span id="totalPrice">{{ number_format($item->price * $currencyVal, 2) }}</span> | Buy now
                                </button>

                                
                                <div class="discount-dropdown align-items-center d-flex flex-column">
                                    <div class="volume-dropdown">
                                        <div class="volume-dropdown-header" onclick="toggleVolumeDropdown()">
                                            <svg class="volume-discount-icon" width="16" height="16" fill="currentColor">
                                                <rect width="16" height="16" fill="#FDC435" />
                                                <text x="8" y="12" font-size="12" text-anchor="middle" fill="#fff">%</text>
                                            </svg>
                                            Volume discount: 0%
                                            <span class="volume-dropdown-arrow" id="volume-arrow">▲</span>
                                        </div>
    
                                        <div class="volume-dropdown-content" id="volume-dropdown-content">
                                            <table class="volume-discount-table">
                                                <thead class="border-bottom">
                                                    <tr>
                                                        <th>Quantity</th>
                                                        <th class="float-right">Discount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>10000 K</td>
                                                        <td class="float-right">2% off</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- <small class="text-muted d-block">100% Secure Payments by <strong>TradeShield</strong></small> --}}
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-lg-8">
                        <h4 class="mb-3">{{ $item->title }}</h4>

                        <div class="item-gallery mb-4">
                            <img src="{{ asset($item->feature_image) }}" class="img-fluid rounded" alt="{{ $item->title }}">
                        </div>

                        <div class="description">
                            <h6>Offer description</h6>
                            <p>{!! nl2br(e($item->description)) !!}</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="spec-box text-black bg-white p-3 rounded mb-3">
                            <h6 class="mb-3">Specifications</h6>
                            <table class="table table-borderless mb-0">
                                @foreach ($item->attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{{ $attribute->pivot->value }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="price-box text-black bg-white p-4 rounded text-center">
                            <h3>${{ number_format($item->price, 2) }}</h3>
                            <form method="GET" action="{{ route('checkout') }}">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <input type="hidden" name="price" value="{{ $item->price }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-dark w-100 mb-2">Buy now</button>
                            </form>
                            <small class="text-muted d-block">100% Secure Payments by <strong>TradeShield</strong></small>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    function adjustQty(change) {
        const input = document.getElementById('goldQty');
        const pricePerK = {{ $item->price }};
        let qty = parseInt(input.value) + change;
        if (qty < 1) qty = 1;
        input.value = qty;
        document.getElementById('totalPrice').innerText = (pricePerK * qty).toFixed(2);
    }

    function toggleReadMore(id) {
        const desc = document.getElementById('desc-' + id);
        const btn = document.getElementById('toggle-btn-' + id);

        if (desc.classList.contains('limited-text')) {
            desc.style.maxHeight = 'none';
            desc.classList.remove('limited-text');
            btn.innerText = 'Read Less';
        } else {
            desc.style.maxHeight = '7.5em'; // approx 5 lines (adjust for font-size)
            desc.classList.add('limited-text');
            btn.innerText = 'Read More';
        }
    }
    function toggleVolumeDropdown() {
        const content = document.getElementById('volume-dropdown-content');
        const arrow = document.getElementById('volume-arrow');
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
        arrow.classList.toggle('open');
    }


    // Optional: Set initial height for limited-text
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.limited-text').forEach(el => {
            el.style.maxHeight = '7.5em';
        });
    });

</script>
@endsection
