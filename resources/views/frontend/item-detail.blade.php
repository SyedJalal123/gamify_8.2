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

        .d-none {
            display: none !important;
        }

        @media (min-width: 768px) {
            .d-md-flex {
                display: flex !important;
            }

            .d-md-block {
                display: block !important;
            }
        }
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="text-muted mb-3 d-inline-block text-small">&larr; Back to all
                        offers</a><br>
                    <div class="gold-badge mb-2 d-inline-flex align-items-center">
                        <img src="{{ asset($item->categoryGame->game->image) }}" width="24" class="mr-1">
                        <strong>{{ $item->categoryGame->game->name }} {{ $item->categoryGame->title }}</strong>
                    </div>
                    
                    @php 
                        $discountArray = json_decode($item->discount, true); 
                        // $lineCount = substr_count($item->description, "\n") + 1;
                        
                        if ($item->categoryGame->currency_type == 'K'){
                            $currencyVal = 1000; 
                        } elseif ($item->categoryGame->currency_type == 'M'){
                            $currencyVal = 100000; 
                        } else {
                            $currencyVal = 1;
                        }
                    @endphp

                    @if ($isCurrency)
                        <div class="row gold-layout mt-2 fade-in-delay-small">
                            <div class="col-lg-7 p-0 px-md-3">
                                <div class="seller-box rounded text-black bg-white mb-3">
                                    <div class="seller_details d-md-flex text-left border-m-bottom px-3 py-3 d-none">
                                        <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white"
                                            style="width: 40px; height: 40px; background-color: #c0392b;">
                                            {{ strtoupper(substr($item->seller->name, 0, 1)) }}
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div id="sellerName" class="fs-15 fw-bold">{{ $item->seller->name }}</div>
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
                                                <span class="ml-2">-</span>
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="d-flex flex-column py-3 px-3 d-none d-md-block">
                                        <div id="desc-{{ $item->id }}" class="desc-{{ $item->id }} d-flex pt-1 pb-3 fs-14"
                                            style="white-space: pre-line; overflow: hidden;">{!! $item->description !!}</div>

                                        <div class="pb-4 desc-{{ $item->id }} d-none">
                                            <button class="btn btn-light-2"
                                                onclick="toggleReadMore({{ $item->id }})"
                                                id="toggle-btn-{{ $item->id }}">
                                                Read More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 p-0">
                                <div class="price-box text-black bg-white p-0 rounded text-center">
                                    <div class="d-flex justify-content-between border-bottom px-4 py-3">
                                        <p class="m-0 text-muted">Price</p>
                                        <div class="d-flex flex-row">
                                            <h5 class="m-0 fw-bold">${{ number_format($item->price, 3) }}</h5>
                                            <span class="pl-1">/ {{ $item->categoryGame->currency_type }}</span>
                                        </div>
                                    </div>

                                    <form method="GET" action="{{ route('checkout') }}" class="p-3">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="price" value="{{ $item->price }}">
                                        <input type="hidden" id="total-price" name="totalPrice" value="{{ $item->price * $item->minimum_quantity }}">
                                        <input type="hidden" id="discount-percentage" name="discountPercentage" value="0">

                                        <div class="d-flex flex-column p-2">

                                            <div class="input-group mb-2">
                                                <button onclick="adjustQty()" class="btn btn-minus btn-minus-2 mr-1"
                                                    type="button">-</button>
                                                <span class="input-group-text">Qty</span>
                                                <input type="number"
                                                    class="form-control text-center input-group-text-input"
                                                    id="quantity-input" value="{{ $item->minimum_quantity }}" name="quantity"
                                                    min="{{ $item->minimum_quantity }}" oninput="adjustQty()"
                                                    step="1" required>
                                                <span
                                                    class="input-group-text">{{ $item->categoryGame->currency_type }}</span>
                                                <button onclick="adjustQty()" class="btn btn-plus btn-plus-2 ml-1"
                                                    type="button">+</button>
                                            </div>

                                            <div class="d-flex flex-row justify-content-between">
                                                <small class="d-block mb-2 text-muted" id="minQuantityShow">Min Qty:
                                                    {{ number_format($item->minimum_quantity) ?? '1000' }}
                                                    {{ $item->categoryGame->currency_type }}</small>
                                                <small class="d-block mb-2 text-muted" id="maxQuantityShow">In Stock:
                                                    {{ number_format($item->quantity_available) ?? 'N/A' }}
                                                    {{ $item->categoryGame->currency_type }}</small>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-dark w-fill mb-2 mx-2 py-3 fw-bold br-10"
                                            id="price-submit-button">
                                            $<span
                                                id="totalPrice" name="totalPrice">{{ number_format($item->price * $item->minimum_quantity, 2) }}</span>
                                            | Buy now
                                        </button>

                                        @if ($discountArray[0]['amount'] != 0 && $discountArray[0]['discount_percentage'] != 0)
                                            <div class="discount-dropdown align-items-center d-flex flex-column">
                                                <div class="volume-dropdown">
                                                    <div class="volume-dropdown-header" onclick="toggleVolumeDropdown()">
                                                        <svg class="volume-discount-icon" width="16" height="16"
                                                            fill="currentColor">
                                                            <rect width="16" height="16" fill="#FDC435" />
                                                            <text x="8" y="12" font-size="12" text-anchor="middle"
                                                                fill="#fff">%</text>
                                                        </svg>
                                                        <span>Volume discount: <span
                                                                id="discount-percentage-show">0%</span></span>
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
                                                                @foreach ($discountArray as $discount)
                                                                    @if ($discount['amount'] != 0 && $discount['discount_percentage'] != 0)
                                                                        <tr>
                                                                            <td>{{ number_format($discount['amount']) }}
                                                                                {{ $item->categoryGame->currency_type }}
                                                                            </td>
                                                                            <td class="float-right">
                                                                                {{ $discount['discount_percentage'] }}% off
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- <small class="text-muted d-block">100% Secure Payments by <strong>TradeShield</strong></small> --}}
                                    </form>
                                </div>

                                <div class="phone-details text-black bg-white mt-3 d-md-none">
                                    <div class="d-flex flex-column border-m-bottom px-3 pt-3 pb-2">
                                        <div class="d-flex mb-2">
                                            <span class="text-small text-black-70">Seller</span>
                                        </div>
                                        <div class="d-flex seller_details text-left">
                                            <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white"
                                                style="width: 40px; height: 40px; background-color: #c0392b;">
                                                {{ strtoupper(substr($item->seller->name, 0, 1)) }}
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div id="sellerName" class="fs-15 fw-bold">{{ $item->seller->name }}
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="text-success bi bi-star-fill"></i>
                                                    <span class="text-black-70 mx-1 fs-13">99.3%</span>
                                                    <a href="#" class="fs-13">27,066 reviews</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column px-3 pt-2">
                                        <span class="fw-bold">Offer description</span>
                                        <div id="desc-{{ $item->id . '-phone' }}"
                                            class="d-flex pt-1 pb-3 fs-14"
                                            style="white-space: pre-line; overflow: hidden;">{!! $item->description !!}</div>

                                        <div class="pb-4 d-none desc-{{ $item->id . '-phone' }}">
                                            <button class="btn btn-light-2"
                                                onclick="toggleReadMore({{ $item->id }}+'-phone')"
                                                id="toggle-btn-{{ $item->id . '-phone' }}">
                                                Read More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row fade-in-delay-small">
                            <div class="col-lg-7 p-0 px-md-3">
                                <div class="seller-box rounded text-black bg-white mb-3">
                                    <div class="d-flex flex-column flex-md-column">
                                        <div class="title-box d-flex px-3 py-4 p-md-4 border-bottom order-2 order-md-1">
                                            <h5 class="m-0 lh-1_3 fs-md-21 fs-18">{{ $item->title }}</h5>
                                        </div>
                                        @php
                                            $imgArray = json_decode($item->images, true);
                                            $imgArray = array_filter(
                                                $imgArray,
                                                fn($img) => $img !== $item->feature_image,
                                            ); // Remove any existing entry that matches feature_image
                                            $imgArray = array_values($imgArray); // Re-index the array
                                            array_unshift($imgArray, $item->feature_image);

                                            $imgArray2 = array_map(fn($img) => asset($item->images_path.$img), $imgArray); // Adding URL

                                            $imgArray = array_map(fn($img) => asset($item->images_path.'thumbnails/'.$img), $imgArray); // Add full URL

                                            

                                        @endphp
                                        <div class="position-relative m-md-4 mx-3 my-2 border-md-bottom order-1 order-md-2">
                                            @if(count($imgArray) > 1)
                                                <button
                                                    class="scroll-left btn btn-dark position-absolute fs-21 py-1 lh-2 pb-2 d-none d-md-block"
                                                    style="top: 40%; left: 0; z-index: 10;">&#8249;</button>
                                                <button
                                                    class="scroll-right btn btn-dark position-absolute fs-21 py-1 lh-2 pb-2 d-none d-md-block"
                                                    style="top: 40%; right: 0; z-index: 10;">&#8250;</button>
                                            @endif

                                            <div class="item-gallery">

                                                @foreach ($imgArray as $index => $img)
                                                    <div class="img mr-2">
                                                        <img src="{{ $img }}"
                                                            class="img-fluid rounded w-100 br-5 open-modal cursor-pointer"
                                                            data-index="{{ $index }}"
                                                            data-images='@json($imgArray2)'
                                                            data-thumbnails='@json($imgArray)'
                                                            alt="{{ $item->title }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column py-3 px-3 d-none d-md-block">
                                        <span class="fw-bold mb-2">Offer description</span>
                                        <div id="desc-{{ $item->id }}" class="d-flex pt-1 pb-3 fs-14"
                                            style="white-space: pre-line; overflow: hidden;">{!! $item->description !!}</div>

                                        <div class="pb-4 d-none desc-{{ $item->id }}">
                                            <button class="btn btn-light-2"
                                                onclick="toggleReadMore({{ $item->id }})"
                                                id="toggle-btn-{{ $item->id }}">
                                                Read More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 p-0">
                                <div class="price-box text-black bg-white p-0 rounded">
                                    <div class="d-flex justify-content-between px-4 py-3">
                                        <p class="m-0 text-muted">Price</p>
                                        <div class="d-flex flex-row">
                                            <h5 class="m-0 fw-bold">${{ number_format($item->price, 2) }}</h5>
                                            @if ($item->categoryGame->currency_type != null)
                                                <span class="pl-1">/ {{ $item->categoryGame->currency_type }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <table class="table table-borderless mb-0">
                                        @foreach ($item->attributes as $attribute)
                                        @if($attribute->pivot->categoryGameAttribute->visible == 3 || $attribute->pivot->categoryGameAttribute->visible == 2)
                                            <tr class="border">
                                                <td class="text-black-70">{{ $attribute->name }}</td>
                                                <td class="fw-bold float-right">{{ $attribute->pivot->value }}</td>
                                            </tr>
                                        @endif
                                        @endforeach

                                        @if($item->delivery_method !== 'automatic')
                                            <tr class="border">
                                                <td class="text-black-70">Delivery time</td>
                                                <td class="fw-bold float-right">
                                                    <i class="bi-shield-check fw-bold text-light-blue"></i>
                                                    <span class="ml-2">{{ $item->delivery_time }}</span>
                                                </td>
                                            </tr>
                                            <tr class="border">
                                                <td class="text-black-70">Average delivery time</td>
                                                <td class="fw-bold float-right">
                                                    <i class="bi-clock fw-bold text-light-blue"></i>
                                                    <span class="ml-2">-</span>
                                                </td>
                                            </tr>
                                        @else
                                            <tr class="border">
                                                <td class="text-black-70">Delivery time</td>
                                                <td class="fw-bold float-right">
                                                    <i class="bi-lightning-charge-fill fw-bold text-light-blue"></i>
                                                    <span class="ml-2">Instant</span>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>

                                    @if($item->categoryGame->category_id == 4)
                                        <form method="GET" action="{{ route('checkout') }}" class="p-3">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            <input type="hidden" name="price" value="{{ $item->price }}">
                                            <input type="hidden" id="total-price" name="totalPrice" value="{{ $item->price * $item->minimum_quantity }}">
                                            <input type="hidden" id="discount-percentage" name="discountPercentage" value="0">

                                            <div class="d-flex flex-column p-2">

                                                <div class="input-group mb-2">
                                                    <button onclick="adjustQty()" class="btn btn-minus btn-minus-2 mr-1"
                                                        type="button">-</button>
                                                    <span class="input-group-text">Qty</span>
                                                    <input type="number"
                                                        class="form-control text-center input-group-text-input"
                                                        id="quantity-input" value="{{ $item->minimum_quantity }}" name="quantity"
                                                        min="{{ $item->minimum_quantity }}" oninput="adjustQty()"
                                                        step="1" required>
                                                    <span
                                                        class="input-group-text">{{ $item->categoryGame->currency_type }}</span>
                                                    <button onclick="adjustQty()" class="btn btn-plus btn-plus-2 ml-1"
                                                        type="button">+</button>
                                                </div>

                                                <div class="d-flex flex-row justify-content-between">
                                                    <small class="d-block mb-2 text-muted" id="minQuantityShow">Min Qty:
                                                        {{ number_format($item->minimum_quantity) ?? '1000' }}
                                                        {{ $item->categoryGame->currency_type }}</small>
                                                    <small class="d-block mb-2 text-muted" id="maxQuantityShow">In Stock:
                                                        {{ number_format($item->quantity_available) ?? 'N/A' }}
                                                        {{ $item->categoryGame->currency_type }}</small>
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-dark w-fill mb-2 mx-2 py-3 fw-bold br-10"
                                                id="price-submit-button">
                                                $<span
                                                    id="totalPrice">{{ number_format($item->price * $item->minimum_quantity, 2) }}</span>
                                                | Buy now
                                            </button>

                                            @if ($discountArray[0]['amount'] != 0 && $discountArray[0]['discount_percentage'] != 0)
                                                <div class="discount-dropdown align-items-center d-flex flex-column">
                                                    <div class="volume-dropdown">
                                                        <div class="volume-dropdown-header" onclick="toggleVolumeDropdown()">
                                                            <svg class="volume-discount-icon" width="16" height="16"
                                                                fill="currentColor">
                                                                <rect width="16" height="16" fill="#FDC435" />
                                                                <text x="8" y="12" font-size="12" text-anchor="middle"
                                                                    fill="#fff">%</text>
                                                            </svg>
                                                            <span>Volume discount: <span
                                                                    id="discount-percentage-show">0%</span></span>
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
                                                                    @foreach ($discountArray as $discount)
                                                                        @if ($discount['amount'] != 0 && $discount['discount_percentage'] != 0)
                                                                            <tr>
                                                                                <td>{{ number_format($discount['amount']) }}
                                                                                    {{ $item->categoryGame->currency_type }}
                                                                                </td>
                                                                                <td class="float-right">
                                                                                    {{ $discount['discount_percentage'] }}% off
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- <small class="text-muted d-block">100% Secure Payments by <strong>TradeShield</strong></small> --}}
                                        </form>
                                    @else
                                        <form method="GET" action="{{ route('checkout') }}" class="p-3">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            <input type="hidden" name="price" value="{{ $item->price }}">
                                            <input type="hidden" id="total-price" name="totalPrice" value="{{ $item->price }}">
                                            <input type="hidden" id="discount-percentage" name="discountPercentage" value="0">

                                            <button type="submit" class="btn btn-dark w-fill mb-2 mx-2 py-3 fw-bold br-10"
                                                id="price-submit-button">
                                                $<span
                                                    id="totalPrice">{{ number_format($item->price * $item->minimum_quantity, 2) }}</span>
                                                | Buy now
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <div class="phone-details text-black bg-white mt-3">
                                    <div class="d-flex flex-column px-3 pt-3 pb-2">
                                        <div class="d-flex mb-2">
                                            <span class="text-small text-black-70">Seller</span>
                                        </div>
                                        <div class="d-flex seller_details text-left">
                                            <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white"
                                                style="width: 40px; height: 40px; background-color: #c0392b;">
                                                {{ strtoupper(substr($item->seller->name, 0, 1)) }}
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div id="sellerName" class="fs-15 fw-bold">{{ $item->seller->name }}
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="text-success bi bi-star-fill"></i>
                                                    <span class="text-black-70 mx-1 fs-13">99.3%</span>
                                                    <a href="#" class="fs-13">27,066 reviews</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column px-3 pt-2 d-md-none border-top">
                                        <span class="fw-bold">Offer description</span>
                                        <div id="desc-{{ $item->id . '-phone' }}"
                                            class="d-flex pt-1 pb-3 fs-14"
                                            style="white-space: pre-line; overflow: hidden;">{!! $item->description !!}</div>
                                        <div class="pb-4 d-none desc-{{ $item->id . '-phone' }}">
                                            <button class="btn btn-light-2"
                                                onclick="toggleReadMore({{ $item->id }}+'-phone')"
                                                id="toggle-btn-{{ $item->id . '-phone' }}">
                                                Read More
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column pt-2 d-none d-md-block">
                                        <div class="fw-bold pb-2 border-bottom px-3">Recent feedback</div>
                                        <div class="d-flex flex-column px-3 py-2">
                                            <div class="review_1 d-flex flex-column py-2 border-bottom">
                                                <div class="d-flex flex-row justify-content-between">
                                                    <div class="d-flex align-items-center fs-14">
                                                        <i class="bi-hand-thumbs-up-fill text-light-blue pr-2 fs-17"></i>
                                                        <span>Accounts</span>
                                                        <span class="px-1">|</span>
                                                        <span class="text-black-70">Rip***</span>
                                                    </div>
                                                    <span class="text-small text-black-70">4 days ago</span>
                                                </div>
                                                <div class="d-flex text-black-70 fs-13 pt-1">
                                                    fast easy good
                                                </div>
                                            </div>
                                            <div class="review_1 d-flex flex-column py-2 border-bottom">
                                                <div class="d-flex flex-row justify-content-between">
                                                    <div class="d-flex align-items-center fs-14">
                                                        <i class="bi-hand-thumbs-down-fill text-danger pr-2 fs-17"></i>
                                                        <span>Accounts</span>
                                                        <span class="px-1">|</span>
                                                        <span class="text-black-70">Rip***</span>
                                                    </div>
                                                    <span class="text-small text-black-70">4 days ago</span>
                                                </div>
                                                <div class="d-flex text-black-70 fs-13 pt-1">
                                                    OOF
                                                </div>
                                            </div>
                                            <div class="d-flex feedback py-2 pt-4">
                                                <button class="btn btn-light-2">All feedback</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <div id="pageOverlay">
        <div class="spinner-border text-light" role="status"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bg-dark text-white position-relative border-0">

                <button type="button" class="close text-white position-absolute zi-100" style="right: 10px; top: 10px;"
                    data-dismiss="modal" aria-label="Close">&times;</button>

                <div class="modal-body text-center d-flex flex-column justify-content-around">
                    <div class="image-counter mb-2" id="imageCounter">1 / 1</div>
                    <div class="img-container" style="max-height: 600px;">
                        <img id="mainModalImage" src="" class="img-fluid mb-3 object-fit-contain w-100 h-100" style="">
                    </div>
                    <div class="d-flex justify-content-center flex-wrap" id="thumbnailContainer"></div>
                </div>

                <!-- Arrows -->
                <button class="btn btn-secondary position-absolute" id="prevBtn"
                    style="top: 45%; left: 10px;">&#10094;</button>
                <button class="btn btn-secondary position-absolute" id="nextBtn"
                    style="top: 45%; right: 10px;">&#10095;</button>

            </div>
        </div>
    </div>

    <script>
        function adjustQty() {
            const quantityInput = document.getElementById('quantity-input');
            const quantity = parseInt(quantityInput.value);
            const minQuantity = parseInt({{ $item->minimum_quantity }});
            const maxQuantity = parseInt({{ $item->quantity_available }});
            const price = parseFloat({{ $item->price }});
            let discountArray = @json($discountArray);

            const submitBtn = document.getElementById('price-submit-button');
            const minQtyLabel = document.getElementById('minQuantityShow');
            const maxQtyLabel = document.getElementById('maxQuantityShow');
            const totalPrice = document.getElementById('totalPrice');

            let subtotal = quantity * price;

            // Find highest applicable discount
            let discount = 0;
            discountArray.forEach(rule => {
                if (quantity >= parseFloat(rule.amount)) {
                    discount = parseFloat(rule.discount_percentage);
                }
            });
            
            // Apply discount
            let discountedTotal = subtotal - (subtotal * discount / 100);
            totalPrice.innerText = discountedTotal.toFixed(2);
            $('#total-price').val(discountedTotal.toFixed(2));
            $('#discount-percentage').val(discount);

            if (discount == 0) {
                $('#discount-percentage-show').text(discount + '%').removeClass('text-light-blue');
            } else {
                $('#discount-percentage-show').text(discount + '%').addClass('text-light-blue');
            }

            if (quantity < minQuantity || quantity > maxQuantity) {
                // quantityInput.classList.add('invalid');
                if(quantity < minQuantity){
                    minQtyLabel.classList.add('text-danger');
                    minQtyLabel.classList.remove('text-muted');
                }else if(quantity > maxQuantity){
                    maxQtyLabel.classList.add('text-danger');
                    maxQtyLabel.classList.remove('text-muted');
                }

                submitBtn.disabled = true;
            } else {
                // quantityInput.classList.remove('invalid');
                minQtyLabel.classList.remove('text-danger')
                minQtyLabel.classList.add('text-muted');

                maxQtyLabel.classList.remove('text-danger')
                maxQtyLabel.classList.add('text-muted');
                submitBtn.disabled = false;
            }
        }

        document.getElementById('price-submit-button').addEventListener('click', () => {
            const overlay = document.getElementById('pageOverlay');
            overlay.style.display = 'flex';
        });

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

        document.addEventListener("DOMContentLoaded", function() {
            const gallery = document.querySelector('.item-gallery');
            const scrollLeftBtn = document.querySelector('.scroll-left');
            const scrollRightBtn = document.querySelector('.scroll-right');

            scrollLeftBtn.addEventListener('click', () => {
                gallery.scrollBy({
                    left: -260,
                    behavior: 'smooth'
                }); // Scroll left
            });

            scrollRightBtn.addEventListener('click', () => {
                gallery.scrollBy({
                    left: 260,
                    behavior: 'smooth'
                }); // Scroll right
            });
        });

        let currentImageIndex = 0;
        let images = [];

        document.querySelectorAll('.open-modal').forEach(img => {
            img.addEventListener('click', function() {
                images = JSON.parse(this.dataset.images);
                allThumbnails = JSON.parse(this.dataset.thumbnails);
                
                currentImageIndex = parseInt(this.dataset.index);
                updateModalImage();
                $('#imageModal').modal('show');
            });
        });

        function updateModalImage() {
            const mainImage = document.getElementById('mainModalImage');
            const counter = document.getElementById('imageCounter');
            const thumbnails = document.getElementById('thumbnailContainer');

            mainImage.src = images[currentImageIndex];
            counter.innerText = `${currentImageIndex + 1} / ${images.length}`;

            thumbnails.innerHTML = '';
            thumbnails.className = 'd-flex justify-content-md-center overflow-auto flex-nowrap';

            allThumbnails.forEach((src, i) => {
                const thumb = document.createElement('img');
                thumb.src = src;
                thumb.className = 'img-thumbnail m-1';
                thumb.style.cursor = 'pointer';
                if (i === currentImageIndex) thumb.classList.add('border', 'border-primary');

                thumb.addEventListener('click', () => {
                    currentImageIndex = i;
                    updateModalImage();
                });

                thumbnails.appendChild(thumb);
            });

            // Mobile: scroll active thumbnail into center view
            setTimeout(() => {
                const activeThumb = thumbnails.querySelector('.border-primary');
                if (activeThumb && window.innerWidth <= 768) {
                    activeThumb.scrollIntoView({
                        behavior: 'smooth',
                        inline: 'center',
                        block: 'nearest'
                    });
                }
            }, 50);
        }

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentImageIndex > 0) {
                currentImageIndex--;
                updateModalImage();
            }
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentImageIndex < images.length - 1) {
                currentImageIndex++;
                updateModalImage();
            }
        });

        function measureLinesById(target) {
            const element = document.getElementById(target);
            if (!element) return;

            const style = getComputedStyle(element);
            let lineHeight = parseFloat(style.lineHeight);

            if (isNaN(lineHeight)) {
                const fontSize = parseFloat(style.fontSize);
                lineHeight = fontSize * 1.2; // fallback estimate
            }

            const lineCount = Math.round(element.offsetHeight / lineHeight);

            if (lineCount > 7) {
                $('#' + target).addClass('limited-text');
                $('.' + target).removeClass('d-none');
            }
        }

        // Call on page load to measure lines
        window.addEventListener('DOMContentLoaded', function() {
            measureLinesById('desc-'+{{ $item->id }});
            measureLinesById('desc-'+{{ $item->id }}+'-phone');
        });
    </script>
@endsection
