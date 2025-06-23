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
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" id="datatable-search" class="form-control form-control-solid w-250px ps-14" placeholder="Search game" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">

                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Add Game</button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
                
                <!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_user_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bolder">Add Game</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                                <form id="kt_modal_add_user_form" class="form" action="{{ url('admin/add_game') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="d-block fw-bold fs-6 mb-5">Image</label>
                                            <!--end::Label-->
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('backend/assets/media/avatars/blank.png')}})">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('backend/assets/media/avatars/blank.png')}});"></div>
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
                                            <label class="required fw-bold fs-6 mb-2">Add name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
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
                <!--end::Modal - Add task-->
                
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div id="table-container" style="max-width: 1048px;">
                <table id="gamesTable" class="datatable-1 table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th>Game</th>
                            <th class="text-end min-w-100px">Actions</th>
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
        
        if ($.fn.DataTable.isDataTable('#gamesTable')) {
            $('#gamesTable').DataTable().clear().destroy();
        }

        var gamesTable = $('#gamesTable').DataTable({
            
            serverSide: true,
            processing: true,
            // searching: false,
            lengthChange: false,
            ajax: {
                url: '{{ route("admin.games") }}',
            },
            columns:[
                { 
                    data: 'title_data', name: 'name', className: 'desktop-only',
                    responsivePriority: 100 , orderable: false
                },
                {
                    data: 'action_data', name: 'action_data', className: 'desktop-only',
                    responsivePriority: 100 , orderable: false, searchable: false 
                },
            ],
            // order: [[0, 'desc']],
        });


        $('#datatable-search').on('keyup change clear', function () {
            gamesTable.search(this.value, {
                caseInsensitive: false
            }).draw();
        });

        function edit_game_modal_values(image, name, id) {
            let imageUrl = `url("${hostUrl}/${image}")`;
            $('#edit-game-background-image').css('background-image', imageUrl);
            $('#edit-game-name').val(name);
            $('#edit-game-id').val(id);
        }
    </script>

	<script src="{{ asset('backend/assets/js/custom/apps/user-management/users/list/add.js')}}"></script>

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