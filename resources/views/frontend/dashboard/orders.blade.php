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
                    <div class="col-12">
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="bi bi-chevron-double-up fs-20 fw-bold text-default"></i>
                            <h3 class="ml-2 mb-0 fw-bold text-theme-primary first-letter-cap">{{$tag}} orders</h3>
                        </div>
                        <div class="mb-0">
                            <form method="GET" id="desktopFilterForm">
                                <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                                    <div class="mr-md-3 mb-2 select-2-dark position-relative p-w-100" style="min-width: 200px;">
                                        <select class="form-control filter-select select2" id="filter-status" name="filterStatus">
                                            <option value="">All statuses</option>
                                            <option value="pending delivery">Pending delivery ({{ countOrders('pending delivery', $orders) }})</option>
                                            <option value="disputed">Disputed ({{ countOrders('disputed', $orders) }})</option>
                                            <option value="delivered">Delivered ({{ countOrders('delivered', $orders) }})</option>
                                            <option value="received">Received ({{ countOrders('received', $orders) }})</option>
                                            <option value="completed">Completed ({{ countOrders('completed', $orders) }})</option>
                                            <option value="cancelled">Canceled ({{ countOrders('cancelled', $orders) }})</option>
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
                                    <div class="mr-md-3 mb-2 search-input-wrapper p-mw-100 p-w-100 h-38">
                                        <input type="text" name="search" class="dark" placeholder="Search" id="datatable-search" />
                                        <i class="ml-2 fas fa-search"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div id="itemsContainerWrapper" class="br-9 position-realative">
                            {{-- @include('frontend.catalog._items', ['items' => $items]) --}}
                            <div id="table-container" style="max-width: 1048px;">
                                <table id="orderTable" class="datatable-1 background-theme-body-1 border-theme-1 text-theme-primary fs-14">
                                    
                                    
                                </table>
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

            // $('.dt-layout-row').remove();
            var table_html = '<thead class="thead-dark">'+
                                    '<tr>'+
                                        '<th>Order name</th>'+
                                        '<th>Type</th>'+
                                        '<th>Buyer</th>'+
                                        '<th>Order date</th>'+
                                        '<th>Order status</th>'+
                                        '<th>Quantity</th>'+
                                        '<th>Price</th>'+
                                        '<th>Details</th>'+
                                    '</tr>'+
                                '</thead>';

            $('#orderTable').append(table_html);
            
            if ($.fn.DataTable.isDataTable('#orderTable')) {
                $('#orderTable').DataTable().clear().destroy();
            }

            var orderTable = $('#orderTable').DataTable({
                serverSide: true,
                processing: true,
                // searching: false,
                lengthChange: false,
                ajax: {
                    url: '{{ route("seller-dashboard.orders", ["tag" => $tag]) }}',
                    data: function(payload) {
                        const filterStatus = $('#filter-status').val();
                        const filterDuration = $('#filter-duration').val();

                        payload.filterStatus = filterStatus;
                        payload.filterDuration = filterDuration;
                    }
                },
                columns:[
                    { 
                        data: 'title_data', name: 'title', className: 'desktop-only',
                        responsivePriority: 100, orderable: false 
                    },
                    {
                        data: 'category_game.category.name', name: 'category_game.category.name', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    {
                        data: 'buyer.username', name: 'buyer.username', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    {
                        data: 'created_at_data', name: 'created_at', className: 'desktop-only',
                        responsivePriority: 100 , searchable: false 
                    },
                    {
                        data: 'order_status', name: 'order_status', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    {
                        data: 'quantity', name: 'quantity', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    {
                        data: 'price', name: 'price', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    { data: 'mobile_summary', name: 'title', className: 'dtr-control mobile-only', responsivePriority: 1, orderable: false },
                ],
                order: [[3, 'desc']],
                createdRow: function (row, data) {
                    // Make whole row clickable
                    $(row).css('cursor', 'pointer').attr('title', 'Order details');

                    $(row).on('click', function () {
                        if (data.row_url && window.Livewire) {
                            Livewire.navigate(data.row_url);
                        }
                    });
                }
            });

            $('#filter-status, #filter-duration').on('change', function() {
                orderTable.draw();
            });

            $('#datatable-search').on('keyup change clear', function () {
                orderTable.search(this.value, {
                    caseInsensitive: false
                }).draw();
            });
        }
    </script>
@endsection