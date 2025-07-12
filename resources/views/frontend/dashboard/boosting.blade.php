@extends('frontend.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/seller-dashboard.css')}}">
    <style>

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
        <div class="row m-0 position-relative zi-2">
            <div class="d-none d-lg-block col-md-2 p-0">
                @include('frontend.includes.sidebar')
            </div>
    
            <div class="col-md-12 col-lg-10 pt-lg-5 mt-lg-5 pm-1200-0">
                <div class="row">
                    <div class="col-12" style="max-width: 1048px;">
                        <div>
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="bi bi-chevron-double-up fs-20 fw-bold text-default"></i>
                            <h3 class="ml-2 mb-0 fw-bold text-theme-primary first-letter-cap">Offers</h3>
                        </div>
                        
                        <div id="itemsContainerWrapper" class="br-9 fs-14 position-realative">
                            <div class="custom-table text-theme-primary background-theme-md-body-1">
                                <div class="custom-table-header">
                                    <div class="custom-table-header-row d-none d-md-flex">
                                        <div class="custom-table-col w-8">
                                            <span>Game</span>
                                        </div>
                                        @if ($tag == 'received-requests')
                                        <div class="custom-table-col w-17">
                                            <span>Buyer</span>
                                        </div>
                                        @endif
                                        <div class="custom-table-col w-20">
                                            <span>Category</span>
                                        </div>
                                        <div class="custom-table-col @if ($tag == 'received-requests') w-26 @else w-26 @endif">
                                            <span>Request creation date</span>
                                        </div>
                                        
                                        @if ($tag == 'received-requests')
                                            <div class="custom-table-col w-26">
                                                <span>Status</span>
                                            </div>
                                        @else
                                            <div class="custom-table-col w-40">
                                                <span>Offer(s) available</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="custom-table-body">
                                    @if(count($boostingRequests) > 0)
                                        @foreach ($boostingRequests as $request)
                                        @php
                                            if($request->notifiable_type != null) {
                                                $request = getBuyerRequest($request->data['id']); 
                                            }
                                        @endphp
                                        @if($request != null)
                                            <a wire:navigate href="{{ url('boosting-request') }}/{{$request->id}}" class="custom-table-body-row d-none d-md-flex">
                                                <div class="custom-table-col w-8">
                                                    <span><img src="{{ url($request->service->categoryGame->game->image) }}" alt=""></span>
                                                </div>
                                                @if ($tag == 'received-requests')
                                                    <div class="custom-table-col w-17">
                                                        <span>{{ $request->user->username }}</span>
                                                    </div>
                                                @endif
                                                <div class="custom-table-col w-20">
                                                    <span>{{ $request->service->name }}</span>
                                                </div>
                                                <div class="custom-table-col @if($tag == 'received-requests') w-26 @else w-26 @endif">
                                                    <span>{{ date('M d, Y, h:i:s A', strtotime($request->created_at)) }}</span>
                                                </div>
                                                @if($tag == 'received-requests')
                                                <div class="custom-table-col w-20">
                                                    @if($request->status == 'cancelled')
                                                    <span class="btn-theme-pill btn-theme-pill-red">Cancelled</span>
                                                    @elseif($request->status == 'waiting')
                                                    <span class="btn-theme-pill btn-theme-pill-yellow">Waiting for offer</span>
                                                    @else
                                                        @if($request->seller_id == auth()->id())
                                                        <span class="btn-theme-pill btn-theme-pill-green">Offer Won</span>
                                                        @else
                                                        <span class="btn-theme-pill btn-theme-pill-red">Offer Lost</span>
                                                        @endif
                                                    @endif
                                                </div>
                                                @else
                                                <div class="custom-table-col w-40">
                                                    <span>{{ count($request->requestOffers) }}</span>
                                                </div>
                                                @endif
                                            </a>
                                            <a wire:navigate href="{{ url('boosting-request') }}/{{$request->id}}" class="d-md-none">
                                                <div class="background-theme-body-1 drop-shadow-theme-1 border-theme-1 text-theme-primary p-2 mb-2">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <img src="{{ url($request->service->categoryGame->game->image) }}" class="mr-2" alt="">
                                                        <span>{{ $request->service->name }}</span>
                                                    </div>
                                                    @if($tag == 'received-requests')
                                                    <div class="d-flex mb-2">
                                                        @if($request->status == 'cancelled')
                                                        <span class="btn-theme-pill btn-theme-pill-red">Cancelled</span>
                                                        @elseif($request->status == 'waiting')
                                                        <span class="btn-theme-pill btn-theme-pill-yellow">Waiting for offer</span>
                                                        @else
                                                            @if($request->seller_id == auth()->id())
                                                            <span class="btn-theme-pill btn-theme-pill-green">Offer Won</span>
                                                            @else
                                                            <span class="btn-theme-pill btn-theme-pill-red">Offer Lost</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex flex-row justify-content-between mb-2">
                                                            <div class="d-flex">Request creation date</div>
                                                            <div class="d-flex">{{ date('M d, Y, h:i:s A', strtotime($request->created_at)) }}</div>
                                                        </div>
                                                        @if($tag == 'received-requests')
                                                        <div class="d-flex flex-row justify-content-between">
                                                            <div class="d-flex">Buyer</div>
                                                            <div class="d-flex">{{ $request->user->username }}</div>
                                                        </div>
                                                        @else
                                                        <div class="d-flex flex-row justify-content-between">
                                                            <div class="d-flex">Offer(s) available</div>
                                                            <div class="d-flex">{{ count($request->requestOffers) }}</div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                        @endforeach
                                    @else
                                        <div class="p-3">No data found</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="paginations mt-3 d-flex flex-column align-items-center">
                            @if (count($boostingRequests) > 0)
                                {{ $boostingRequests->links('pagination::bootstrap-4') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
            setTimeout(function () {
                $('.select2').select2({
                    dropdownPosition: 'below',
                });
            }, 300);

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);
        }
    </script>
@endsection