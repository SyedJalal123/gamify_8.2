@extends('frontend.app')

@section('css')
    <style>
        .section--first {
            padding-top: 144px !important;
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

        .dt-search {
            display: none !important;
        }
        .dt-layout-row, .dt-paging-button {
            color: var(--text-primary) !important;
        }

        div.dt-container .dt-paging .dt-paging-button.disabled, div.dt-container .dt-paging .dt-paging-button.disabled:hover, div.dt-container .dt-paging .dt-paging-button.disabled:active {
            color: var(--text-secondary) !important;
        }


        
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first mb-5"  style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
        <div class="row m-0 position-relative zi-2">
            <div class="d-none d-lg-block col-md-2 p-0">
                @include('frontend.includes.sidebar')
            </div>
    
            <div class="col-md-12 col-lg-10 pt-5">
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
                        {{-- <div class="mb-0">
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
                                            <option value="0">Active offers({{ countOffers($offers, 0) }})</option>
                                            <option value="1">Paused offers({{ countOffers($offers, 1) }})</option>
                                            <option value="2">Closed offers({{ countOffers($offers, 2) }})</option>
                                        </select>
                                        <div style="min-width: 50px;min-height: 38px;opacity:1;" class="skeleton-overlay skeleton-overlay-start background-theme-body-2 br-2 d-flex align-items-center">
                                            <div class="skeleton skeleton-text ml-2 py-2">&nbsp;</div>
                                        </div>
                                    </div>
                                    @if($category->id != 3)
                                    <div class="mr-md-3 mb-2 search-input-wrapper p-mw-100 p-w-100 h-38">
                                        <input type="text" 
                                            onkeyup="Livewire.dispatch('game-filter', { 
                                                gameId: document.getElementById('filter-game').value, 
                                                pause: document.getElementById('filter-pause').value, 
                                                search: document.getElementById('filter-search').value 
                                            });"
                                            name="search" class="dark" placeholder="Search" id="filter-search" />
                                        <i class="ml-2 fas fa-search"></i>
                                    </div>
                                    @endif
                                </div>
                            </form>
                        </div> --}}
                        <div id="itemsContainerWrapper" class="br-9 fs-14 position-realative">
                            @livewire('OfferDashboardComponent', ['offers' => $offers, 'category' => $category, 'games' => $games])
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="offer-del-model" tabindex="-1" role="dialog" aria-labelledby="offer-del-model-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="offer-del-model-label">Delete offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        Are you sure you want to delete this offer?
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="Livewire.dispatch('del-offer');" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
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
            setTimeout(function () {
                $('.select2').select2({
                    dropdownPosition: 'below',
                });
            }, 300);

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);
        }

        if (!window.componentUpdateListener) {
            window.componentUpdateListener = true;

            Livewire.on('componentUpdate', () => {
                setTimeout(() => {
                    $('[data-toggle="tooltip"]').tooltip('dispose').tooltip();
                }, 200);

                initPage();
            });
        }

        function checkPriceChanged(offerId) {
            const input = document.getElementById(`offer-price-${offerId}`);
            const button = document.getElementById(`price-update-button-${offerId}`);

            const original = input.getAttribute('data-original');
            const current = input.value;

            if (parseFloat(current) !== parseFloat(original)) {
                button.classList.add('btn-theme-green');
                button.removeAttribute('disabled');
            } else {
                button.classList.remove('btn-theme-green');
                button.setAttribute('disabled', 'disabled');
            }
        }

        function changePriceValue(offerId) {
            const current = $(`#offer-price-${offerId}`).val();

            $(`#offer-price-${offerId}`).val(parseFloat(current));
        }
    </script>
@endsection