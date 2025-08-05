@extends('frontend.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/seller-dashboard.css')}}">
    <style>

        /* .d-none {
            display: none !important;
        }

        @media (min-width: 768px) {
            .d-md-flex {
                display: flex !important;
            }

            .d-md-block {
                display: block !important;
            }
        }a
         */

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
    <section class="section section--bg section--first">
        <div class="row m-0 position-relative zi-2">
            <div class="d-none d-lg-block col-md-2 p-0">
                @include('frontend.includes.sidebar')
            </div>

            <div class="col-md-12 col-lg-10 pt-lg-5 mt-lg-5 pm-1200-0">
                <div class="row">
                    <div class="col-12 mb-5 ml-3" style="max-width: 1048px;">
                        
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="bi bi-wallet2 fs-20 fw-bold text-default"></i>
                            <h3 class="ml-2 mb-0 fw-bold text-theme-primary first-letter-cap">Wallet</h3>
                        </div>
                        
                        <div class="d-flex row">
                            <div class="col-md-5 d-flex justify-content-between align-items-center background-theme-body-1 text-theme-primary border-theme-1 py-4 px-4 mr-4">
                                <div class="d-flex flex-column">
                                    <span class="fs-15 fw-bold">Balance</span>
                                    <h5 class="fw-bold">${{ number_format(auth()->user()->balance, 2) }}</h5>
                                </div>
                                <div class="d-flex">
                                    <a wire:navigate href="{{ url('withdraw') }}" class="btn-theme-default px-3 py-1 br-5">Withdraw</a>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-between align-items-center background-theme-body-1 text-theme-primary border-theme-1 py-2 px-4">
                                <div class="d-flex flex-column">
                                    <span class="fs-15 fw-bold mb-1">Pending Sales</span>
                                    <p class="text-theme-secondary mb-1 fs-13">Revenue from pending orders. Funds will be added to your balance when orders are Completed.</p>
                                    <h5 class="fw-bold">${{ number_format($pending_transactions, 2) }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="transactions d-flex flex-column mt-5">
                            <div class="mb-0">
                                <form method="GET" id="desktopFilterForm">
                                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                                        <div class="mr-md-3 mb-2 select-2-dark position-relative p-w-100" style="min-width: 200px;">
                                            <select class="form-control filter-select select2" id="filter-status" name="filterStatus">
                                                <option value="">All</option>
                                                <option value="purchase">Purchases</option>
                                                <option value="sale">Sales</option>
                                                <option value="withdraw">Withdrawls</option>
                                            </select>
                                            <div style="min-width: 50px;min-height: 38px;opacity:1;" class="skeleton-overlay skeleton-overlay-start background-theme-body-2 br-2 d-flex align-items-center">
                                                <div class="skeleton skeleton-text ml-2 py-2">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="mr-md-3 mb-2 select-2-dark position-relative p-w-100" style="min-width: 200px;">
                                            <select class="form-control filter-select select2" id="filter-duration" name="filterDuration">
                                                <option value="">Recent</option>
                                                <option value="older">3 months or older</option>
                                            </select>
                                            <div style="min-width: 50px;min-height: 38px;opacity:1;" class="skeleton-overlay skeleton-overlay-start background-theme-body-2 br-2 d-flex align-items-center">
                                                <div class="skeleton skeleton-text ml-2 py-2">&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="itemsContainerWrapper" class="br-9 position-realative">
                                <div id="table-container" style="max-width: 1048px;">
                                    <table id="orderTable" class="datatable-1 background-theme-body-1 border-theme-1 text-theme-primary fs-14">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Date Created</th>
                                                <th>Balance Change</th>
                                                <th>Order ID</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                            </div>
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
            $('.select2').select2({
                dropdownPosition: 'below',
            });

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);

            
            if ($.fn.DataTable.isDataTable('#orderTable')) {
                $('#orderTable').DataTable().clear().destroy();
            }

            var orderTable = $('#orderTable').DataTable({
                serverSide: true,
                processing: true,
                // searching: false,
                lengthChange: false,
                ajax: {
                    url: '{{ route("seller-dashboard.wallet") }}',
                    data: function(payload) {
                        const filterStatus = $('#filter-status').val();
                        const filterDuration = $('#filter-duration').val();

                        payload.filterStatus = filterStatus;
                        payload.filterDuration = filterDuration;
                    }
                },
                columns:[
                    { 
                        data: 'date', name: 'created_at', className: 'desktop-only',
                        responsivePriority: 100, orderable: false 
                    },
                    {
                        data: 'balance', name: 'balance', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    {
                        data: 'show_orderId', name: 'show_orderId', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    {
                        data: 'description', name: 'description', className: 'desktop-only',
                        responsivePriority: 100 , searchable: false 
                    },
                    { data: 'mobile_summary', name: 'title', className: 'dtr-control mobile-only', responsivePriority: 1, orderable: false },
                ],
                order: [[0, 'desc']],
                // createdRow: function (row, data) {
                //     // Make whole row clickable
                //     $(row).css('cursor', 'pointer').attr('title', 'Order details');

                //     $(row).on('click', function () {
                //         if (data.row_url && window.Livewire) {
                //             Livewire.navigate(data.row_url);
                //         }
                //     });
                // }
            });

            $('#filter-status, #filter-duration').on('change', function() {
                orderTable.draw();
            });
        }
    </script>
@endsection