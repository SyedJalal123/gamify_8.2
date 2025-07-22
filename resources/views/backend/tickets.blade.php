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
                    <input type="text" id="datatable-search" class="form-control form-control-solid w-250px ps-14" placeholder="Search ticket" />
                </div>
                <!--end::Search-->
                <div class="fv-row min-w-200px my-1 me-3">
                    <select class="form-select form-select-solid" data-control="select2" id="filter-status" name="filterStatus" data-placeholder="Select an option">
                        <option value="all">All statuses</option>                  
                        <option value="0">Pending</option>
                        <option value="1">Resolved</option>
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
                            <th>Ticket</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created at</th>
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
                    url: '{{ route("admin.tickets") }}',
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
                        data: 'user.username', name: 'user.username', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false 
                    },
                    {
                        data: 'category_data', name: 'category_data', className: 'desktop-only',
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
                order: [[4, 'desc']],
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

        function change_ticket_status(ticketId, status) {
            $.ajax({
                url: '/admin/change_ticket_status',
                method: 'GET',
                data: { 
                    ticketId: ticketId, 
                    status: status, 
                },
                success: function (response) {
                    const pill = $(`#ticket-status-${response['id']}`);

                    if (response.status == 0) {
                        var status = 'Pending';
                        pill.removeClass('badge-light-danger').addClass('badge-light-warning');
                    } else if(response.status == 1) {
                        var status = 'Verified';
                        pill.removeClass('badge-light-danger').removeClass('badge-light-warning').addClass('badge-light-success');
                    }

                    pill.text(status);

                    toastr.success('Status changed successfully');
                }
            });
        }

        function reject_seller(id, reject = 0) {

            if(reject == 0){
                $('#kt_modal_reject_seller').modal('show');
                $('#kt_modal_reject_seller .modal-body #modal_seller_id').val(id);
            }
            else if(reject == 1){
                $('#kt_modal_reject_seller').modal('hide');
                var seller_id = $('#kt_modal_reject_seller .modal-body #modal_seller_id').val();
                change_seller_status(seller_id, 2, 1);
            }
        }

        $(document).on('click', '.show-details', function () {
            let ticketId = $(this).data('id');

            $.get(`/admin/get-ticket/${ticketId}`, function (data) {
                var orderId = '';
                var reportedPerson = '';
                var issueData = '';
                var orderIds = '';
                var usernameOrEmail = '';
                var wallerAddress = '';
                var disputeDuration = '';
                var disputeRefundOrignalAccount = '';
                var evidence = '';

                if (data.order_id !== null && data.order_id !== '') {
                    orderId = `
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Order ID or reference URL</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${data.order_id}</span>
                            </div>
                        </div>
                    `;
                }

                if (data.reported_person !== null && data.reported_person !== '') {
                    reportedPerson = `
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Who are you reporting?</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${data.reported_person}</span>
                            </div>
                        </div>
                    `;
                }

                if (data.issue !== null && data.issue !== '') {
                    issueData = `
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Issue</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${data.issue}</span>
                            </div>
                        </div>
                    `;
                } 

                if (data.order_ids !== null && data.order_ids !== '') {
                    orderIds = `
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Order ID(s)</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${data.order_ids}</span>
                            </div>
                        </div>
                    `;
                }

                if (data.email_username !== null && data.email_username !== '') {
                    usernameOrEmail = `
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Gamify username or email</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${data.email_username}</span>
                            </div>
                        </div>
                    `;
                }

                if (data.wallet_address !== null && data.wallet_address !== '') {
                    wallerAddress = `
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">BTC wallet address</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${data.wallet_address}</span>
                            </div>
                        </div>
                    `;
                }

                if (data.dispute_duration !== null && data.dispute_duration !== '') {
                    disputeDuration = `
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">How long ago did you raise your dispute?</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${data.dispute_duration}</span>
                            </div>
                        </div>
                    `;
                }

                if (data.dispute_refund_orignal_account !== null && data.dispute_refund_orignal_account !== '') {
                    disputeRefundOrignalAccount = `
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Should the order funds be refunded to your original payment method?</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${data.dispute_refund_orignal_account}</span>
                            </div>
                        </div>
                    `;
                }

                if (data.evidence !== null && data.evidence !== '') {
                    evidence = `
                        <div class="row mb-7">
                            <label class="col-lg-12 fw-bold text-muted">Evidence of your claim Or Files</label>
                            <div class="col-lg-12">
                                <span class="fw-bolder fs-6 text-gray-800"><img src="${mainUrl}/${data.evidence_path}${data.evidence}" style="width:100%;" onclick="window.open(this.src, '_blank')" class="cursor-pointer"></span>
                            </div>
                        </div>
                    `;
                }


                // Now you can use the seller data
                $('#kt_modal_edit_game .modal-body').html(`
                    <div class="card-body px-9 ">

                        ${orderId}
                        ${reportedPerson}
                        ${issueData}
                        ${orderIds}
                        ${usernameOrEmail}
                        ${wallerAddress}
                        ${disputeDuration}
                        ${disputeRefundOrignalAccount}
                        ${evidence}

                    </div>
                `);
                $('#kt_modal_edit_game').modal('show');
            });

        });
    </script>

    <!--begin::Modal - Reject Seller-->
    <div class="modal fade" id="kt_modal_reject_seller" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_reject_seller_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Rejection reasons</h2>
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
                    <input type="hidden" id="modal_seller_id">
                    <div x-data="" class="d-flex flex-column fs-14">
                        <div class="form-check mb-2 d-flex align-items-center">
                            <input type="radio" name="cancelation_reason" value="Please check your information and try again." class="w-auto me-2" checked="" id="radio_account_incorrect_info">
                            <label class="m-0" for="radio_account_incorrect_info">Please check your information and try again.</label>
                        </div>
                        {{-- <div class="form-check textarea-box w-100 mb-2">
                            <div class="textarea-head d-flex flex-row justify-content-between">
                                <label>Share details</label>
                                <span class="text-black-70"> 0/500</span>
                            </div>
                            <textarea id="cancelation_details" class="textarea input-theme-1 form-control" placeholder="Tell us what happened" aria-label="Tell us what happened" maxlength="500" required=""></textarea>
                        </div> --}}
                    </div>
                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="
                            reject_seller(0, 1);
                            $('#kt_modal_reject_seller').modal('hide'); // jQuery-based close
                    " class="btn btn-danger">Reject</button>
                </div>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Reject Seller-->

    <!--begin::Modal - Seller Details-->
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
                <div class="modal-body scroll-y mx-5 mx-xl-15 mx-7">
                    
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Seller Details-->
@endsection