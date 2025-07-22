@extends('backend.app')

@section('css')
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 pb-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Add Article</h2>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">

                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <a href="{{ url('admin/articles') }}" class="btn btn-primary">Search Articles</a>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
                
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div id="table-container" style="max-width: 1048px;">
                <form id="kt_modal_add_article_form" class="form" action="{{ url('admin/store_article') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column me-n7 pe-7" id="kt_modal_add_article_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        
                        <div class="fv-row mb-10">
                            <label class="required fw-bold fs-6 mb-2">Select category</label>
                            <select class="form-select form-select-solid" data-control="select2" name="category_id" data-placeholder="Select an option" required>
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Add title</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="title" required/>
                            <!--end::Input-->
                        </div>

                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Short Description</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="short_description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Short Description" required></textarea>
                            <!--end::Input-->
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Add description</label>
                            <textarea name="description" id="kt_docs_ckeditor_classic"></textarea>
                        </div>

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary edit-submit-button"
                            onclick="
                                const form = document.getElementById('kt_modal_edit_article_form');
                                if (form.checkValidity()) {
                                    document.getElementsByClassName('edit-article-wait')[0].classList.remove('d-none');
                                    document.getElementsByClassName('edit-article-wait')[0].classList.add('d-block');
                                    document.getElementsByClassName('edit-article-submit')[0].classList.add('d-none');
                                    document.getElementsByClassName('edit-submit-button')[0].disabled = true;
                                    form.submit();
                                } else {
                                    form.reportValidity(); // show the validation messages
                                }
                                ">
                            <span class="indicator-label edit-article-submit">Submit</span>
                            <span class="edit-article-wait d-none">Please wait...  
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection

@section('js')
    <script src="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{ asset('backend/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        ClassicEditor
            .create(document.querySelector('#kt_docs_ckeditor_classic'), {
                ckfinder: {
                    uploadUrl: '{{ route("admin.ckeditor.upload", ["_token"=>csrf_token()]) }}',
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
        
    </script>

@endsection