@extends('frontend.app')

@section('css')
    <style>
        .offers_img {
            position: absolute;
            top: -2px;
            right: -67px;
            width: 69%;
        }
    
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container mb-5" style="max-width: 1118px;">
            <div class="row col-12">
                <img src="{{ asset($categoryGame->game->image) }}" style="width: 23px;height: max-content;">
                <h5 class="mb-4 ml-2 text-white">{{ $categoryGame->game->name }} {{ $categoryGame->title }}</h5>
            </div>
            <div class="alerts col-12 w-100">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
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
            <div class="row">
                <div class="col-md-7 m-0 p-0 mb-4 pt-4">
                    <div class="d-flex flex-column">
                        <h4 class="bg-blue text-white text-center p-0 px-md-10 py-3 m-0 fw-bold fs-16 fs-md-22">Best boosting deals in under 2 minutes</h4>
                        <div class="background-theme-body-1 border-theme-1 p-3 px-md-10 py-4">
                            <form action="{{url('save-service')}}" id="service_form" class="select-2-dark">
                                <div class="pb-4">
                                    <select name="service_id" id="service" class="select2  hidden-until-ready" required>
                                        <option value="" disabled selected>Choose a Service</option>
                                        @foreach ($categoryGame->services as $service)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="renderAttributes" id="renderAttributes">

                                </div>
                                <div class="mt-4">
                                    <button type="button" onclick="validateForm('service_form')" class="btn btn-dark">Send Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 p-0 px-md-3">
                    <div class="pt-4 position-relative overflow-hidden">
                        <div class="pt-2 pl-4 background-theme-body-1 border-theme-1 text-theme-primary fw-bold w-100">
                            <ol class="list-unstyled circle-ol mb-0">
                                <li class="fs-15">Get offers</li>
                                <li class="fs-15">Choose the best booster</li>
                                <li class="fs-15">Purchase service</li>
                                <li class="fs-15">Level up!</li>
                            </ol>
                            <div class="offers_img">
                                <img class="w-100" src="{{asset('images/character.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="pageOverlay">
            <div class="spinner-border text-light" role="status"></div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Select 2
        $(document).ready(function() {
            // Apply Select2 to all select elements
            $('.select2').select2({
                dropdownPosition: 'below',
            });
        });
        function validateForm(id) {
            let valid = true;
            let inputs = [], selects = [], textareas = [];

            const sections = document.getElementsByClassName("section");

            for (let i = 0; i < sections.length; i++) {
                inputs.push(...sections[i].getElementsByTagName("input"));
                selects.push(...sections[i].getElementsByTagName("select"));
                textareas.push(...sections[i].getElementsByTagName("textarea"));
            }

            // ✅ Validate checkboxes
            for (let i = 0; i < inputs.length; i++) {
                const input = inputs[i];
                if ($(input).attr('required') && $(input).attr('type') === 'checkbox' && !$(input).is(':checked')) {
                    valid = false;
                }
            }

            // ✅ Validate inputs
            for (let i = 0; i < inputs.length; i++) {
                const input = inputs[i];

                if (input.value.trim() === "" && $(input).attr('required')) {
                    input.classList.add("invalid");
                    valid = false;
                } else {
                    input.classList.remove("invalid");
                }
            }

            // ✅ Validate selects
            for (let i = 0; i < selects.length; i++) {
                const select = selects[i];
                if (select.value === "" && $(select).attr('required')) {
                    $('#' + select.id).next('.select2-container').find('.select2-selection').css('border', '1px solid red');
                    valid = false;
                } else {
                    $('#' + select.id).next('.select2-container').find('.select2-selection').css('border', '1px solid #aaaaaa');
                }
            }

            // ✅ Validate textareas
            for (let i = 0; i < textareas.length; i++) {
                const textarea = textareas[i];
                if (textarea.value.trim() === "" && $(textarea).attr('required')) {
                    textarea.classList.add("invalid");
                    valid = false;
                } else {
                    textarea.classList.remove("invalid");
                }
            }

            if(valid == true){
                const overlay = document.getElementById('pageOverlay');
                overlay.style.display = 'flex';

                $(`#${id}`).submit();
            }
        }
        $(document).ready(function () {
            // Service change listener
            $('#service').on('change', function () {
                let serviceId = $(this).val();
                $('#category_game_id').val(serviceId);
                $.get('/get-service-attributes', {service_id: serviceId,}, function (data) {
                    $('#renderAttributes').empty();

                    renderAttributes(data, 'renderAttributes', );
                });

            });
        });
        function renderAttributes(data, targetId) {
            data.attributes.forEach(attr => {
                let inputField = '';

                if(attr.title == 1){
                    $('input[name="title"]').val(attr.name);
                }

                if (attr.type === 'text') {
                    inputField = `<input type="text" name="attribute_${attr.id}" placeholder="${attr.options[0]}" class="form-control input-theme-1" required/>`;

                    $(`#${targetId}`).append(`
                        <div class="attribute-item pb-4">
                            <label class="fs-13 text-black-70">Input your ${attr.name}</label>
                            ${inputField}
                        </div>
                    `);
                } else if (attr.type === 'select') {

                    let selectClass = attr.topup === 1 ? 'topup_select_boxes' : 'attribute_select_boxes';
                    
                    let options = `<option value="" disabled selected>Select `+attr.name+`</option>` + // Add the default "Select" option
                    attr.options.map(option => `<option value="${option}">${option}${attr.topup === 1 ? ' ' + attr.name : ''}</option>`).join('');
                    inputField = `<select name="attribute_${attr.id}" id="attribute_${attr.id}" class="form-control ${selectClass} select2" required>${options}</select>`;

                    $(`#${targetId}`).append(`
                        <div class="attribute-item pb-4">
                            <label class="fs-13 text-black-70">Select your ${attr.name}</label>
                            ${inputField}
                        </div>
                    `);
                }
            });

            if(data.name !== 'Custom Request'){
                $(`#${targetId}`).append(`
                    <div class="attribute-item pb-4">
                        <label class="fs-13 text-black-70">Provide any additional information (Optional)</label>
                        <input type="text" name="description" placeholder="e.g. I need it till tomorrow..." class="form-control input-theme-1"/>
                    </div>
                `);
            }else {
                $(`#${targetId}`).append(`
                    <div class="attribute-item pb-4">
                        <label class="fs-13 text-black-70">Describe your request</label>
                        <input type="text" name="description" placeholder="e.g. need help ..." class="form-control input-theme-1" required/>
                    </div>
                `);
            }

            // Selet2 Initialization
                $('select').select2({
                    dropdownPosition: 'below',
                });
                $('select').on('select2:open', function() {
                    const searchBox = $('.select2-container--open .select2-search__field');
                    
                    // Simple mobile device check
                    const isMobile = /iPhone|Android|iPad|iPod|Mobile/i.test(navigator.userAgent);

                    if (!isMobile && searchBox.length) {
                        if (!searchBox.is(':focus')) {
                            searchBox[0].focus(); // Access the raw DOM element
                        }
                    }
                });
            ////
        }
    </script>
@endsection
