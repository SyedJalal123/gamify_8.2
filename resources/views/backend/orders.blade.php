@extends('backend.app')

@section('css')
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 me-3">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" id="datatable-search" class="form-control form-control-solid w-250px ps-14" placeholder="Search order" />
                </div>
                <!--end::Search-->
                {{-- <div class="fv-row min-w-200px my-1 me-3">
                    <select class="form-select form-select-solid" data-control="select2" id="filter-duration" name="filterDuration" data-placeholder="Select an option">
                        <option value="recent">Recent</option>            
                        <option value="older">3 months or older</option>
                    </select>
                </div> --}}
                <div class="fv-row min-w-200px my-1 me-3">
                    <select class="form-select form-select-solid" data-control="select2" id="filter-status" name="filterStatus" data-placeholder="Select an option">
                        <option value="all">All statuses</option>                  
                        <option value="pending delivery">Pending delivery ({{ countOrders('pending delivery', $orders) }})</option>
                        <option value="disputed">Disputed ({{ countOrders('disputed', $orders) }})</option>
                        <option value="delivered">Delivered ({{ countOrders('delivered', $orders) }})</option>
                        <option value="received">Received ({{ countOrders('received', $orders) }})</option>
                        <option value="completed">Completed ({{ countOrders('completed', $orders) }})</option>
                        <option value="cancelled">Canceled ({{ countOrders('cancelled', $orders) }})</option>
                    </select>
                </div>
                <div class="fv-row min-w-200px my-1 me-3">
                    <select class="form-select form-select-solid" data-control="select2" id="filter-games" name="filterGames" data-placeholder="Select an option">
                        <option value="all">All games</option>                  
                        @foreach ($games as $game)
                            <option value="{{ $game->id }}">{{ $game->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fv-row min-w-225px my-1 me-3">
                    <input class="form-control form-control-solid flatpickr-input" placeholder="Pick date" name="filterDate" id="filter-date">
                </div>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">

                {{-- <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <a href="{{ url('admin/item/add') }}" class="btn btn-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Add Item
                    </a>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar--> --}}
                
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div id="table-container">
                <table id="orderTable" class="datatable-1 table align-middle table-row-dashed fs-6 gy-5">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order name</th>
                            <th>Type</th>
                            <th>Buyer</th>
                            <th>Seller</th>
                            <th>Order date</th>
                            <th>Order status</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Actions</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                    </tbody>
                    
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection

@section('js')
    <script src="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);

            
            const end = moment(); // today
            const start = moment().subtract(3, 'months'); // 3 months ago

            $('#filter-date').daterangepicker({
                startDate: start,
                endDate: end,
                locale: {
                    format: 'MM/DD/YYYY'
                }
            });

            
            if ($.fn.DataTable.isDataTable('#orderTable')) {
                $('#orderTable').DataTable().clear().destroy();
            }

            var orderTable = $('#orderTable').DataTable({
                serverSide: true,
                processing: true,
                // searching: false,
                lengthChange: false,
                ajax: {
                    url: '{{ route("admin.orders") }}',
                    data: function(payload) {
                        const filterStatus = $('#filter-status').val();
                        const filterGames = $('#filter-games').val();
                        const filterDate = $('#filter-date').val();

                        payload.filterStatus = filterStatus;
                        payload.filterGames = filterGames;
                        payload.filterDate = filterDate;
                    }
                },
                columns:[
                    { 
                        data: 'title_data', name: 'title_data', className: 'desktop-only',
                        responsivePriority: 100, orderable: false 
                    },
                    {
                        data: 'category_game.category.name', name: 'category_game.category.name', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    {
                        data: 'buyer_data', name: 'buyer_seller', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false 
                    },
                    {
                        data: 'seller_data', name: 'buyer_seller', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false 
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
                    {
                        data: 'actions', name: 'actions', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false, searchable: false 
                    },
                    { data: 'mobile_summary', name: 'title', className: 'dtr-control mobile-only', responsivePriority: 1, orderable: false },
                ],
                order: [[4, 'desc']],
            });

            orderTable.on('draw', function () {
                KTMenu.createInstances();
            });

            $('#orderTable tbody').on('click', 'tr', function () {
                var url = $(this).data('href');
                if (url) {
                    // window.open(url, '_blank');
                }
            });

            $('#filter-status, #filter-games, #filter-date').on('change', function() {
                orderTable.draw();
            });

            $('#datatable-search').on('keyup change clear', function () {
                orderTable.search(this.value, {
                    caseInsensitive: false
                }).draw();
            });
        });

        function change_order_status(orderId, orderStatus) {
             $.ajax({
                url: '/admin/change_order_status',
                method: 'GET',
                data: { 
                    orderId: orderId, 
                    orderStatus: orderStatus, 
                },
                success: function (response) {
                    const pill = $(`#order-pill-${response['id']}`);

                    pill.removeClass(
                        'btn-theme-pill-green',
                        'btn-theme-pill-blue',
                        'btn-theme-pill-red',
                        'btn-theme-pill-yellow',
                        'btn-theme-pill-default'
                    );

                    if (response['order_status'] == 'cancelled') {
                        pill.addClass('btn-theme-pill-red');
                        pill.text('cancelled');

                        toastr.success('Marked as cancelled');
                    } else if (response['order_status'] == 'completed') {
                        pill.addClass('btn-theme-pill-green');
                        pill.text('completed');

                        toastr.success('Marked as completed');
                    }
                }
            });
        }
    </script>

    <!--begin::Modal - Edit game-->
    <div class="modal fade" id="kt_modal_edit_game" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_edit_game_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Edit Game</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_edit_game_form" class="form" action="{{ url('admin/edit_game') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_game_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="d-block fw-bold fs-6 mb-5">Image</label>
                                <!--end::Label-->
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('backend/assets/media/avatars/blank.png')}})">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px" id="edit-game-background-image" style="background-image: url({{asset('backend/assets/media/avatars/blank.png')}});"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="image" accept="image/*" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Edit name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" id="edit-game-name" placeholder="Name" required/>
                                <input type="hidden" name="game_id" class="form-control form-control-solid mb-3 mb-lg-0" id="edit-game-id" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary edit-submit-button"
                              onclick="
                                    const form = document.getElementById('kt_modal_edit_game_form');
                                    if (form.checkValidity()) {
                                        document.getElementsByClassName('edit-game-wait')[0].classList.remove('d-none');
                                        document.getElementsByClassName('edit-game-wait')[0].classList.add('d-block');
                                        document.getElementsByClassName('edit-game-submit')[0].classList.add('d-none');
                                        document.getElementsByClassName('edit-submit-button')[0].disabled = true;
                                        form.submit();
                                    } else {
                                        form.reportValidity(); // show the validation messages
                                    }
                                    ">
                                <span class="indicator-label edit-game-submit">Submit</span>
                                <span class="edit-game-wait d-none">Please wait...  
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Edit game-->
@endsection