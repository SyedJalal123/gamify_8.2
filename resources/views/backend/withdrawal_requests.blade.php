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
                    <input type="text" id="datatable-search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                </div>
                <!--end::Search-->
                <div class="fv-row min-w-200px my-1 me-3">
                    <select class="form-select form-select-solid" data-control="select2" id="filter-status" name="filterStatus" data-placeholder="Select an option">
                        <option value="all">All statuses</option>                  
                        <option value="0">Pending</option>
                        <option value="1">Completed</option>
                    </select>
                </div>
                <div class="fv-row min-w-200px my-1 me-3">
                    <select class="form-select form-select-solid" data-control="select2" id="filter-type" name="filterType" data-placeholder="Select an option">
                        <option value="all">All types</option>                  
                        <option value="bitcoin">Bitcoin</option>
                        <option value="usdc">USDC</option>
                        <option value="sepa">SEPA</option>
                        <option value="skrill">Skrill</option>
                        <option value="payoneer">Payoneer</option>
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
                            <th>Type</th>
                            <th>Amount</th>
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
                    url: '{{ route("admin.withdrawalRequests") }}',
                    data: function(payload) {
                        const filterStatus = $('#filter-status').val();
                        const filterType = $('#filter-type').val();
                        const filterDate = $('#filter-date').val();

                        payload.filterStatus = filterStatus;
                        payload.filterType = filterType;
                        payload.filterDate = filterDate;
                    }
                },
                columns:[
                    { 
                        data: 'title_data', name: 'title_data', className: 'desktop-only',
                        responsivePriority: 100, orderable: false 
                    },
                    {
                        data: 'type', name: 'type', className: 'desktop-only text-capitalize',
                        responsivePriority: 100 , orderable: false 
                    },
                    {
                        data: 'amount_data', name: 'amount_data', className: 'desktop-only',
                        responsivePriority: 100 , orderable: false 
                    },
                    {
                        data: 'status_data', name: 'status_data', className: 'desktop-only',
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

            $('#filter-status, #filter-date, #filter-type').on('change', function() {
                orderTable.draw();
            });

            $('#datatable-search').on('keyup change clear', function () {
                orderTable.search(this.value, {
                    caseInsensitive: false
                }).draw();
            });
        });

        function change_withdraw_status(withdrawId, withdrawStatus, reason = null) {
            if(reason != null) {
                reason = $('input[name="cancelation_reason"]:checked').val();
            }

            $.ajax({
                url: '/admin/change_withdraw_status',
                method: 'GET',
                data: { 
                    withdrawId: withdrawId, 
                    withdrawStatus: withdrawStatus, 
                    reason: reason,
                },
                success: function (response) {
                    if(response == null || response == '') {
                        toastr.error('Payment is cancelled');
                    }else {
                        const pill = $(`#user-status-${response['id']}`);
    
                        if (response.status == 0) {
                            var status = 'Pending';
                            pill.removeClass('badge-danger').addClass('badge-warning');
                        } else if(response.status == 1) {
                            var status = 'Completed';
                            pill.removeClass('badge-danger').removeClass('badge-warning').addClass('badge-success');
                        } else if(response.status == 2) {
                            var status = 'Cancelled';
                            pill.removeClass('badge-success').removeClass('badge-warning').addClass('badge-danger');
                        }
    
                        pill.text(status);
    
                        toastr.success('Status changed');
                    }
                }
            });
        }

        $(document).on('click', '.show-details', function () {
            let withdrawId = $(this).data('id');

            $.get(`/admin/get-withdraw/${withdrawId}`, function (withdraw) {
                if (withdraw.status == 0) {
                    var verified = '<span class="badge badge-warning">Pending</span>';
                } else if (withdraw.status == 1) {
                    var verified = '<span class="badge badge-success">Completed</span>';
                } else if (withdraw.status == 2) {
                    var verified = '<span class="badge badge-danger">Cancelled</span>';
                }

                const date = new Date(withdraw.created_at);
                const year = date.getFullYear();
                const month = date.toLocaleString('en-US', { month: 'short' }); // "Jan", "Feb", etc.
                const day = String(date.getDate()).padStart(2, '0');
                const formattedDate = `${day}-${month}-${year}`;


                var data1 = '', data2 = '', sign = '';
                if(withdraw.type == 'bitcoin') {
                    data1 = 'Bitcoin wallet address';
                    sign = '$';
                }else if(withdraw.type == 'usdc'){
                    data1 = 'USDC wallet address';
                    sign = '$';
                }else if(withdraw.type == 'sepa'){
                    data1 = 'Recipient name';
                    data2 = 'IBAN';
                    sign = '€';
                }else if(withdraw.type == 'skrill'){
                    data1 = 'Skrill email';
                    sign = '€';
                }else if(withdraw.type == 'payoneer'){
                    data1 = 'Payoneer email';
                    sign = '$';
                }

                data1 = `<div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">${data1}</label>
                            <div class="col-lg-8 d-flex gap-2 align-items-center">
                                <div class="cursor-pointer hover-bg-body-2 px-2 py-1 br-5" onclick="copyToClipboard('${withdraw.data1}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                    </svg>
                                </div>
                                <span class="fw-bolder fs-6 text-gray-800">${withdraw.data1}</span>
                            </div>
                </div>`;

                if(data2 != '') {
                    data2 = `<div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">${data2}</label>
                                <div class="col-lg-8 d-flex gap-2 align-items-center">
                                    <div class="cursor-pointer hover-bg-body-2 px-2 py-1 br-5" onclick="copyToClipboard('${withdraw.data2}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                        </svg>
                                    </div>
                                    <span class="fw-bolder fs-6 text-gray-800">${withdraw.data2}</span>
                                </div>
                            </div>`;
                }

                // Now you can use the seller data
                $('#kt_modal_edit_game .modal-body').html(`
                    <div class="card-body px-9 ">

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Payment type</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 text-capitalize">${withdraw.type}</span>
                            </div>
                        </div>

                        ${data1}

                        ${data2}

                        <div class="row mb-2">
                            <label class="col-lg-4 fw-bold">Received</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${sign}${withdraw.received}</span>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Amount</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">$${withdraw.amount}</span>
                            </div>
                        </div>


                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Fees</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">$${withdraw.fees}</span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Conversation rate</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${parseFloat(withdraw.conversation_rate).toFixed(2)}</span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Created at</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">${formattedDate}</span>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer px-9">
                        <button class="btn btn-danger" onclick="if (confirm('Are you sure you want to cancel the payment?')) change_withdraw_status(${withdraw.id}, 2)"  data-bs-dismiss="modal" aria-label="Close">Cancelled</button>
                        <button class="btn btn-success" onclick="change_withdraw_status(${withdraw.id}, 1)" data-bs-dismiss="modal" aria-label="Close">Completed</button>
                    </div>
                `);
                $('#kt_modal_edit_game').modal('show');
            });

        });
    </script>

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