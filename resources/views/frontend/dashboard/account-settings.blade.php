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
                                <div class="mr-5 fw-bold" style="min-width: 151px;">Email:</div>
                                <div class="d-flex flex-column w-100">
                                    <form class="d-flex justify-content-between mb-2">
                                        <input type="text" class="input-theme-1 form-control fs-14 email-input email-edit-data-1" disabled value="{{ $user->email }}" style="width: 320px;">
                                        <input type="text" class="input-theme-1 form-control fs-14 email-input d-none email-edit-data-2 " placeholder="{{ $user->email }}" style="width: 320px;" required>
                                        <div class="d-flex fs-13">
                                            <span class="text-theme-secondary cursor-pointer mr-3 d-none email-edit-data-2" onclick="cancel_fields('email')">CANCEL</span>
                                            <span class="text-theme-marine cursor-pointer email-edit-data-1" onclick="edit_fields('email')">EDIT</span>
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
                                <div class="mr-5 fw-bold" style="min-width: 151px;">Username:</div>
                                <div class="d-flex flex-column w-100">
                                    <form class="d-flex justify-content-between mb-2">
                                        <input type="text" class="input-theme-1 form-control fs-14 username-input username-edit-data-1" disabled value="{{ $user->username }}" style="width: 320px;">
                                        <input type="text" class="input-theme-1 form-control fs-14 username-input d-none username-edit-data-2 " placeholder="{{ $user->username }}" style="width: 320px;" required>
                                        <div class="d-flex fs-13">
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
                                <div class="d-flex username-edit-data-1">
                                    <div class="mr-5 fw-bold" style="min-width: 151px;">Password:</div>
                                    <div class="d-flex flex-column">
                                        <div>
                                            <button class="btn form__btn py-2 mb-2" onclick="edit_fields('username')">Change password</button>
                                        </div>
                                        <div class="d-flex flex-column fs-13">
                                            <span class="text-theme-secondary">Password can only be changed if you are using the email/password login flow</span>
                                        </div>
                                    </div>
                                </div>
                                <form class="d-flex flex-column d-none username-edit-data-2">
                                    <div class="d-flex mb-3">
                                        <div class="mr-5 fw-bold" style="min-width: 151px;">Old password:</div>
                                        <div class="d-flex flex-column">
                                            <div>
                                                <input type="text" class="input-theme-1 form-control fs-14 username-input" placeholder="Enter old password" style="width: 320px;" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="mr-5 fw-bold" style="min-width: 151px;">New password:</div>
                                        <div class="d-flex flex-column">
                                            <div class="mb-2">
                                                <input type="text" class="input-theme-1 form-control fs-14 username-input" placeholder="Enter new password" style="width: 320px;" required>
                                            </div>
                                            <div class="fs-12">
                                                <div class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must contain a lowercase letter
                                                </div>
                                                <div class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must contain an uppercase letter
                                                </div>
                                                <div class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must contain a number
                                                </div>
                                                <div class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must be at least 8 characters long
                                                </div>
                                                <div class="validation validation__initial">
                                                    <i class="bi bi-x fs-15"></i>
                                                    Password must not contain leading or trailing spaces
                                                </div>
                                                <!---->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="mr-5 fw-bold" style="min-width: 151px;">Re-enter new password:</div>
                                        <div class="d-flex flex-column">
                                            <div>
                                                <input type="text" class="input-theme-1 form-control fs-14 username-input" placeholder="Re-enter your new password" style="width: 320px;" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="mr-5 fw-bold" style="min-width: 151px;"></div>
                                        <button class="btn form__btn py-2 mb-2 mr-2" type="submit">Change password</button>
                                        <button class="btn btn-dark py-2 mb-2 fs-14" type="button" onclick="cancel_fields('username')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-4">
                        <h4 class="text-theme-primary fw-bold">Profile picture</h4>
                        <div class="d-flex flex-column background-theme-body-1 text-theme-primary border-theme-1 w-100 br-7 mb-3 fs-14">
                            <div class="d-flex align-items-center background-theme-body-1 text-theme-primary w-100 p-4 mb-3">

                                <div class="mr-5 fw-bold" style="min-width: 151px;">
                                    <a href="#" role="button" onclick="document.getElementById('imageInput').click()" 
                                    class="seller-avatar-header mr-2" style="width:100px;height:100px;font-size:32px;">
                                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                                    </a>
                                </div>

                                <form class="d-flex flex-column" enctype="multipart/form-data">
                                    <div>
                                        <!-- Hidden File Input -->
                                        <input type="file" name="image" id="imageInput" accept="image/*" style="display: none;" required>

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
                                @foreach ($email_notifications as $key => $notifications)    
                                    <div class="d-flex flex-row align-items-center email-notification w-100 px-2 px-md-5 mb-4">
                                        <div class="d-flex flex-column email-notification-header">
                                            <span class="fw-bold">{{ $notifications->name }}</span>
                                            <span class="text-theme-secondary">{{ $notifications->description }}</span>
                                        </div>
                                        <div class="d-flex">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" onchange="toggleService(this)"
                                                {{-- {{ optional(auth()->user()->services)->contains($service->id) ? 'checked' : '' }} --}}
                                                class="custom-control-input service-toggle"
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
                        <form class="d-flex flex-column background-theme-body-1 text-theme-primary border-theme-1 w-100 br-7 mb-3 fs-14 p-4">
                            <div class="d-flex flex-column mb-3">
                                <textarea name="" class="textarea input-theme-1 form-control w-100" id="" cols="3" rows="2" placeholder="Type here..."></textarea>
                            </div>
                            <div>
                                <button type="button" class="btn form__btn py-2 mb-2">
                                    Change description
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
    }

    function edit_fields(classData) {
        $(`.${classData}-edit-data-2`).removeClass('d-none');
        $(`.${classData}-edit-data-1`).addClass('d-none');
    }

    function cancel_fields(classData) {
        $(`.${classData}-edit-data-1`).removeClass('d-none');
        $(`.${classData}-edit-data-2`).addClass('d-none');
    }

</script>
@endsection
