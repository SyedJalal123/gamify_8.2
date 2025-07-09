@extends('frontend.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
    <style>
        section {
            font-size: 14px;
        }
        .select2-container--default .select2-selection--single {
            height: 39px !important;
            font-size: 14px;
        }
        .d-none {
            display: none !important;
        }
        @media (min-width: 768px) {
            .d-md-block {
                display: block !important;
            }
        }
        @media (max-width: 768px) { 
            .section--first {
                padding-top: 162px !important;
            } 
        }
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first" style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
        <div class="container mb-5" style="max-width: 1118px;">
            <div class="row col-12">
                <img src="{{ asset($categoryGame->game->image) }}" style="width: 23px;height: max-content;">
                <h5 class="mb-4 ml-2 text-white">{{ $categoryGame->game->name }} {{ $categoryGame->title }}</h5>
            </div>
            <div class="row ">
                <div class="col-md-8 ">
                    @if(($sortedItems->first() !== null) && count($sortedItems->first()->attributes->where('topup', 0)) > 0)
                        <span class="circle-1">1</span>
                        <form id="attributeFilterForm" class="background-theme-body-1 br-10 p-3 pt-4 my-3 mb-4 attributes ">
                            @foreach ($sortedItems->first()->attributes->where('topup', 0) as $attribute)
                                @php
                                    $options = $attribute->options;
                                    $selected = request("attr_{$attribute->id}");
                                @endphp
                                <div class="form-group select-2-dark position-relative">
                                    <h6 class="fw-bold text-white mb-3">Select {{ $attribute->name }}</h6>
                                    <select name="attr_{{ $attribute->id }}" id="attr_{{ $attribute->id }}" class="form-control select2 hidden-until-ready attribute-filter">
                                        <option value="" disabled selected>-- Select {{ $attribute->name }} --</option>
                                        @foreach($options as $option)
                                            <option value="{{$option}}">
                                                {{$option}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div style="min-width: 50px;min-height: 38px;opacity:1;" class="skeleton-overlay skeleton-overlay-start background-theme-body-1 br-2 d-flex flex-column justify-content-end">
                                        <div>
                                            <strong class="skeleton px-5 py-1"></strong>
                                        </div>
                                        <div class="skeleton skeleton-text py-3 mt-3">&nbsp;</div>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    @endif
                    <div class="fw-bold text-white mb-2 d-flex align-items-center">
                        @if(($sortedItems->first() !== null) && count($sortedItems->first()->attributes->where('topup', 0)) > 0)
                        <span class="circle-2 mr-2">2</span>
                        @endif
                        @if($sortedItems->first() !== null) <span>Select Amount</span> @endif
                    </div>
                    <div id="itemsContainerWrapper">
                        <div id="itemsContainer">
                            @include('frontend.catalog.topup-items', ['sortedItems' => $sortedItems])
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <form class="price-box-form d-none" method="GET" action="{{ route('checkout') }}">
                        <input type="hidden" id="item_id" name="item_id" value="">
                        <input type="hidden" id="item_value" name="item_value" value="">
                        <input type="hidden" id="item_quantity" name="quantity" value="">
                        <input type="hidden" id="item_price" name="price" value="">
                        <input type="hidden" id="total-price" name="totalPrice" value="">
                        <input type="hidden" id="discount-percentage" name="discountPercentage" value="0">


                        <div class="price-box text-black bg-white br-9 mt-4 mt-md-0">
                            @csrf
                            <div class="d-flex align-items-center px-4 py-3 border-bottom-1-light">
                                <img id="itemImage" src="{{ asset('uploads/games/v-bucks.png') }}" class="br-5" width="34px"
                                    alt="">
                                <div id="itemTitle" class="ml-2 fs-14 fw-bold">1000 V-Bucks</div>
                            </div>
                            <div class="d-flex justify-content-between px-4 p-2 border-bottom-1-light delivery_time_section">
                                <span class="text-black-70">Delivery time</span>
                                <span id="deliveryTime" class="fw-bold">20 min</span>
                            </div>
                            <div class="d-flex justify-content-end px-4 pt-4 price_section">
                                <h5 class="fw-bold">Total: $<span id="totalPrice" id="totalPrice">7.15</span></h5>
                            </div>
                            <div class="d-flex flex-column px-4 p-2">
                                <button type="button" onclick="form_check()" class="btn btn-dark w-100 mb-2" id="submit-button">
                                    $<span id="buyNowPrice">7.15 |</span>  Buy now
                                </button>
                                <div class="d-flex flex-column border-top-1-dashed mt-3 pt-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="text-primary bi bi-shield-check"></i>
                                        <span class="ml-2 small">Money-back Guarantee</span>
                                        <span class="ml-2 small text-black-70">Protected by TrustShield</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="text-primary bi bi-currency-dollar"></i>
                                        <span class="ml-2 small">Purchase Rewards</span>
                                        <span class="ml-2 small text-black-70">Earn Points, Pay Less!</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="text-primary bi bi-tag"></i>
                                        <span class="ml-2 small">Low Prices</span>
                                        <span class="ml-2 small text-black-70">Unmatched Deals!</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="text-primary bi bi-lightning-charge"></i>
                                        <span class="ml-2 small">Fast & Secure Checkout</span>
                                        <span class="ml-2 small text-black-70">Multiple Secured Options</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="price-box price-box-2 text-black bg-white br-9 mt-2">
                            <div class="border-bottom d-flex flex-column p-3 px-3">
                                <div class="fw-bold">Delivery instructions</div>
                                <div id="deliveryInstructionsContainer">
                                    <div id="deliveryInstructions" class="text-black-70 fs-13 mt-2 lh-1_3 clamp-text">
                                        Log in Top up  (epic email account and password required) Users 
                                        who play games with PS and Xbox need to prepare a new epic account 
                                        for me(Not connected to any Xbox or PS),PC players do not need to 
                                        prepare a new account
                                    </div>
                                    <button id="toggleInstructions" type="button" class="btn btn-link p-0 mt-1" style="display: none;">View more</button>
                                </div>
                            </div>
                            <div class="d-flex flex-column px-3 pb-3 pt-2">
                                <div class="text-black-70">Seller</div>
                                <div class="d-flex pt-2">
                                    <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                                        S
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div id="sellerName" class="small fw-bold">trumpgold</div>
                                        <div class="d-flex align-items-center">
                                            <i class="text-success bi bi-star-fill"></i>
                                            <span class="text-black-70 mx-1 fs-13">99.3%</span>
                                            <a href="#">27,066 reviews</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 mt-2 pt-5 px-0 secondaryItemsContainer">
                {{-- Other Sellers --}}
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        const authId = "{{auth()->id()}}";
        // Toggle Description
        function setupClampToggle() {
            const content = document.getElementById('deliveryInstructions');
            const toggleBtn = document.getElementById('toggleInstructions');

            // Reset
            content.classList.remove('expanded');
            toggleBtn.textContent = 'View more';

            // Clone to measure
            const clone = content.cloneNode(true);
            clone.style.cssText = 'position: absolute; visibility: hidden; height: auto; -webkit-line-clamp: unset;';
            document.body.appendChild(clone);

            const fullHeight = clone.offsetHeight;
            document.body.removeChild(clone);

            const lineHeight = parseFloat(getComputedStyle(content).lineHeight);
            const maxHeight = lineHeight * 5;

            if (fullHeight > maxHeight) {
                toggleBtn.style.display = 'inline';
            } else {
                toggleBtn.style.display = 'none';
            }

            toggleBtn.onclick = function () {
                const isExpanded = content.classList.toggle('expanded');
                toggleBtn.textContent = isExpanded ? 'View less' : 'View more';
            };
        }

        $(document).ready(function () {

            // Animate for first time
            // setTimeout(() => {
            //     [...document.querySelectorAll('.animate-class')]
            //         .slice(0, 24)
            //         .forEach(el => animateDetachedOverlay(el));
            // }, 0.01); // 500ms delay, adjust as needed

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);

            $('#attributeFilterForm').on('change', '.attribute-filter', function () {

                html =  '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="position-relative" style="min-height: 138px;">'+
                            '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                '<div class="d-flex flex-column">'+
                                    '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                    '<div>'+
                                        '<span class="small px-5 skeleton">&nbsp;</span>'+
                                        '</div>'+
                                    '</div>'+
                                '<div class="mt-3">'+
                                    '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                '</div>'+
                            '</div>'+
                '</div>';


                $('#itemsContainer div').empty();
                $('#itemsContainer div:first').append(html);

                // [...document.querySelectorAll('.animate-class')].slice(0, 24).forEach(el => animateDetachedOverlay(el));

                let url = new URL(window.location.href);

                // Clear all previous attribute-related query params
                $('#attributeFilterForm .attribute-filter').each(function () {
                    const key = $(this).attr('name');
                    url.searchParams.delete(key); // Remove old value
                    const val = $(this).val();
                    if (val) {
                        url.searchParams.set(key, val);
                    }
                });

                // Load new filtered content
                $.ajax({
                    url: url.toString(),
                    method: 'GET',
                    success: function (response) {
                        let item_id = $('#item_id').val();
                        let item_value = $('#item_value').val();
                        
                        $('#itemsContainer').html(response.main); // Replace item list
                        $('.skeleton-overlay-start').css('opacity', '0');

                        // Toggle topup_active
                        document.querySelectorAll('.item-select').forEach(function (i) {
                            i.classList.remove('topup_active');
                        });
                        
                        // Change .topup_active according to the latest clicked one
                        if($('.item-select').hasClass('topup_box_' + item_value)){
                            $('.topup_box_'+item_value).addClass('topup_active');
                        }else{
                            $('.price-box-2').removeClass('d-none');
                            $('.delivery_time_section').addClass('d-none');
                            $('.price_section').addClass('d-none');
                            $('#buyNowPrice').addClass('d-none');
                            $('.price-box-2').addClass('d-none');
                            $('.secondaryItemsContainer').text('');
                        }

                        if ($('.no-data').length > 0) {
                            $('.price-box-2').removeClass('d-none');
                            $('.delivery_time_section').addClass('d-none');
                            $('.price_section').addClass('d-none');
                            $('#buyNowPrice').addClass('d-none');
                            $('.secondaryItemsContainer').text('');
                        } else {
                            change_price_box_values();
                            $('.topup_active').click();
                        }
                    },
                    error: function () {
                        alert('Something went wrong.');
                    }
                });
            });
        });

        function form_check(){
            var valid = true;
            var s = $('.attributes select');

            for (i = 0; i < s.length; i++) {
                // If a field is empty...

                if (s[i].value == "") {
                    $('#'+s[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid red');
                    valid = false;
                }else {
                    $('#'+s[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid #aaaaaa');
                }

                let hasActive = false;
                $('.item-select').each(function (i) {
                    if ($(this).hasClass('topup_active') || $(this).find('.topup_active').length > 0) {
                        hasActive = true;
                        return false;
                    }
                });

                if (hasActive == false) {
                    $('.item-select').css('border', '2px solid red');
                }
            }
            if($('.price_section').hasClass('d-none')){
                valid = false
            }
            
            if(valid == true){
                document.getElementById("loadingScreen").style.display = "flex";
                $('.price-box-form').submit();
            }
        }

        function change_price_box_values() {
            document.querySelectorAll('.item-select').forEach(function (item) {
                item.addEventListener('click', function () {
                    
                    // Remove Red Borders
                    $('.item-select').each(function (i) {
                        $('.item-select').css('border', '0px solid red');
                    });
                    
                    const id = this.dataset.id;

                    // Toggle topup_active
                    document.querySelectorAll('.item-select').forEach(function (i) {
                        i.classList.remove('topup_active');
                    });
                    this.classList.add('topup_active');

                    // Animate the main price box
                        const priceBoxForm = document.querySelector('.price-box-form');
                        const overlay = document.createElement('div');
                        overlay.classList.add('price-overlay');
                        priceBoxForm.appendChild(overlay);
                        overlay.style.opacity = '1';
                        setTimeout(function () {
                            overlay.style.opacity = '0';
                            setTimeout(function () {
                                overlay.remove();
                            }, 300);
                        }, 1000);
                    ////////////////////////////

                    // AJAX fetch by item ID
                    fetch(`/get-item-details/${id}/topup`)
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        if (data.success) {
                            const item = data.item;
                            
                            document.querySelector('#itemTitle').textContent = item.title;
                            document.querySelector('#itemImage').src = item.image;
                            document.querySelector('#deliveryTime').textContent = item.delivery_time;
                            document.querySelector('#totalPrice').textContent = item.price;
                            
                            if(authId == item.seller_id) {
                                $('#submit-button').text('You can\'t buy you own items');
                                $('#submit-button').off('click');
                                $('#submit-button').attr('disabled',true);
                            }else {
                                document.querySelector('#buyNowPrice').textContent = item.price;
                            }
                            document.querySelector('#deliveryInstructions').textContent = item.description;
                            document.querySelector('#sellerName').textContent = item.seller;
                            setupClampToggle();
                            
                            if ($('.attributes').children().length === 0 || ($('.attributes').children().length !== 0 && ($('.select2').first().val() !== null))) {
                                $('.secondaryItemsContainer').fadeOut(200, function() {
                                    $(this).html(data.secondary).fadeIn(300);
                                });
                                $('.price-box-2').removeClass('d-none');
                                $('.delivery_time_section').removeClass('d-none');
                                $('.price_section').removeClass('d-none');
                                $('#buyNowPrice').removeClass('d-none');
                            } else {
                                $('.price-box-2').addClass('d-none');
                                $('.delivery_time_section').addClass('d-none');
                                $('.price_section').addClass('d-none');
                                $('#buyNowPrice').addClass('d-none');
                            }
                            
                            $('.price-box-form').removeClass('d-none');
                            $('#item_id').val(item.id);
                            $('#item_price').val(item.price);
                            $('#total-price').val(item.price);
                            $('#item_value').val(item.topup);
                            $('#item_quantity').val(item.topup);
                        }
                    });
                });
            });
        }
        
        $(document).ready(function() {
            change_price_box_values();
            $('.topup_active').click();
            
            // Apply Select2 to all select elements
            $('span.select2-container').remove();
            $('.select2').select2({
                dropdownPosition: 'below',
            });
        });

        function toggleFilters() {
            document.getElementById('filterDrawer').classList.toggle('show');
        }

        // AJAX filter function
        function applyAjaxFilters(id) {
            const f = document.getElementById(id);
            const url = f.action || location.href;
            const params = new URLSearchParams(new FormData(f)).toString();
            const overlay = document.getElementById('itemsOverlay');
            overlay.style.display = 'flex';

            fetch(`${url}?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    ['itemsContainer', 'itemCount'].forEach(id =>
                        document.getElementById(id).innerHTML = doc.getElementById(id).innerHTML
                    );
                })
                .finally(() => overlay.style.display = 'none');
        }
    </script>

    <script>
        if (!window.paginationTopupCatalogListener) {
            window.paginationTopupCatalogListener = true;
            // Handle pagination link click
            document.addEventListener('click', function(e) {
                const link = e.target.closest('.pagination a');
                if (link) {
                    e.preventDefault();
                    const url = link.getAttribute('href');
                    const overlay = document.getElementById('itemsOverlay');
                    // overlay.style.display = 'flex';

                    html =  '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="position-relative" style="min-height: 138px;">'+
                                '<div class="drop-box d-flex flex-column justify-content-between br-10 skeleton-overlay skeleton-overlay-start h-100" style="opacity: 1; min-height: 138px;">'+
                                    '<div class="d-flex flex-column">'+
                                        '<div style="width:40px;height:40px;" class="skeleton">&nbsp;</div>'+

                                        '<div>'+
                                            '<span class="small px-5 skeleton">&nbsp;</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="mt-3">'+
                                        '<strong class="px-4 skeleton">&nbsp;</strong>'+
                                    '</div>'+
                                '</div>'+
                    '</div>';


                    $('#itemsContainer div').empty();
                    $('#itemsContainer div:first').append(html);

                    fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const doc = new DOMParser().parseFromString(JSON.parse(html).main, 'text/html');
                        document.getElementById('itemsContainer').innerHTML = JSON.parse(html).main;
                        // document.getElementById('itemCount').innerHTML = doc.getElementById('itemCount').innerHTML;
                        window.scrollTo({top: document.getElementById('itemsContainer').offsetTop - 100, behavior: 'smooth'});
                    }).finally(() => $('.skeleton-overlay-start').css('opacity', '0'));
                }
            });
        }
    </script>
@endsection
