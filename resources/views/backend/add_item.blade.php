@extends('backend.app')

@section('css')
    <style>
        .invalid {
            border: 1px solid red;
            border-color: red !important;
        }
    </style>
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <!--begin::Stepper-->
            <div class="stepper stepper-pills" id="kt_stepper_example_basic">
                <!--begin::Nav-->
                <div class="stepper-nav flex-center flex-wrap mb-10">

                    <!--begin::Step 1-->
                    <div class="stepper-item mx-2 my-4 current" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->

                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">1</span>
                        </div>
                        <!--end::Icon-->

                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">
                                Step 1
                            </h3>

                            <div class="stepper-desc">
                                Select Category
                            </div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 2-->
                    <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->

                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">2</span>
                        </div>
                        <!--begin::Icon-->

                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">
                                Step 2
                            </h3>

                            <div class="stepper-desc">
                                Add Details
                            </div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 2-->

                </div>
                <!--end::Nav-->

                <!--begin::Form-->
                <form class="form w-lg-700px mx-auto" action="{{ route('admin.item.store') }}" method="POST" novalidate="novalidate" id="kt_stepper_example_basic_form" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Group-->
                    <div class="mb-5">
                        <!--begin::Step 1-->
                        <div class="flex-column current" data-kt-stepper-element="content">
                            @foreach ($categories as $key => $category)
                                <div class="p-3 fs-16 fw-bold mb-2 category-select btn btn-light category-select" onclick="show_category_elements({{$category->id}})" id="category_{{$key}}">
                                    {{ $category->name }}
                                </div>
                            @endforeach
                            <input type="hidden" name="category_id" id="category_id">
                        </div>
                        <!--begin::Step 1-->

                        <!--begin::Step 1-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <div class="d-flex flex-column">
                                <div>
                                    <div class="row w-100">
                                        <div class="col-md-9">
                                            <div class="fv-row mb-10">
                                                <label class="form-label">Select game</label>
                                                <select class="form-select form-select-solid" data-control="select2" name="game_id" data-placeholder="Select an option" required>
                                                    <option value="">Select game</option>
                                                    @foreach ($games as $game)
                                                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-end mt-10">
                                                <button type="button" class="btn btn-icon btn-primary w-auto px-2 btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                                    <i class="las la-plus fs-2 me-2"></i> Add game
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row w-100 d-none 1_show 3_show">
                                        <div class="col-md-9">
                                            <div class="fv-row mb-10 w-100">
                                                <!--begin::Label-->
                                                <label class="form-label">
                                                    <span class="1_show d-none">Currency</span><span class="3_show d-none">Top Up</span> name
                                                </label>
                                                <!--end::Label-->
            
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid 1_r 3_r" name="name" placeholder="Name" value=""/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <div class="col-md-3">
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{asset('backend/assets/media/avatars/blank.png')}})">
                                                <!--begin::Image preview wrapper-->
                                                <div class="image-input-wrapper w-125px h-125px"></div>
                                                <!--end::Image preview wrapper-->

                                                <!--begin::Edit button-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                                    data-kt-image-input-action="change"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-dismiss="click"
                                                    title="Change image">
                                                    <i class="bi bi-pencil-fill fs-7"></i>

                                                    <!--begin::Inputs-->
                                                    <input type="file" name="image" class="1_r 3_r" accept="image/*" />
                                                    <input type="hidden" name="avatar_remove" />
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Edit button-->

                                                <!--begin::Cancel button-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                                    data-kt-image-input-action="cancel"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-dismiss="click"
                                                    title="Cancel avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Cancel button-->

                                                <!--begin::Remove button-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                                    data-kt-image-input-action="remove"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-dismiss="click"
                                                    title="Remove avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Remove button-->
                                            </div>
                                            <!--end::Image input-->
                                        </div>
                                    </div>
                                    <div class="fv-row mb-10 d-none 1_show">
                                        <label class="form-label">Select currency type</label>
                                        <select class="form-select form-select-solid 1_r" data-control="select2" name="currency_type" data-placeholder="Select an option">
                                            <option value="">Select currency type</option>
                                            <option value="K">K</option>
                                            <option value="M">M</option>
                                            <option value="unit">Unit</option>
                                        </select>
                                    </div>
                                    <div class="fv-row mb-10 d-none 1_show 3_show 4_show">
                                        <label class="form-label">Delivery type</label>
                                        <select class="form-select form-select-solid 1_r 3_r 4_r" data-control="select2" name="deliver_type" data-placeholder="Select an option">
                                            <option value="">Delivery type</option>
                                            <option value="Character name">Character name</option>
                                            <option value="Username">Username</option>
                                            <option value="user id">User id</option>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-column d-none 1_show 2_show 3_show 4_show 5_show">
                                        <div class="service-container mb-2">
                                            <div class="pb-5 mt-8 service_container_1 border-bottom position-relative" data-service-index="1">
                                                <div class="fv-row mb-10 w-100 tag-wrapper d-none 5_show">
                                                    <div class="d-flex justify-content-between position-relative">
                                                        <!--begin::Label-->
                                                        <label class="form-label">Service name</label>
                                                        <!--end::Label-->
                                                    </div>
                
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid tag-input 5_r" name="service_name_1" placeholder="Service name"/>
                                                    <div class="tag-container mt-3 d-flex flex-wrap gap-2"></div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="d-flex">
                                                    <h4 class="me-1">Attributes</h4>
                                                    <span class="fs-14 d-none 3_show">(first attribute should be the topup value)</span>
                                                </div>

                                                <template id="attribute-template-1">
                                                    <div class="d-flex flex-column bg-light-blue p-4 mb-3 position-relative attribute_container_1_1">
                                                        <div class="fv-row mb-10 w-100">
                                                            <label class="form-label">Add attribute name</label>
                                                            <input type="text" class="form-control form-control-solid" name="attribute_name_1_1[]" placeholder="Attribute name" value=""/>
                                                            <input type="hidden"  name="attribute_cloned_1_1[]" placeholder="Cloned" value="0"/>
                                                        </div>
                                                        <div class="fv-row mb-10 w-100 tag-wrapper">
                                                            <label class="form-label">Add options</label>
                                                            <input type="text" class="form-control form-control-solid tag-input" id="attribute_options_1_1" placeholder="Add options and press enter to add"/>
                                                            <div class="tag-container mt-3 d-flex flex-wrap gap-2"></div>
                                                        </div>
                                                    </div>
                                                </template>

                                                <div class="d-flex flex-column attribute-container-1 mb-3"></div>

                                                <div class="d-flex justify-content-end">
                                                    <button type="button" id="add-attribute-btn" class="btn btn-icon btn-primary w-150px me-2"><i class="las la-plus fs-2 me-2"></i> Add attribute</button>
                                                    <button type="button" id="link-attribute-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_link_attribute" 
                                                    onclick="document.getElementById('clone-service-id').value = 1" class="btn btn-icon btn-primary w-150px">
                                                        <i class="las la-copy fs-2 me-2"></i> Clone attribute
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end d-none 5_show">
                                            <button type="button" id="add-service-btn" class="btn btn-icon btn-secondary w-150px"><i class="las la-plus fs-2 me-2"></i> Add service</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin::Step 1-->
                    </div>
                    <!--end::Group-->

                    <!--begin::Actions-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="me-2">
                            <button type="button" class="btn btn-light btn-active-light-primary" onclick="hide_category_elements()" data-kt-stepper-action="previous">
                                Back
                            </button>
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Wrapper-->
                        <div>
                            <button type="button" class="btn btn-primary" id="stepper-submit-button" style="display: none;"
                                onclick="
                                    const form = document.getElementById('kt_stepper_example_basic_form');
                                    if (form.checkValidity()) {
                                        document.getElementsByClassName('form-1-wait')[0].classList.remove('d-none');
                                        document.getElementsByClassName('form-1-wait')[0].classList.add('d-block');
                                        document.getElementsByClassName('form-1-submit')[0].classList.add('d-none');
                                        document.getElementById('stepper-submit-button').disabled = true;
                                        form.submit();
                                    } else {
                                        form.reportValidity(); // show the validation messages
                                    }
                                    ">
                                <span class="indicator-label form-1-submit">
                                    Submit
                                </span>
                                <span class="indicator-progress form-1-wait">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>

                            {{-- <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                                Continue
                            </button> --}}
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
    </div>
@endsection

@section('js')
    <script>

        document.addEventListener("DOMContentLoaded", function () {
        
            let serviceIndex = 1;

            // Global event delegation for Add Attribute buttons
            document.addEventListener("click", function (e) {
                if (e.target && e.target.id === "add-attribute-btn") {
                    const serviceContainer = e.target.closest('[data-service-index]');
                    if (!serviceContainer) return;

                    const serviceNum = parseInt(serviceContainer.getAttribute('data-service-index'));
                    const attributeContainer = serviceContainer.querySelector(`.attribute-container-${serviceNum}`);
                    if (!attributeContainer) return;

                    const containers = attributeContainer.querySelectorAll(`[class*="attribute_container_${serviceNum}_"]`);

                    let maxAttrIndex = 0;
                    containers.forEach(container => {
                        const match = container.className.match(new RegExp(`attribute_container_${serviceNum}_(\\d+)`));
                        if (match) {
                            const idx = parseInt(match[1]);
                            if (idx > maxAttrIndex) {
                                maxAttrIndex = idx;
                            }
                        }
                    });

                    const nextAttrIndex = maxAttrIndex + 1;

                    const template = document.querySelector("#attribute-template-1");
                    const clone = template.content.cloneNode(true);
                    const attributeBlock = clone.querySelector(`[class*="attribute_container_1_1"]`);
                    attributeBlock.className = `d-flex flex-column bg-light-blue p-4 mb-3 position-relative attribute_container_${serviceNum}_${nextAttrIndex}`;

                    const inputs = attributeBlock.querySelectorAll("input");
                    inputs.forEach(input => {
                        input.value = "";
                        if (input.name.includes("attribute_name_")) {
                            input.name = `attribute_name_${serviceNum}_${nextAttrIndex}[]`;
                        }
                        if (input.name.includes("attribute_cloned_")) {
                            input.name = `attribute_cloned_${serviceNum}_${nextAttrIndex}[]`;
                            input.value = 0;
                        }
                        if (input.id.includes("attribute_options_")) {
                            input.id = `attribute_options_${serviceNum}_${nextAttrIndex}`;
                        }
                    });

                    const tagContainer = attributeBlock.querySelector(".tag-container");
                    if (tagContainer) tagContainer.innerHTML = "";

                    const closeBtn = document.createElement("button");
                    closeBtn.type = "button";
                    closeBtn.className = "btn btn-close btn-danger p-3 fs-14 position-absolute top-0 end-0 m-4 remove-attribute-btn";
                    attributeBlock.appendChild(closeBtn);

                    attributeContainer.appendChild(attributeBlock);
                }
            });

            // Tag input pill creation (global)
            document.addEventListener("keydown", function (e) {
                if (e.key === 'Enter' && e.target.classList.contains('tag-input')) {
                    e.preventDefault();
                    const input = e.target;
                    const value = input.value.trim();
                    if (!value) return;

                    const wrapper = input.closest('.tag-wrapper');
                    const container = wrapper.querySelector('.tag-container');

                    // Prevent duplicates
                    const isDuplicate = Array.from(container.querySelectorAll('input[type="hidden"]'))
                        .some(hidden => hidden.value === value);
                    if (isDuplicate) {
                        input.value = '';
                        return;
                    }

                    const pill = document.createElement('span');
                    pill.className = 'badge bg-primary text-white d-flex align-items-center px-3 py-2 rounded-pill';
                    pill.innerHTML = `
                        ${value}
                        <button type="button" class="btn-close btn-close-white btn-sm ms-2 btn-close-pill" aria-label="Remove"></button>
                    `;

                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = input.id + '[]'; // use ID as base for name
                    hiddenInput.value = value;

                    pill.appendChild(hiddenInput);
                    container.appendChild(pill);

                    // // Remove pill
                    // pill.querySelector('button').addEventListener('click', () => pill.remove());

                    input.value = '';
                }
            });

            // Tag input pill remove
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-close-pill')) {
                    const container = e.target.closest('.rounded-pill');
                    if (container) container.remove();
                }
            });

            // Remove Attributes container
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-attribute-btn')) {
                    const container = e.target.closest('.bg-light-blue');
                    if (container) container.remove();
                }
            });

            // Remove Service container
            document.addEventListener("click", function (e) {
                if (e.target.classList.contains("remove-service-btn")) {
                    const serviceContainer = e.target.closest('[data-service-index]');
                    if (serviceContainer) {
                        serviceContainer.remove();
                    }
                }
            });

            // Optional: Add Service Button (clone entire service block)
            document.getElementById("add-service-btn").addEventListener("click", function () {
                serviceIndex++;

                // Clone the first service container
                const originalService = document.querySelector(".service_container_1");
                const clone = originalService.cloneNode(true);

                // Reset and update service container
                clone.classList.remove("service_container_1");
                clone.classList.add(`service_container_${serviceIndex}`);

                clone.setAttribute('data-service-index', serviceIndex);

                // Update service name input
                const serviceNameInput = clone.querySelector('input[name^="service_name_"]');
                if (serviceNameInput) {
                    serviceNameInput.value = "";
                    serviceNameInput.name = `service_name_${serviceIndex}`;
                }

                // Update attribute wrapper
                const attributeWrapper = clone.querySelector('[class*="attribute-container-"]');
                attributeWrapper.className = `d-flex flex-column attribute-container-${serviceIndex} mb-3`;

                // Remove all but first attribute block
                const allAttributes = attributeWrapper.querySelectorAll('[class*="attribute_container_"]');
                allAttributes.forEach((attrBlock, i) => {
                    // if (i > 0) attrBlock.remove();
                    attrBlock.remove();
                });

                // Find the link button inside the cloned container
                const linkBtn = clone.querySelector("#link-attribute-btn");

                // IMPORTANT: IDs must be unique, so change the ID
                if (linkBtn) {
                    linkBtn.id = `link-attribute-btn-${serviceIndex}`;
                    linkBtn.setAttribute("onclick", `document.getElementById('clone-service-id').value = ${serviceIndex}`);
                }

                // // Update first attribute block
                // const firstAttribute = attributeWrapper.querySelector('[class*="attribute_container_"]');
                // firstAttribute.className = `d-flex flex-column bg-light-blue p-4 mb-3 position-relative attribute_container_${serviceIndex}_1`;
                

                // // Update attribute name input
                // const attrNameInput = firstAttribute.querySelector('input[name^="attribute_name"]');
                // if (attrNameInput) {
                //     attrNameInput.value = "";
                //     attrNameInput.name = `attribute_name_${serviceIndex}_1[]`;
                // }

                // // Update tag input + container
                // const tagInput = firstAttribute.querySelector('input[id^="attribute_options_"]');
                // if (tagInput) {
                //     tagInput.value = "";
                //     tagInput.id = `attribute_options_${serviceIndex}_1`;
                // }

                // const tagContainer = firstAttribute.querySelector('.tag-container');
                // if (tagContainer) tagContainer.innerHTML = "";

                // Add close button to service block
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-close btn-danger p-3 fs-14 position-absolute end-0 top-[-12px] z-index-3 remove-service-btn';
                clone.appendChild(removeBtn);

                // Append to the wrapper
                document.querySelector(".service-container").appendChild(clone);
            });
        });

        function show_category_elements(class_name) {            
            $(`.${class_name}_show`).removeClass('d-none');

            $(`.${class_name}_r`).attr('required', true);

            $('#category_id').val(class_name);
        }

        function hide_category_elements() {
            $('.\\31 _show, .\\32 _show, .\\33 _show, .\\34 _show, .\\35 _show').addClass('d-none');
            $('.\\31 _r, .\\32 _r, .\\33 _r, .\\34 _r, .\\35 _r').removeAttr('required');
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("current");
            y = x[1].getElementsByTagName("input");
            var checkboxes = Array.from(y).filter(input => input.type === 'checkbox');
            var y = Array.from(y).filter(input => input.type !== 'checkbox');
            z = x[1].getElementsByTagName("select");
            t = x[1].getElementsByTagName("textarea");

            // checkboxes
            // for (i = 0; i < checkboxes.length; i++) {
            //     // If a field is empty...
            //     if ($(checkboxes[i]).attr('required') && $(checkboxes[i]).attr('type') == 'checkbox' && !$(checkboxes[i]).is(':checked')) {
            //         if (checkboxes[i].name == 'termsService' || checkboxes[i].name == 'sellerRules') {
            //             $('.rules_error').removeClass("d-none");
            //         }
            //         valid = false;
            //     } else if ($(checkboxes[i]).attr('required')) {
            //         $('.rules_error').addClass("d-none");
            //     }
            // }

            // inputs
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "" && $(y[i]).attr('required')) {
                    y[i].classList.add("invalid");
                    valid = false;

                    if (y[i].name == "feature_image") {
                        $('.images_section').addClass("invalid");
                    }
                } else {
                    y[i].classList.remove("invalid");

                    if (y[i].name == "feature_image") {
                        $('.images_section').removeClass("invalid");
                    }
                }
            }
            // select boxes
            for (i = 0; i < z.length; i++) {
                // If a field is empty...
                if (z[i].value == "" && $(z[i]).attr('required')) {
                    $('#' + z[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid red');
                    // and set the current valid status to false:
                    valid = false;
                } else {
                    $('#' + z[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid #aaaaaa');
                }
            }
            // text areas
            for (i = 0; i < t.length; i++) {
                // If a field is empty...
                if (t[i].value == "" && $(t[i]).attr('required')) {
                    // add an "invalid" class to the field:
                    t[i].classList.add("invalid");
                    // and set the current valid status to false:
                    valid = false;
                } else {
                    t[i].classList.remove("invalid");
                }
            }

            return valid; // return the valid status
        }

        function clone_attribute() {
            var attributeId = $('#clone-attribute-id').val();
            var serviceId = $('#clone-service-id').val();

            $.ajax({
                url: '/admin/get_attribute', 
                type: 'GET',             
                data: {
                    attributeId: attributeId,
                },
                success: function(response) {
                    ////// Add Clone Attribute //////////////////////////////////////
                        const serviceContainer = $(`.service_container_${serviceId}`)[0];
                        if (!serviceContainer) return;
        
                        const serviceNum = parseInt(serviceContainer.getAttribute('data-service-index'));
                        const attributeContainer = serviceContainer.querySelector(`.attribute-container-${serviceNum}`);
                        if (!attributeContainer) return;
        
                        const containers = attributeContainer.querySelectorAll(`[class*="attribute_container_${serviceNum}_"]`);
        
                        let maxAttrIndex = 0;
                        containers.forEach(container => {
                            const match = container.className.match(new RegExp(`attribute_container_${serviceNum}_(\\d+)`));
                            if (match) {
                                const idx = parseInt(match[1]);
                                if (idx > maxAttrIndex) {
                                    maxAttrIndex = idx;
                                }
                            }
                        });
        
                        const nextAttrIndex = maxAttrIndex + 1;
        
                        const template = document.querySelector("#attribute-template-1");
                        const clone = template.content.cloneNode(true);
                        const attributeBlock = clone.querySelector(`[class*="attribute_container_1_1"]`);
                        attributeBlock.className = `d-flex flex-column bg-light-blue p-4 mb-3 position-relative attribute_container_${serviceNum}_${nextAttrIndex}`;
        
                        const inputs = attributeBlock.querySelectorAll("input");
                        inputs.forEach(input => {
                            input.value = "";
                            if (input.name.includes("attribute_name_")) {
                                input.name = `attribute_name_${serviceNum}_${nextAttrIndex}[]`;
                                input.value = response.name;
                            }
                            if (input.name.includes("attribute_cloned_")) {
                                input.name = `attribute_cloned_${serviceNum}_${nextAttrIndex}[]`;
                                input.value = 1;
                            }
                            if (input.id.includes("attribute_options_")) {
                                input.id = `attribute_options_${serviceNum}_${nextAttrIndex}`;
                            }
                        });

                        html = '';
                        for(let i = 0; i < response.options.length; i++){
                            html += `
                                <span class="badge bg-primary text-white d-flex align-items-center px-3 py-2 rounded-pill">
                                    ${response.options[i]}
                                    <button type="button" class="btn-close btn-close-white btn-sm ms-2 btn-close-pill" aria-label="Remove"></button>
                                    <input type="hidden" name="attribute_options_${serviceNum}_${nextAttrIndex}[]" value="${response.options[i]}">
                                </span>
                            `
                        }
        
                        const tagContainer = attributeBlock.querySelector(".tag-container");
                        if (tagContainer) tagContainer.innerHTML = html;
        
                        const closeBtn = document.createElement("button");
                        closeBtn.type = "button";
                        closeBtn.className = "btn btn-close btn-danger p-3 fs-14 position-absolute top-0 end-0 m-4 remove-attribute-btn";
                        attributeBlock.appendChild(closeBtn);
        
                        attributeContainer.appendChild(attributeBlock);
                    ////////////////////////////////////////////////////////////
                }
            });

        }

        // Stepper lement
        var element = document.querySelector("#kt_stepper_example_basic");

        // Initialize Stepper
        var stepper = new KTStepper(element);

        // Handle next step
        stepper.on("kt.stepper.next", function (stepper) {
            if(validateForm())
            stepper.goNext(); // go next step
        });

        $('.category-select').on('click', function () {
            stepper.goNext();
            $('#stepper-submit-button').show();
        });

        // Handle previous step
        stepper.on("kt.stepper.previous", function (stepper) {
            stepper.goPrevious(); // go previous step
            $('#stepper-submit-button').hide();
        });

        

    </script>

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

    <!--begin::Modal - Clone attribute-->
    <div class="modal fade" id="kt_modal_link_attribute" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_link_attribute_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Link Attribute</h2>
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
                    <form id="kt_modal_link_attribute_form" class="form" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_link_attribute_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_link_attribute_header" data-kt-scroll-wrappers="#kt_modal_link_attribute_scroll" data-kt-scroll-offset="300px">
                            <div class="fv-row mb-10">
                                <label class="form-label">Select attribute</label>
                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_link_attribute" id="clone-attribute-id" data-placeholder="Select an option" required>
                                    <option value="">Select attribute</option>
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">
                                            {{ $attribute->name }} - (
                                                @foreach ($attribute->options as $key => $option)
                                                    @if($key != 0) - @endif {{$option}}
                                                @endforeach
                                            )
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" class="form-control form-control-solid mb-3 mb-lg-0" id="clone-service-id" />
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                            <button type="button" class="btn btn-primary edit-submit-button" data-bs-dismiss="modal" onclick="clone_attribute()">
                                <span class="indicator-label edit-game-submit"><i class="las la-copy fs-2 me-1"></i> Clone</span>
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
    <!--end::Modal - Clone attribute-->

    <script src="{{ asset('backend/assets/js/custom/apps/user-management/users/list/add.js')}}"></script>
@endsection