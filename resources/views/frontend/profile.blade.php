@extends('frontend.app')

@section('css')
    <style>
        .section--first {
            padding-top: 144px !important;
        }
        @media (max-width: 768px) { 
           .section--first {
                padding-top: 144px !important;
            } 
        }
        .d-none {
            display: none !important;
        }
        @media (min-width: 768px) {
            .d-md-block {
                display: block !important;
            }
        }

        .profile-tabs a.active{
            border-bottom: 2px solid var(--brand-marine);
        }

        .category-tabs a {
            min-width: 105px;
        }

        @media (max-width: 768px) { 
           .category-tabs a {
                min-width: 25% !important;
            } 
        }

        .category-tabs .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 40px;
            background: var(--background-body-1);
            border: 1px solid var(--border-1);
            color: var(--text-primary);
            padding: 1rem;
            margin-bottom: .25rem !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .category-tabs .icon-box:hover {
            background: var(--background-body-2);
            color: var(--text-primary);
        }

        .category-tabs .icon-box.active {
            background: var(--text-default);
            color: var(--brand-dark);
        }
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first fs-14" style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
        <div class="container pb-5"> 

            <div class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary mt-2">
                <div class="d-flex px-3 dividor-border-theme-bottom">
                    <div class="seller_details d-md-flex align-items-center text-left border-m-bottom px-3 py-3">
                        @if($user->profile != null)
                            <img src="{{ asset('uploads/profile/') }}/{{ $user->profile }}" class="mr-2 seller-avatar-header" style="width: 84px; height: 84px;" alt="">
                        @else
                            <div class="mr-2 d-flex align-items-center justify-content-center rounded-circle text-white fs-25 fw-bold"
                                style="width: 84px; height: 84px; background-color: #c0392b;">
                                {{ strtoupper(substr($user->username, 0, 1)) }}
                            </div>
                        @endif
                        <div class="d-flex flex-column">
                            <div id="sellerName" class="fs-24 fw-bold">{{ $user->username }}</div>
                            <div class="d-flex align-items-center mb-1">
                                <i class="text-success bi bi-star-fill"></i>
                                <span class="text-theme-secondary mx-1 fs-13">{{ userFeedbackScore($user->id) }}%</span>
                                <span class="text-theme-secondary fs-13">
                                    @php $totalFeedbacks = count(userPositiveFeebacks($user->id)) + count(userNegativeFeebacks($user->id)); @endphp
                                    {{ number_format($totalFeedbacks) }} reviews
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="signal-ping-dot mr-1"></span>
                                <span>Online</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex profile-tabs">
                    <a wire:navigate href="{{ url('user-profile') }}/{{ $user->username }}?tab=Offers&category=Currency" class="@if($tab == 'Offers') active @endif py-3 px-4 text-theme-primary">Shop</a>
                    <a wire:navigate href="{{ url('user-profile') }}/{{ $user->username }}?tab=Feedback&feedbackRating=All" class="@if($tab == 'Feedback') active @endif py-3 px-4 text-theme-primary">Reviews</a>
                    <a wire:navigate href="{{ url('user-profile') }}/{{ $user->username }}?tab=About" class="@if($tab == 'About') active @endif py-3 px-4 text-theme-primary">About</a>
                </div>
            </div>
            @if($tab == 'Offers')
                <div class="d-flex flex-column mb-3">
                    <div class="fs-24 fw-bold text-theme-primary my-4 pb-2 dividor-border-theme-bottom">Shop</div>
                    <div class="d-flex category-tabs dividor-border-theme-bottom pb-4">
                        <a wire:navigate href="{{ url('user-profile') }}/{{ $user->username }}?tab=Offers&category=Currency" class="@if($category == 'Currency') active @endif d-flex flex-column align-items-center mr-1">
                            <div href="#" class="@if($category == 'Currency') active @endif icon-box">
                                <i class="bi bi-bag fs-21 text-stroke-1"></i>
                            </div>
                            <div class="text-theme-primary">
                                <span>Currency ({{count_user_offer(1, $user)}})</span>
                            </div>
                        </a>
                        <a wire:navigate href="{{ url('user-profile') }}/{{ $user->username }}?tab=Offers&category=Accounts" class="@if($category == 'Accounts') active @endif d-flex flex-column align-items-center mr-1">
                            <div href="#" class="@if($category == 'Accounts') active @endif icon-box">
                                <i class="bi bi-person-gear fs-27"></i>
                            </div>
                            <div class="text-theme-primary">
                                <span>Accounts ({{count_user_offer(2, $user)}})</span>
                            </div>
                        </a>
                        <a wire:navigate href="{{ url('user-profile') }}/{{ $user->username }}?tab=Offers&category=Items" class="@if($category == 'Items') active @endif d-flex flex-column align-items-center mr-1">
                            <div href="#" class="@if($category == 'Items') active @endif icon-box">
                                <i class="bi bi-gear-wide-connected fs-24"></i>
                            </div>
                            <div class="text-theme-primary">
                                <span>Items ({{count_user_offer(4, $user)}})</span>
                            </div>
                        </a>
                        <a wire:navigate href="{{ url('user-profile') }}/{{ $user->username }}?tab=Offers&category=TopUp" class="@if($category == 'TopUp') active @endif d-flex flex-column align-items-center mr-1">
                            <div href="#" class="@if($category == 'TopUp') active @endif icon-box">
                                <i class="bi bi-controller fs-26"></i>
                            </div>
                            <div class="text-theme-primary">
                                <span>Top Up ({{count_user_offer(3, $user)}})</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <!-- FILTER DRAWER -->
                    <div class="mb-2">
                        <form method="GET" id="desktopFilterForm" class="d-flex flex-column flex-md-row">
                            @if(in_array($category, ['Accounts', 'Items']))
                                <div class="search-sort-wrapper mr-3">
                                    <div class="search-input-wrapper" style="height: 38px;">
                                        <input type="text" name="search" class="dark" placeholder="Search" value="{{ request('search') }}" />
                                        <i class="ml-2 fas fa-search"></i>
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                                <div class="mr-3 select-2-dark position-relative" style="min-width: 300px;">
                                    <select class="form-control filter-select select2" name="game">
                                        <option value="">All Games</option>
                                        @foreach ($games as $game)
                                            <option value="{{ $game->id }}">
                                                {{ $game->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div style="min-width: 50px;min-height: 38px;opacity:1;" class="skeleton-overlay skeleton-overlay-start background-theme-body-2 br-2 d-flex align-items-center">
                                        <div class="skeleton skeleton-text ml-2 py-2">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <!-- END FILTER DRAWER -->
                    
                    <div id="itemsContainerWrapper" class="br-9 position-realative">
                        @include('frontend.catalog._items', ['items' => $items])
                    </div>
                </div>
            @elseif ($tab == 'Feedback')
                <div class="d-flex flex-column mb-3">
                    <div class="fs-24 fw-bold text-theme-primary my-4 pb-2 dividor-border-theme-bottom">Reviews</div>
                    <div class="mb-0">
                        <form method="GET" id="desktopFilterForm">
                            <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                                <a wire:navigate href="{{url('user-profile')}}/{{ $user->username }}?tab=Feedback&feedbackRating=All" class="btn btn-theme-default mb-1 {{ $feedbackRating == 'All' ? 'active' : '' }} mr-2">All</a>
                                <a wire:navigate href="{{url('user-profile')}}/{{ $user->username }}?tab=Feedback&feedbackRating=Positive" class="btn btn-theme-default mb-1 {{ $feedbackRating == 'Positive' ? 'active' : '' }} mr-2">Positive</a>
                                <a wire:navigate href="{{url('user-profile')}}/{{ $user->username }}?tab=Feedback&feedbackRating=Negative" class="btn btn-theme-default mb-1 {{ $feedbackRating == 'Negative' ? 'active' : '' }} mr-2">Negative</a>
                            </div>
                        </form>
                    </div>
                    
                    <div id="itemsContainerWrapper" class="br-9 position-realative fade-in-delay-small-2">
                        <div id="feedback-show" class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary px-3 pb-4 pt-2 mb-3">
                            @if(count($orders) != 0)
                                @foreach ($orders as $order) 
                                    <div class="@if($order->seller_id !== auth()->id()) cursor-default @endif text-theme-primary dividor-border-theme-bottom py-3 px-md-4 d-flex flex-column position-relative">
                                        <div class="d-flex flex-row mb-2">
                                            @if($order->feedback == 1)
                                                <i class="fa fa-thumbs-up fs-20 pr-3 text-theme-teal"></i>
                                            @else
                                                <i class="fa fa-thumbs-down fs-20 pr-3 text-theme-cherry"></i>
                                            @endif
    
                                            <div class="d-flex fs-14">
                                                <span>{{ $order->categoryGame->category->name }}</span>
                                                <span class="mx-1 text-theme-secondary">|</span>
                                                <span class="text-theme-secondary three-ch-ellipsis">{{ $order->buyer->name }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex text-theme-secondary">
                                            <div class="d-flex fs-14" style="white-space: pre-line; overflow: hidden;">{!! $order->feedback_comment !!}</div>
                                        </div>

                                        <div class="position-absolute top-0 right-0 p-1 px-2 cursor-pointer fs-12 text-theme-secondary">{{ shortTimeAgo($order->feedback_at) }} ago</div>
                                    </div>
                                @endforeach
                            @else
                                <div class="pt-4 pb-2 text-theme-secondary">
                                    No reviews found
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif ($tab == 'About')
                <div class="d-flex flex-column mb-3">
                    <div class="fs-24 fw-bold text-theme-primary my-4 pb-2 dividor-border-theme-bottom">About</div>
                    <div class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary mb-3 fs-14" style="max-width: 528px;">
                        <div class="d-flex flex-column px-4 py-3 dividor-border-theme-bottom">
                            <div class="fw-bold mb-2">DESCRIPTION</div>
                            <div class="d-flex pt-1 pb-3 fs-13 text-theme-secondary" style="overflow: hidden;">{!! $user->description !!}</div>
                        </div>
                        <div class="text-theme-secondary fs-13 px-4 py-3">
                            Registered: {{ $user->created_at->format('M j, Y') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <div id="pageOverlay">
        <div class="spinner-border text-light" role="status"></div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            if(!$('.select2').hasClass('select2-container--default')){
                initPage();
            }
        });

        function initPage() {
            // Apply Select2 to all select elements
            $('.select2').select2({
                dropdownPosition: 'below',
            });

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);
        }

            // AJAX filter function
        function applyAjaxFilters(id) {
            const f = document.getElementById(id);
            const url = f.action || location.href;
            const params = new URLSearchParams(new FormData(f)).toString();
            console.log(url, params);
            const overlay = document.getElementById('itemsOverlay');
            // overlay.style.display = 'flex';

            // $('.skeleton-overlay').css('opacity', '1');

            html = '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="position-relative" style="min-height: 173px;">'+
                        '<div class="drop-box skeleton-overlay h-100" style="opacity: 1;">'+
                            '<p class="">'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                                '<strong class="skeleton px-2 mr-1 br-4">&nbsp;</strong>'+
                            '</p>'+
                            '<div class="d-flex justify-content-between mb-4 fs-14 text-muted">'+
                                '<div class="d-flex flex-column w-100">'+
                                    '<p class="skeleton skeleton-text mt-2 mb-1">&nbsp;</p>'+
                                    '<p class="skeleton skeleton-text mt-0">&nbsp;</p>'+
                                '</div>'+
                                '<div class="mb-2 d-flex flex-column align-items-end">'+
                                    '<div style="width:50px;height:50px;" class="skeleton">&nbsp;</div>'+
                                '</div>'+
                            '</div>'+
                            '<p class="m-0">'+
                                '<strong class="fs-20 px-5 skeleton">&nbsp</strong>'+
                            '</p>'+
                        '</div>'+
            '</div>';

            $('#itemsContainer div').empty();
            $('#itemsContainer div:first').append(html);
                
            // [...document.querySelectorAll('.animate-class')]
            // .slice(0, 24)
            // .forEach(el => animateDetachedOverlay(el));

            fetch(`${url}&${params}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                        const doc = new DOMParser().parseFromString(html, 'text/html');;
                        ['itemsContainer', 'itemCount'].forEach(id =>
                            document.getElementById(id).innerHTML = doc.getElementById(id).innerHTML
                        );
            }).finally(() => $('.skeleton-overlay-start').css('opacity', '0'));
        }

        // Apply to both desktop and phone filters
        ['desktopFilterForm', 'mobileFilterForm'].forEach(id => {
            // Search input
            document.querySelector(`#${id} input[name="search"]`)?.addEventListener('keyup', () => applyAjaxFilters(id));
            // Select2-compatible select change
            $(`#${id} select`).on('change select2:select select2:unselect', () => applyAjaxFilters(id));
        });
    </script>


@endsection
