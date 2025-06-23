@extends('frontend.app')

@section('css')
<style>
    .section--first {
        padding-top: 144px !important;
    }

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

        .email-notification-header {
            min-width: 400px;
        }
    }

    @media (max-width: 768px) {
        .email-notification {
            justify-content: space-between;
        }
    }

</style>
@endsection

@section('content')
<section class="section section--bg section--first" style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
    <div class="row m-0 position-relative zi-2">
        <div class="d-none d-lg-block col-md-2 p-0">
            @include('frontend.includes.sidebar')
        </div>

        <div class="col-md-12 col-lg-10 pt-5">
            <div class="row">
                <div class="col-12 mb-5" style="max-width: 1048px;">
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="bi bi-gear fs-20 fw-bold text-default"></i>
                        <h3 class="ml-2 mb-0 fw-bold text-theme-primary first-letter-cap">Account settings</h3>
                    </div>

                    <div class="d-flex flex-column mb-4">
                        <h4 class="text-theme-primary fw-bold">Profile</h4>
                        <div class="d-flex flex-column background-theme-body-1 text-theme-primary border-theme-1 w-100 br-7 mb-3 fs-14">
                            <div class="d-flex background-theme-body-1 text-theme-primary dividor-border-theme-bottom w-100 p-4">
                                <div class="d-none d-md-block mr-5 fw-bold" style="min-width: 151px;">Email:</div>
                                <div class="d-flex flex-column w-100">
                                    <div class="d-flex justify-content-between d-md-none mb-2">
                                        <div class="mr-5 fw-bold">Email:</div>
                                    </div>
                                    <form method="POST" action="{{ url('update_account') }}" class="d-flex justify-content-between mb-2">
                                        @csrf
                                        <input type="text" class="input-theme-1 form-control fs-14 email-input email-edit-data-1" disabled value="{{ $user->email }}" style="width: 320px;">
                                        <input type="text" class="input-theme-1 form-control fs-14 email-input d-none email-edit-data-2 " placeholder="{{ $user->email }}" style="width: 320px;" required>
                                        <div class="d-flex fs-13">
                                            <span class="text-theme-secondary cursor-pointer mr-3 d-none email-edit-data-2" onclick="cancel_fields('email')">CANCEL</span>
                                            {{-- <span class="text-theme-marine cursor-pointer email-edit-data-1" onclick="edit_fields('email')">EDIT</span> --}}
                                            <button class="h-fit text-theme-marine cursor-pointer d-none email-edit-data-2" type="submit">SAVE</button>
                                        </div>

                                    </form>
                                    <div class="d-flex flex-column fs-13">
                                        <div class="email-edit-data-1">
                                            <span class="text-theme-teal">Verified</span>
                                            <span class="text-theme-secondary">This email is linked to your account. It is not visible to other users.</span>
                                        </div>
                                        <div class="d-flex flex-column d-none email-edit-data-2 ">
                                            <span class="text-theme-secondary mb-3">Current email: syedjalal339@gmail.com</span>
                                            <div class="d-flex background-theme-marine-light brand-theme-dark px-3 py-2 br-3">
                                                - After confirming the email change, you will be logged out <br>

                                                - Email can only be changed if you are using the email/password login flow <br>

                                                - Email change link will be sent to your new inbox <br>

                                                - You can change your email once 30 days <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex background-theme-body-1 text-theme-primary border-theme-1 w-100 p-4 mb-3">
                                <div class="d-none d-md-block mr-5 fw-bold" style="min-width: 151px;">Username:</div>
                                <div class="d-flex flex-column w-100">
                                    <div class="d-flex justify-content-between d-md-none mb-2">
                                        <div class="mr-5 fw-bold">Username:</div>
                                        <div class="d-flex fs-13">
                                            <span class="text-theme-secondary cursor-pointer mr-3 d-none username-edit-data-2" onclick="cancel_fields('username')">CANCEL</span>
                                            <span class="text-theme-marine cursor-pointer username-edit-data-1" onclick="edit_fields('username')">EDIT</span>
                                            <button class="h-fit text-theme-marine cursor-pointer d-none username-edit-data-2" type="submit">SAVE</button>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ url('update_account') }}" class="d-flex justify-content-between mb-2">
                                        @csrf
                                        <input type="text" class="input-theme-1 form-control fs-14 username-input username-edit-data-1" disabled value="{{ $user->username }}" style="width: 320px;">
                                        <input type="text" class="input-theme-1 form-control fs-14 username-input d-none username-edit-data-2" name="username" placeholder="{{ $user->username }}" style="width: 320px;" required>
                                        <div class="d-flex fs-13 d-none d-md-block">
                                            <span class="text-theme-secondary cursor-pointer mr-3 d-none username-edit-data-2" onclick="cancel_fields('username')">CANCEL</span>
                                            <span class="text-theme-marine cursor-pointer username-edit-data-1" onclick="edit_fields('username')">EDIT</span>
                                            <button class="h-fit text-theme-marine cursor-pointer d-none username-edit-data-2" type="submit">SAVE</button>
                                        </div>
                                    </form>
                                    <div class="d-flex flex-column fs-13">
                                        <div class="">
                                            <span class="text-theme-secondary">Name that is visible to other Eldorado users. You can change your username once every 90 days.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex background-theme-body-1 text-theme-primary  w-100 p-4 mb-3">
                                <div class="d-flex password-edit-data-1">
                                    <div class="mr-5 fw-bold d-none d-md-block" style="min-width: 151px;">Password:</div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between d-md-none mb-2">
                                            <div class="mr-5 fw-bold">Password:</div>
                                        </div>
                                        <div>
                                            <button class="btn form__btn py-2 mb-2" onclick="edit_fields('password')">Change password</button>
                                        </div>
                                        <div class="d-flex flex-column fs-13">
                                            <span class="text-theme-secondary">Password can only be changed if you are using the email/password login flow</span>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ url('update_account') }}" class="d-flex flex-column d-none password-edit-data-2" id="passwordForm">
                                    @csrf
                                    <div class="d-flex mb-3">
                                        <div class="mr-5 fw-bold d-none d-md-block" style="min-width: 151px;">Old password:</div>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between d-md-none mb-2">
                                                <div class="mr-5 fw-bold">Old password:</div>
                                            </div>
                                            <div class="position-relative">
                                                <input type="password" class="input-theme-1 form-control fs-14 password-input" name="old_password" id="old-password" placeholder="Enter old password" style="width: 320px;" required>
                                                <div class="position-absolute cursor-pointer" onclick="toggle_input_visibility('old-password');" style="top: 21%;right: 13px;">
                                                    <i class="bi bi-eye text-default"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="mr-5 fw-bold d-none d-md-block" style="min-width: 151px;">New password:</div>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between d-md-none mb-2">
                                                <div class="mr-5 fw-bold">New password:</div>
                                            </div>
                                            <div class="mb-2 position-relative">
                                                <input type="password" class="input-theme-1 form-control fs-14 password-input" name="new_password" id="new-password" oninput="updatePasswordValidationUI(this.value);" placeholder="Enter new password" style="width: 320px;" required>
                                                <div class="position-absolute cursor-pointer" onclick="toggle_input_visibility('new-password');" style="top: 21%;right: 13px;">
                                                    <i class="bi bi-eye text-default"></i>
                                                </div>
                                            </div>
                                            <div class="fs-12" id="password-rules">
                                                <div id="rule-lower" class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must contain a lowercase letter
                                                </div>
                                                <div id="rule-upper" class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must contain an uppercase letter
                                                </div>
                                                <div id="rule-number" class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must contain a number
                                                </div>
                                                <div id="rule-length" class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must be at least 8 characters long
                                                </div>
                                                <div id="rule-spaces" class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must not contain leading or trailing spaces
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="mr-5 fw-bold d-none d-md-block" style="min-width: 151px;">Re-enter new password:</div>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between d-md-none mb-2">
                                                <div class="mr-5 fw-bold">Re-enter new password:</div>
                                            </div>
                                            <div class="position-relative">
                                                <input type="password" class="input-theme-1 form-control fs-14 password-input" name="again_password" id="again-password" placeholder="Re-enter your new password" style="width: 320px;" required>
                                                <div class="position-absolute cursor-pointer" onclick="toggle_input_visibility('again-password');" style="top: 21%;right: 13px;">
                                                    <i class="bi bi-eye text-default"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="mr-5 fw-bold d-none d-md-block" style="min-width: 151px;"></div>
                                        <button class="btn form__btn py-2 mb-2 mr-2" type="submit">Change password</button>
                                        <button class="btn btn-dark py-2 mb-2 fs-14" type="button" onclick="cancel_fields('password')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-4">
                        <h4 class="text-theme-primary fw-bold">Profile picture</h4>
                        <div class="d-flex flex-column background-theme-body-1 text-theme-primary border-theme-1 w-100 br-7 mb-3 fs-14">
                            <div class="d-flex align-items-center background-theme-body-1 text-theme-primary w-100 p-3 p-md-4 mb-3">

                                <div class="mr-3 mr-md-5 fw-bold" style="min-width: 151px;">
                                    @if($user->profile != null)
                                        <img src="{{ asset('uploads/profile/') }}/{{ $user->profile }}" onclick="document.getElementById('imageInput').click();" class="seller-avatar-header h-100 w-100 cursor-pointer" alt="">
                                    @else
                                        <a href="#" role="button" onclick="document.getElementById('imageInput').click()" 
                                        class="seller-avatar-header mr-2" style="width:100px;height:100px;font-size:32px;">
                                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                                        </a>
                                    @endif
                                </div>

                                <form method="POST" action="{{ url('update_account') }}" class="d-flex flex-column" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <!-- Hidden File Input -->
                                        <input type="file" name="profile" id="imageInput" accept="image/*" style="display: none;" required>
                                        <input type="hidden" name="old_profile" value="{{ $user->profile }}">

                                        <!-- Styled Button -->
                                        <button type="button" class="btn form__btn py-2 mb-2" onclick="document.getElementById('imageInput').click()">
                                            Upload Image
                                        </button>
                                    </div>
                                    <div class="d-flex flex-column fs-13">
                                        <span class="text-theme-secondary">Must be JPEG, PNG or HEIC and cannot exceed 10MB.</span>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-4">
                        <h4 class="text-theme-primary fw-bold">Email notifications</h4>
                        <div class="d-flex flex-column background-theme-body-1 text-theme-primary border-theme-1 w-100 br-7 mb-3 fs-14">
                            <div class="p-4 mb-3 dividor-border-theme-bottom">
                                <h6 class="fw-bold">All email notifications</h6>
                            </div>
                            <div class="d-flex flex-column">
                                @foreach ($email_notifications as $key => $notification)    
                                    <div class="d-flex flex-row align-items-center email-notification w-100 px-2 px-md-5 mb-4">
                                        <div class="d-flex flex-column email-notification-header">
                                            <span class="fw-bold">{{ $notification->name }}</span>
                                            <span class="text-theme-secondary">{{ $notification->description }}</span>
                                        </div>
                                        <div class="d-flex">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" onchange="toggleNotification(this)"
                                                {{ optional(auth()->user()->emailNotifications)->contains($notification->id) ? 'checked' : '' }}
                                                class="custom-control-input service-toggle"
                                                data-notification-id="{{ $notification->id }}" 
                                                id="email_notification_{{$key}}">
                                                <label class="custom-control-label cursor-pointer" for="email_notification_{{$key}}"></label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-4">
                        <h4 class="text-theme-primary fw-bold">Your description</h4>
                        <form  method="POST" action="{{ url('update_account') }}" class="d-flex flex-column background-theme-body-1 text-theme-primary border-theme-1 w-100 br-7 mb-3 fs-14 p-md-4">
                            @csrf
                            <div class="d-flex flex-column mb-3">
                                <textarea class="textarea fs-14 auto-resize-textarea resize-none overflow-hidden scroll-bar-theme-bg-card input-theme-1 form-control w-100 description-edit-data-1" 
                                id="description-textarea" rows="2" disabled placeholder="Type here...">{{ $user->description }}</textarea>
                                <textarea name="description" class="textarea fs-14 auto-resize-textarea resize-none overflow-hidden scroll-bar-theme-bg-card input-theme-1 form-control w-100 d-none description-edit-data-2" id="" rows="2" style="min-height: 60px;" maxlength="500" placeholder="Type here..." required>{{ $user->description }}</textarea>
                            </div>
                            <div class="description-edit-data-1">
                                <button onclick="edit_fields('description');" type="button" class="btn form__btn py-2 mb-2">
                                    Change description
                                </button>
                            </div>
                            <div class="d-none description-edit-data-2 d-flex justify-content-between">
                                <button type="submit" class="btn form__btn py-2 mb-2">
                                    Save
                                </button>
                                <button onclick="cancel_fields('description')" type="button" class="btn btn-dark fs-14 py-2 mb-2">
                                    Cancel
                                </button>
                            </div>
                            
                        </form>
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
        if (!$('.select2').hasClass('select2-container--default')) {
            initPage();
        }
    });

    function initPage() {
        // Apply Select2 to all select elements
        $('.select2').select2({
            dropdownPosition: 'below'
        , });

        setTimeout(() => {
            $('.skeleton-overlay-start').remove();
        }, 700);

        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const password = document.getElementById('new-password').value;
            const againPassword = document.getElementById('again-password').value;
            const rules = validatePassword(password);

            const allPassed = Object.values(rules).every(v => v === true);
            if (!allPassed) {
                e.preventDefault();
                toastr.error('Please meet all password requirements before submitting.');
            }

            if(password !== againPassword){
                e.preventDefault();
                toastr.error('Please make sure the new password and confirmation match.');
            }

        });

        document.getElementById('imageInput').addEventListener('change', function () {
            if (this.files.length > 0) {
                this.form.submit();
            }
        });
    }

    function edit_fields(classData) {
        $(`.${classData}-edit-data-2`).removeClass('d-none');
        $(`.${classData}-edit-data-1`).addClass('d-none');

        if(classData == 'description') {
            const textarea = document.getElementById('description-textarea');

            const textareas = document.querySelectorAll('.auto-resize-textarea');
            textareas.forEach(textarea => {
                autoResize(textarea); // Resize on load
                textarea.addEventListener('input', () => autoResize(textarea)); // Resize on input
            });
        }
    }

    function cancel_fields(classData) {
        $(`.${classData}-edit-data-1`).removeClass('d-none');
        $(`.${classData}-edit-data-2`).addClass('d-none');

        if(classData == 'description') {
            const textarea = document.getElementById('description-textarea');

            const textareas = document.querySelectorAll('.auto-resize-textarea');
            textareas.forEach(textarea => {
                autoResize(textarea); // Resize on load
                textarea.addEventListener('input', () => autoResize(textarea)); // Resize on input
            });
        }
    }

    function updatePasswordValidationUI(password) {
        const rules = validatePassword(password);
        
        updateRule('rule-lower', rules.hasLowercase);
        updateRule('rule-upper', rules.hasUppercase);
        updateRule('rule-number', rules.hasNumber);
        updateRule('rule-length', rules.minLength);
        updateRule('rule-spaces', rules.noSpaces);
    }

    function toggleNotification(element) {
        const notificationId = element.dataset.notificationId;
        const isChecked = element.checked;

        $.get("/toggle-email-notification", {
            notification_id: notificationId,
            subscribed: isChecked
        }, function(data) {
            if (data.status === 'success') {
                
            } else {
                toastr.error('Failed to update.');
            }
        }).fail(function() {
            toastr.error('Something went wrong!');
        });
    }

</script>
@endsection
