@extends('frontend.app')

@section('css')
    <style>
        
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container d-flex flex-column px-3" style="max-width: 1000px;"> 
            <h3 class="fw-bold text-theme-primary mb-3">Create Ticket</h3>

            <div class="d-flex w-100 mt-3">
                <form @if($tag == 'Feedback') action="{{url('save-suggestion')}}" @else action="{{url('save-ticket')}}" @endif method="POST" class="w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tag" value="{{ $tag }}">
                    @if($tag == 'SellerRequest')
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Enter your issue <span class="text-theme-cherry">*</span></label>
                            <input type="text" name="issue" class="form-control input-theme-1" placeholder="Enter text here...">
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Enter order ID(s) <span class="text-theme-cherry">*</span></label>
                            <textarea name="order_ids" class="form-control input-theme-1" placeholder="Enter text here..." cols="30" rows="5"></textarea>
                        </div>
                    @elseif($tag == 'CryptoRefund')
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Your Gamify username or email <span class="text-theme-cherry">*</span></label>
                            <input type="text" name="email_username" class="form-control input-theme-1" placeholder="Enter text here...">
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">BTC wallet address <span class="text-theme-cherry">*</span></label>
                            <textarea name="wallet_address" class="form-control input-theme-1" placeholder="Enter text here..." cols="30" rows="5"></textarea>
                        </div>
                    @elseif($tag == 'DisputeClaim')
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Order ID <span class="text-theme-cherry">*</span></label>
                            <input type="text" name="order_id" class="form-control input-theme-1" placeholder="Enter text here...">
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Briefly describe the issue you are having <span class="text-theme-cherry">*</span></label>
                            <textarea name="issue" class="form-control input-theme-1" placeholder="Enter text here..." cols="30" rows="5"></textarea>
                        </div>
                        <div class="d-flex flex-column mb-5">
                            <label class="required fw-bold text-theme-primary mb-1">Evidence of your claim (optional)</label>
                            <input type="file" name="evidence" class="form-control input-theme-1" style="padding-bottom: 37px !important;">
                        </div>
                        <div class="d-flex flex-column mb-5 select-2-theme">
                            <label class="required fw-bold text-theme-primary mb-1">How long ago did you raise your dispute? <span class="text-theme-cherry">*</span></label>
                            <select name="dispute_duration">
                                <option value="Less than 24 hours ago">Less than 24 hours ago</option>
                                <option value="More than 24 hours ago">More than 24 hours ago</option>
                                <option value="More than 3 days ago">More than 3 days ago</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-4 select-2-theme">
                            <label class="required fw-bold text-theme-primary mb-1">Should the order funds be refunded to your original payment method? <span class="text-theme-cherry">*</span></label>
                            <div class="text-theme-primary">
                                <input type="radio" name="dispute_refund_orignal_account" value="yes" class="w-auto" checked="" id="radio_yes">
                                <label for="radio_yes">Yes</label>
                            </div>
                            <div class="text-theme-primary">
                                <input type="radio" name="dispute_refund_orignal_account" value="no" class="w-auto" id="radio_no">
                                <label for="radio_no">No</label>
                            </div>
                        </div>
                        
                    @elseif($tag == 'UserReports')
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Who are you reporting? <span class="text-theme-cherry">*</span></label>
                            <input type="text" name="reported_person" class="form-control input-theme-1" placeholder="Enter text here...">
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">What is the reason of report? <span class="text-theme-cherry">*</span></label>
                            <textarea name="issue" class="form-control input-theme-1" placeholder="Enter text here..." cols="30" rows="5"></textarea>
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Order ID or reference URL <span class="text-theme-cherry">*</span></label>
                            <input type="text" name="order_id" class="form-control input-theme-1" placeholder="Enter text here...">
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">File upload (optional)</label>
                            <input type="file" name="evidence" class="form-control input-theme-1" style="padding-bottom: 37px !important;">
                        </div>
                    @elseif($tag == 'OrderIssues')
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Order ID <span class="text-theme-cherry">*</span></label>
                            <input type="text" name="order_id" class="form-control input-theme-1" placeholder="Enter text here...">
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Please describe your issue <span class="text-theme-cherry">*</span></label>
                            <textarea name="issue" class="form-control input-theme-1" placeholder="Enter text here..." cols="30" rows="5"></textarea>
                        </div>
                        <div class="d-flex flex-column mb-4 select-2-theme">
                            <label class="required fw-bold text-theme-primary mb-1">Should the order funds be refunded to your original payment method? <span class="text-theme-cherry">*</span></label>
                            <div class="text-theme-primary">
                                <input type="radio" name="dispute_refund_orignal_account" value="yes" class="w-auto" checked="" id="radio_yes">
                                <label for="radio_yes">Yes</label>
                            </div>
                            <div class="text-theme-primary">
                                <input type="radio" name="dispute_refund_orignal_account" value="no" class="w-auto" id="radio_no">
                                <label for="radio_no">No</label>
                            </div>
                        </div>
                    @elseif($tag == 'WarrantyClaim')
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Order ID <span class="text-theme-cherry">*</span></label>
                            <input type="text" name="order_id" class="form-control input-theme-1" placeholder="Enter text here...">
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">upload files (optional)</label>
                            <input type="file" name="evidence" class="form-control input-theme-1" style="padding-bottom: 37px !important;">
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">Describe your issue <span class="text-theme-cherry">*</span></label>
                            <textarea name="issue" class="form-control input-theme-1" placeholder="Enter text here..." cols="30" rows="5"></textarea>
                        </div>
                        <div class="d-flex flex-column mb-4 select-2-theme">
                            <label class="required fw-bold text-theme-primary mb-1">Should the order funds be refunded to your original payment method? <span class="text-theme-cherry">*</span></label>
                            <div class="text-theme-primary">
                                <input type="radio" name="dispute_refund_orignal_account" value="yes" class="w-auto" checked="" id="radio_yes">
                                <label for="radio_yes">Yes</label>
                            </div>
                            <div class="text-theme-primary">
                                <input type="radio" name="dispute_refund_orignal_account" value="no" class="w-auto" id="radio_no">
                                <label for="radio_no">No</label>
                            </div>
                        </div>
                    @elseif($tag == 'Feedback')
                        <div class="d-flex flex-column mb-4">
                            <label class="required fw-bold text-theme-primary mb-1">What game would you like to see on Gamify? <span class="text-theme-cherry">*</span></label>
                             <textarea name="suggestion" class="form-control input-theme-1" placeholder="Enter text here..." cols="30" rows="5"></textarea>
                        </div>
                    @endif
                    <button class="btn form__btn py-2 mb-2">
                        <span class="mr-2">Create ticket</span>
                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 3.5C1.67157 3.5 1 4.17157 1 5V5.5V6.25C1 6.52614 1.22842 6.7428 1.4934 6.82052C2.21966 7.03354 2.75 7.70484 2.75 8.5C2.75 9.29516 2.21966 9.96646 1.4934 10.1795C1.22842 10.2572 1 10.4739 1 10.75V11.5V12C1 12.8284 1.67157 13.5 2.5 13.5H13.5C14.3284 13.5 15 12.8284 15 12V11.5V10.75C15 10.4739 14.7716 10.2572 14.5066 10.1795C13.7803 9.96646 13.25 9.29516 13.25 8.5C13.25 7.70484 13.7803 7.03354 14.5066 6.82052C14.7716 6.7428 15 6.52614 15 6.25V5.5V5C15 4.17157 14.3284 3.5 13.5 3.5H2.5ZM11 7L5 7C4.58579 7 4.25 6.66421 4.25 6.25C4.25 5.83579 4.58579 5.5 5 5.5H11C11.4142 5.5 11.75 5.83579 11.75 6.25C11.75 6.66421 11.4142 7 11 7Z" fill="currentColor"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('select').select2({
                dropdownPosition: 'below',
            });
        });
    </script>
@endsection