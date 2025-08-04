@extends('frontend.app')

@section('css')
    <style>

        /* .d-none {
            display: none !important;
        }

        @media (min-width: 768px) {
            .d-md-flex {
                display: flex !important;
            }

            .d-md-block {
                display: block !important;
            }
        }a
         */
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="position-relative zi-2 mr-auto ml-auto" style="max-width: 933px;">
            <div class="d-flex flex-column mx-2 mx-md-0">
                <div class="d-flex my-3">
                    <a href="{{url('wallet')}}" class="btn btn-dark">Back to wallet</a>
                </div>
                <div class="d-flex flex-column background-theme-body-1 border-theme-1 text-theme-primary px-4 pt-4">
                    <div class="d-flex">
                        <i class="bi bi-wallet fs-25 mr-2"></i>
                        <h2 class="">Withdraw</h2>
                    </div>
                    <div class="pt-4">
                        <div class="fs-14 fw-bold mb-3">Select a withdrawal option</div>
                        <!-- Tab Buttons -->
                        <div class="d-flex flex-wrap pb-4 dividor-border-theme-bottom">
                            <button type="button" class="btn btn-theme-default px-5 py-3 mr-2 mb-2 tab-btn" data-target="#tab-btc">
                                <img src="{{asset('images/logos/bitcoin-logo-dark.webp')}}" alt="">
                            </button>
                            <button type="button" class="btn btn-theme-default px-5 py-3 mr-2 mb-2 tab-btn" data-target="#tab-usdc">
                                <img src="{{asset('images/logos/USDC-logo.webp')}}" alt="">
                            </button>
                            <button type="button" class="btn btn-theme-default px-5 py-3 mr-2 mb-2 tab-btn" onclick="get_exchange();" data-target="#tab-sepa">
                                <img src="{{asset('images/logos/sepa-logo-dark.webp')}}" alt="">
                            </button>
                            <button type="button" class="btn btn-theme-default px-5 py-3 mr-2 mb-2 tab-btn" onclick="get_exchange();" data-target="#tab-skrill">
                                <img src="{{asset('images/logos/skrill-logo-dark.webp')}}" alt="">
                            </button>
                            <button type="button" class="btn btn-theme-default px-5 py-3 mr-0 mb-2 tab-btn" data-target="#tab-payoneer">
                                <img src="{{asset('images/logos/payoneer-logo-dark.webp')}}" alt="">
                            </button>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <form action="{{ url('withdraw') }}" method="POST" class="tab-pane fade py-4" id="tab-btc">
                                @csrf
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex flex-column mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-14">Withdrawal amount</span>
                                                <div class="d-flex align-items-center">
                                                    <input type="number" value="0" name="amount" id="bitcoin_value" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                    <span class="ml-2">USD</span>
                                                </div>
                                            </div>
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="bitcoin_min_withdrawl_error">Minimum withdrawal amount is 10$</p>
                                                <p class="mb-0 d-none" id="bitcoin_less_balance_error">Withdraw amount cannot be greater than main balance</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="bitcoin_fees_show">$20.00</span>
                                                <input type="hidden" value="20" name="fees" id="bitcoin_fees">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="bitcoin_receive_show">$0.00</span>
                                                <input type="hidden" value="0.00" name="received" id="bitcoin_receive">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-column mb-4">
                                            <div class="d-flex flex-column">
                                                <span class="mb-2">Bitcoin wallet address</span>
                                                <input type="text" name="data1" id="bitcoin_data1" class="input-theme-1 py-2 px-2 br-5">
                                            </div>
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="bitcoin_data1_error">Please enter the Bitcoin wallet address.</p>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button type="button" id="bitcoin_submit" class="btn form__btn py-2 px-5 mb-2 fs-14">
                                                Submit
                                                <i class="bi bi-shield-check ml-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6">
                                        <div class="d-flex flex-column background-theme-body-3 h-fit p-3">
                                            <span class="mb-2 fs-13 fw-bold">Minimum withdrawal amount: $100</span>
                                            <p class="fs-11 text-theme-secondary">
                                                - Withdrawal amount in USD will be converted to Bitcoins based on  <a target="_blank" href="https://www.blockchain.com/">www.blockchain.com</a>  exchange rate at the time of transaction.<br><br>

                                                - All Bitcoin withdrawals will incur 6% percentage fee and 20 USD flat fee.<br><br>

                                                - Bitcoin withdrawals are sent through the main Bitcoin blockchain only. No other networks are supported.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ url('withdraw') }}" method="POST" class="tab-pane fade py-4" id="tab-usdc">
                                @csrf
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex flex-column mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-14">Withdrawal amount</span>
                                                <div class="d-flex align-items-center">
                                                    <input type="number" value="0" name="amount" id="usdc_value" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                    <span class="ml-2">USD</span>
                                                </div>
                                            </div>
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="usdc_min_withdrawl_error">Minimum withdrawal amount is 200$</p>
                                                <p class="mb-0 d-none" id="usdc_less_balance_error">Withdraw amount cannot be greater than main balance</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="usdc_fees_show">$20.00</span>
                                                <input type="hidden" value="20" name="fees" id="usdc_fees">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="usdc_receive_show">$0.00</span>
                                                <input type="hidden" value="0.00" name="receive" id="usdc_receive">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-4">
                                            <div class="d-flex flex-column">
                                                <span class="mb-2">USDC wallet address</span>
                                                <input type="text" name="data1" id="usdc_data1" class="input-theme-1 py-2 px-2 br-5">
                                            </div>
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="usdc_data1_error">Please enter the USDC wallet address.</p>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button type="button" id="usdc_submit" class="btn form__btn py-2 px-5 mb-2 fs-14">
                                                Submit
                                                <i class="bi bi-shield-check ml-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6">
                                        <div class="d-flex flex-column background-theme-body-3 h-fit p-3">
                                            <span class="mb-2 fs-13 fw-bold">Minimum withdrawal amount: $200</span>
                                            <p class="fs-11 text-theme-secondary">
                                                - Withdrawal amount in USD will be converted to USDC based on  <a target="_blank" href="https://www.blockchain.com/">www.blockchain.com</a>  exchange rate at the time of transaction.<br><br>

                                                - All USDC withdrawals will incur 6% percentage fee and 20 USD flat fee.<br><br>

                                                - USDC withdrawals can only be sent to ERC-20 wallets. OMNI and TRC-20 wallets are NOT supported.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ url('withdraw') }}" method="POST" class="tab-pane fade py-4" id="tab-sepa">
                                @csrf
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex flex-column mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-14">Withdrawal amount</span>
                                                <div class="d-flex align-items-center">
                                                    <input type="number" value="0" name="amount" id="sepa_value" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                    <span class="ml-2">USD</span>
                                                </div>
                                            </div>
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="sepa_min_withdrawl_error">Minimum withdrawal amount is 10$</p>
                                                <p class="mb-0 d-none" id="sepa_less_balance_error">Withdraw amount cannot be greater than main balance</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="sepa_fees_show">$5.00</span>
                                                <input type="hidden" value="5" name="fees" id="sepa_fees">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">Conversion rate (USD/EUR)</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="sepa_conversation_rate_show">0.00</span>
                                                <input type="hidden" value="0" name="conversation_rate" id="sepa_conversation_rate">                                                
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="sepa_receive_show">€0.00</span>
                                                <input type="hidden" value="0.00" name="receive" id="sepa_receive">                                                
                                                <span class="ml-2">EUR</span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-2">
                                            <div class="d-flex flex-column">
                                                <span class="mb-2">Recipient name</span>
                                                <input type="text" name="data1" id="sepa_data1" class="input-theme-1 py-2 px-2 br-5">
                                            </div>
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="sepa_data1_error">Please enter the Recipient name.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-4">
                                            <div class="d-flex flex-column">
                                                <span class="mb-2">IBAN</span>
                                                <input type="text" name="data2" id="sepa_data2" class="input-theme-1 py-2 px-2 br-5">
                                            </div>
                                            
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="sepa_data2_error">Please enter the IBAN.</p>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button type="button" id="sepa_submit" class="btn form__btn py-2 px-5 mb-2 fs-14">
                                                Submit
                                                <i class="bi bi-shield-check ml-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6">
                                        <div class="d-flex flex-column background-theme-body-3 h-fit p-3">
                                            <span class="mb-2 fs-13 fw-bold">Minimum withdrawal amount: $10</span>
                                            <p class="fs-11 text-theme-secondary">
                                                - Withdrawals can only be sent to European (SEPA) bank accounts in Euros.<br><br>

                                                - All Sepa withdrawals will incur 4% percentage fee and 5 USD flat fee.<br><br>

                                                - You must be the recipient of the funds, with the withdrawal address registered to you.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ url('withdraw') }}" method="POST" class="tab-pane fade py-4" id="tab-skrill">
                                @csrf
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex flex-column mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-14">Withdrawal amount</span>
                                                <div class="d-flex align-items-center">
                                                    <input type="number" value="0" name="amount" id="skrill_value" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                    <span class="ml-2">USD</span>
                                                </div>
                                            </div>
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="skrill_min_withdrawl_error">Minimum withdrawal amount is 10$</p>
                                                <p class="mb-0 d-none" id="skrill_less_balance_error">Withdraw amount cannot be greater than main balance</p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="skrill_fees_show">$1.00</span>
                                                <input type="hidden" value="1" name="fees" id="skrill_fees">      
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">Conversion rate (USD/EUR)</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="skrill_conversation_rate_show">0.00</span>
                                                <input type="hidden" value="0" name="conversation_rate" id="skrill_conversation_rate">                                                
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="skrill_receive_show">€0.00</span>
                                                <input type="hidden" value="0.00" name="receive" id="skrill_receive">    
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column mb-4">
                                            <div class="d-flex flex-column">
                                                <span class="mb-2">Skrill email</span>
                                                <input type="text" name="data1" id="skrill_data1" class="input-theme-1 py-2 px-2 br-5">
                                            </div>

                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="skrill_data1_error">Please enter the Skrill email.</p>
                                            </div>
                                        </div>


                                        <div class="d-flex">
                                            <button type="button" id="skrill_submit" class="btn form__btn py-2 px-5 mb-2 fs-14">
                                                Submit
                                                <i class="bi bi-shield-check ml-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6">
                                        <div class="d-flex flex-column background-theme-body-3 h-fit p-3">
                                            <span class="mb-2 fs-13 fw-bold">Minimum withdrawal amount: $10</span>
                                            <p class="fs-11 text-theme-secondary">
                                                - Withdrawals can only be sent to Skrill accounts in Euros.<br><br>

                                                - All Skrill withdrawals will incur 5% percentage fee and 1 USD flat fee.<br><br>

                                                - You must be the recipient of the funds, with the withdrawal address registered to you.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ url('withdraw') }}" method="POST" class="tab-pane fade py-4" id="tab-payoneer">
                                @csrf
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex flex-column mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-14">Withdrawal amount</span>
                                                <div class="d-flex align-items-center">
                                                    <input type="number" value="0" id="payoneer_value" name="amount" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                    <span class="ml-2">USD</span>
                                                </div>
                                            </div>
                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="payoneer_min_withdrawl_error">Minimum withdrawal amount is 50$</p>
                                                <p class="mb-0 d-none" id="payoneer_less_balance_error">Withdraw amount cannot be greater than main balance</p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="payoneer_fees_show">$20.00</span>
                                                <input type="hidden" value="20" name="fees" id="payoneer_fees">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold" id="payoneer_receive_show">$0.00</span>
                                                <input type="hidden" value="0.00" name="receive" id="payoneer_receive">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column mb-4">
                                            <div class="d-flex flex-column">
                                                <span class="mb-2">Payoneer email</span>
                                                <input type="text" name="data1" id="payoneer_data1" class="input-theme-1 py-2 px-2 br-5">
                                            </div>

                                            <div class="errors fs-13 text-theme-cherry">
                                                <p class="mb-0 d-none" id="payoneer_data1_error">Please enter the Payoneer email.</p>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button type="button" id="payoneer_submit" class="btn form__btn py-2 px-5 mb-2 fs-14">
                                                Submit
                                                <i class="bi bi-shield-check ml-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6">
                                        <div class="d-flex flex-column background-theme-body-3 h-fit p-3">
                                            <span class="mb-2 fs-13 fw-bold">Minimum withdrawal amount: $10</span>
                                            <p class="fs-11 text-theme-secondary">
                                                - You must be the owner of the Payoneer account receiving the funds.<br><br>

                                                - A 4% percentage fee and a $2 USD flat fee apply to each withdrawal.<br><br>

                                                - Withdrawals are typically processed instantly, but may take up to 2 hours.<br><br>

                                                - Withdrawals are final and cannot be reversed. Make sure the email address you provide is correct.<br><br>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            if(!$('.select2').hasClass('select2-container--default')){
                initPage();
            }
        });

        function initPage() {
            var userBalance = "{{auth()->user()->balance}}";
            // Apply Select2 to all select elements
            $('.select2').select2({
                dropdownPosition: 'below',
            });

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);

            
            $('.tab-btn').on('click', function () {
                var target = $(this).data('target');

                // Remove active class from all buttons and tab panes
                $('.tab-btn').removeClass('active');
                $('.tab-pane').removeClass('show active');

                // Activate clicked button and associated tab pane
                $(this).addClass('active');
                $(target).addClass('show active');
            });
            
            $('#bitcoin_value').on('keyup', function() {
                var fee = 20;
                var tax_per = 6;
                var val = $('#bitcoin_value').val();

                var tax = (tax_per / 100) * val;
                var tax = (tax + fee).toFixed(2);
                var receive = (val - tax).toFixed(2);

                if(receive < 0) {
                    receive = (0).toFixed(2);
                }

                $('#bitcoin_fees_show').text('$'+tax);
                $('#bitcoin_fees').val(tax);

                $('#bitcoin_receive').val(receive);
                $('#bitcoin_receive_show').text('$'+receive);
                
            });

            $('#usdc_value').on('keyup', function() {
                var fee = 20;
                var tax_per = 6;
                var val = $('#usdc_value').val();

                var tax = (tax_per / 100) * val;
                var tax = (tax + fee).toFixed(2);
                var receive = (val - tax).toFixed(2);

                if(receive < 0) {
                    receive = (0).toFixed(2);
                }

                $('#usdc_fees_show').text('$'+tax);
                $('#usdc_fees').val(tax);

                $('#usdc_receive').val(receive);
                $('#usdc_receive_show').text('$'+receive);
                
            });

            $('#sepa_value').on('keyup', function() {
                var fee = 5;
                var tax_per = 4;
                var conv_rate = $('#sepa_conversation_rate').val();
                var val = $('#sepa_value').val();

                var tax = (tax_per / 100) * val;
                var tax = (tax + fee).toFixed(2);
                var receive = ((val - tax) * conv_rate).toFixed(2);

                if(receive < 0) {
                    receive = 0;
                }

                $('#sepa_fees_show').text('$'+tax);
                $('#sepa_fees').val(tax);

                
                        
                $('#sepa_receive').val(receive);
                $('#sepa_receive_show').text('€'+receive);

            });

            $('#skrill_value').on('keyup', function() {
                var fee = 1;
                var tax_per = 5;
                var conv_rate = $('#skrill_conversation_rate').val();
                var val = $('#skrill_value').val();

                var tax = (tax_per / 100) * val;
                var tax = (tax + fee).toFixed(2);
                var receive = ((val - tax) * conv_rate).toFixed(2);

                if(receive < 0) {
                    receive = (0).toFixed(2);
                }

                $('#skrill_fees_show').text('$'+tax);
                $('#skrill_fees').val(tax);

                $('#skrill_receive').val(receive);
                $('#skrill_receive_show').text('€'+receive);
                
            });

            $('#payoneer_value').on('keyup', function() {
                var fee = 2;
                var tax_per = 4;
                var val = $('#payoneer_value').val();

                var tax = (tax_per / 100) * val;
                var tax = (tax + fee).toFixed(2);
                var receive = (val - tax).toFixed(2);

                if(receive < 0) {
                    receive = (0).toFixed(2);
                }

                $('#payoneer_fees_show').text('$'+tax);
                $('#payoneer_fees').val(tax);

                $('#payoneer_receive').val(receive);
                $('#payoneer_receive_show').text('$'+receive);
                
            });

            // Submit
            $('#bitcoin_submit').on('click', function() {
                var amount = $('#bitcoin_value').val();
                var data1 = $('#bitcoin_data1').val();
                var valid = true;

                if(amount == '' || amount < 10) {
                    valid = false;
                    $('#bitcoin_min_withdrawl_error').removeClass('d-none');
                }else {
                    $('#bitcoin_min_withdrawl_error').addClass('d-none');
                }

                if(amount > parseFloat(userBalance)) {
                    valid = false;
                    $('#bitcoin_less_balance_error').removeClass('d-none');
                }else {
                    $('#bitcoin_less_balance_error').addClass('d-none');
                }

                if(data1 == '') {
                    valid = false;
                    $('#bitcoin_data1_error').removeClass('d-none');
                }else {
                    $('#bitcoin_data1_error').addClass('d-none');
                }

                if(valid == true) {
                    $('#tab-btc').submit();
                }

            });

            $('#usdc_submit').on('click', function() {
                var amount = $('#usdc_value').val();
                var data1 = $('#usdc_data1').val();
                var valid = true;

                if(amount == '' || amount < 200) {
                    valid = false;
                    $('#usdc_min_withdrawl_error').removeClass('d-none');
                }else {
                    $('#usdc_min_withdrawl_error').addClass('d-none');
                }

                if(amount > parseFloat(userBalance)) {
                    valid = false;
                    $('#usdc_less_balance_error').removeClass('d-none');
                }else {
                    $('#usdc_less_balance_error').addClass('d-none');
                }

                if(data1 == '') {
                    valid = false;
                    $('#usdc_data1_error').removeClass('d-none');
                }else {
                    $('#usdc_data1_error').addClass('d-none');
                }

                if(valid == true) {
                    $('#tab-usdc').submit();
                }

            });

            $('#sepa_submit').on('click', function() {
                var amount = $('#sepa_value').val();
                var data1 = $('#sepa_data1').val();
                var data2 = $('#sepa_data2').val();
                var valid = true;

                if(amount == '' || amount < 10) {
                    valid = false;
                    $('#sepa_min_withdrawl_error').removeClass('d-none');
                }else {
                    $('#sepa_min_withdrawl_error').addClass('d-none');
                }

                if(amount > parseFloat(userBalance)) {
                    valid = false;
                    $('#sepa_less_balance_error').removeClass('d-none');
                }else {
                    $('#sepa_less_balance_error').addClass('d-none');
                }

                if(data1 == '') {
                    valid = false;
                    $('#sepa_data1_error').removeClass('d-none');
                }else {
                    $('#sepa_data1_error').addClass('d-none');
                }

                if(data2 == '') {
                    valid = false;
                    $('#sepa_data2_error').removeClass('d-none');
                }else {
                    $('#sepa_data2_error').addClass('d-none');
                }

                if(valid == true) {
                    $('#tab-sepa').submit();
                }

            });

            $('#skrill_submit').on('click', function() {
                var amount = $('#skrill_value').val();
                var data1 = $('#skrill_data1').val();
                var valid = true;

                if(amount == '' || amount < 10) {
                    valid = false;
                    $('#skrill_min_withdrawl_error').removeClass('d-none');
                }else {
                    $('#skrill_min_withdrawl_error').addClass('d-none');
                }

                if(amount > parseFloat(userBalance)) {
                    valid = false;
                    $('#skrill_less_balance_error').removeClass('d-none');
                }else {
                    $('#skrill_less_balance_error').addClass('d-none');
                }

                if(data1 == '') {
                    valid = false;
                    $('#skrill_data1_error').removeClass('d-none');
                }else {
                    $('#skrill_data1_error').addClass('d-none');
                }

                if(valid == true) {
                    $('#tab-skrill').submit();
                }

            });

            $('#payoneer_submit').on('click', function() {
                var amount = $('#payoneer_value').val();
                var data1 = $('#payoneer_data1').val();
                var valid = true;

                if(amount == '' || amount < 50) {
                    valid = false;
                    $('#payoneer_min_withdrawl_error').removeClass('d-none');
                }else {
                    $('#payoneer_min_withdrawl_error').addClass('d-none');
                }

                if(amount > parseFloat(userBalance)) {
                    valid = false;
                    $('#payoneer_less_balance_error').removeClass('d-none');
                }else {
                    $('#payoneer_less_balance_error').addClass('d-none');
                }

                if(data1 == '') {
                    valid = false;
                    $('#payoneer_data1_error').removeClass('d-none');
                }else {
                    $('#payoneer_data1_error').addClass('d-none');
                }

                if(valid == true) {
                    $('#tab-payoneer').submit();
                }

            });
        }

        function get_exchange() {
            if($('#sepa_conversation_rate').val() == '' || $('#sepa_conversation_rate').val() == 0) {
                $.ajax({
                    url: '/get_exchange', 
                    type: 'GET',             
                    data: {},
                    success: function(response) {
                        $('#sepa_conversation_rate_show').text(parseFloat(response).toFixed(2));
                        $('#sepa_conversation_rate').val(response);
                        $('#skrill_conversation_rate_show').text(parseFloat(response).toFixed(2));
                        $('#skrill_conversation_rate').val(response);
                    }
                });
            }
        }
    </script>
@endsection