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
                <div class="fv-row min-w-200px my-1 me-3">
                    <select class="form-select form-select-solid" data-control="select2" id="filter-status" name="filterStatus" data-placeholder="Select an option">
                        <option value="all">All statuses</option>                  
                        <option value="0">Pending</option>
                        <option value="1">Verified</option>
                        <option value="2">Rejected</option>
                        <option value="3">Banned</option>
                    </select>
                </div>
                <div class="fv-row min-w-225px my-1 me-3">
                    <input class="form-control form-control-solid flatpickr-input" placeholder="Pick date" name="filterDate" id="filter-date">
                </div>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div id="table-container">
                <table id="orderTable" class="datatable-1 table align-middle table-row-dashed fs-6 gy-5">
                    <thead class="thead-dark">
                        <tr>
                            <th>Seller</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Requested at</th>
                            <th>Actions</th>
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
                    url: '{{ route("admin.sellerRequests") }}',
                    data: function(payload) {
                        const filterStatus = $('#filter-status').val();
                        const filterDate = $('#filter-date').val();

                        payload.filterStatus = filterStatus;
                        payload.filterDate = filterDate;
                    }
                },
                columns:[
                    { 
                        data: 'title_data', name: 'title_data', className: 'desktop-only',
                        responsivePriority: 100, orderable: false 
                    },
                    {
                        data: 'user.email', name: 'user.email', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false 
                    },
                    {
                        data: 'verified_data', name: 'verified_data', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false 
                    },
                    {
                        data: 'created_at_data', name: 'created_at_data', className: 'desktop-only',
                        responsivePriority: 100, searchable: false 
                    },
                    {
                        data: 'actions', name: 'actions', className: 'desktop-only',
                        responsivePriority: 100 , searchable: false , orderable: false,
                    }
                ],
                order: [[3, 'desc']],
            });

            $('#orderTable tbody').on('click', 'tr', function () {
                var url = $(this).data('href');
                if (url) {
                    window.open(url, '_blank');
                }
            });

            orderTable.on('draw', function () {
                KTMenu.createInstances();
            });

            $('#filter-status, #filter-date').on('change', function() {
                orderTable.draw();
            });

            $('#datatable-search').on('keyup change clear', function () {
                orderTable.search(this.value, {
                    caseInsensitive: false
                }).draw();
            });
        });

        function change_seller_status(sellerId, sellerStatus) {
             $.ajax({
                url: '/admin/change_seller_status',
                method: 'GET',
                data: { 
                    sellerId: sellerId, 
                    sellerStatus: sellerStatus, 
                },
                success: function (response) {
                    const pill = $(`#user-status-${response['id']}`);

                    if (response.verified == 0) {
                        var verified = 'Pending';
                        pill.removeClass('badge-light-danger').addClass('badge-light-warning');
                    } else if(response.verified == 1) {
                        var verified = 'Verified';
                        pill.removeClass('badge-light-danger').removeClass('badge-light-warning').addClass('badge-light-success');
                    } else if(response.verified == 2) {
                        var verified = 'Rejected';
                        pill.addClass('badge-light-danger');
                    } else if(response.verified == 3) {
                        var verified = 'Banned';
                        pill.addClass('badge-light-danger');
                    }

                    pill.text(verified);

                    toastr.success('Status changed');
                }
            });
        }

        $(document).on('click', '.show-details', function () {
            let sellerId = $(this).data('id');

            $.get(`/admin/get-seller/${sellerId}`, function (seller) {
                console.log(seller);
                // Now you can use the seller data
                $('#kt_modal_edit_game .modal-body').html(`
                    <p>Name: ${seller.user.name}</p>
                    <p>Email: ${seller.user.email}</p>
                `);
                $('#kt_modal_edit_game').modal('show');
            });

        });
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
                    <h2 class="fw-bolder">Seller</h2>
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
                    
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Edit game-->
@endsection