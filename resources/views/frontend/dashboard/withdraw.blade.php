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
                            <button type="button" class="btn btn-theme-default px-5 py-3 mr-2 mb-2 tab-btn" data-target="#tab-sepa">
                                <img src="{{asset('images/logos/sepa-logo-dark.webp')}}" alt="">
                            </button>
                            <button type="button" class="btn btn-theme-default px-5 py-3 mr-2 mb-2 tab-btn" data-target="#tab-skrill">
                                <img src="{{asset('images/logos/skrill-logo-dark.webp')}}" alt="">
                            </button>
                            <button type="button" class="btn btn-theme-default px-5 py-3 mr-0 mb-2 tab-btn" data-target="#tab-payoneer">
                                <img src="{{asset('images/logos/payoneer-logo-dark.webp')}}" alt="">
                            </button>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div class="tab-pane fade py-4" id="tab-btc">
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fs-14">Withdrawal amount</span>
                                            <div class="d-flex align-items-center">
                                                <input type="text" value="0" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$20.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$0.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-column mb-4">
                                            <span class="mb-2">Bitcoin wallet address</span>
                                            <input type="text" class="input-theme-1 py-2 px-2 br-5">
                                        </div>

                                        <div class="d-flex">
                                            <button class="btn form__btn py-2 px-5 mb-2 fs-14">
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
                            </div>
                            <div class="tab-pane fade" id="tab-usdc">
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fs-14">Withdrawal amount</span>
                                            <div class="d-flex align-items-center">
                                                <input type="text" value="0" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$20.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$0.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-column mb-4">
                                            <span class="mb-2">Bitcoin wallet address</span>
                                            <input type="text" class="input-theme-1 py-2 px-2 br-5">
                                        </div>

                                        <div class="d-flex">
                                            <button class="btn form__btn py-2 px-5 mb-2 fs-14">
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
                            </div>
                            <div class="tab-pane fade" id="tab-sepa">
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fs-14">Withdrawal amount</span>
                                            <div class="d-flex align-items-center">
                                                <input type="text" value="0" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$20.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$0.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-column mb-4">
                                            <span class="mb-2">Bitcoin wallet address</span>
                                            <input type="text" class="input-theme-1 py-2 px-2 br-5">
                                        </div>

                                        <div class="d-flex">
                                            <button class="btn form__btn py-2 px-5 mb-2 fs-14">
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
                            </div>
                            <div class="tab-pane fade" id="tab-skrill">
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fs-14">Withdrawal amount</span>
                                            <div class="d-flex align-items-center">
                                                <input type="text" value="0" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$20.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$0.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-column mb-4">
                                            <span class="mb-2">Bitcoin wallet address</span>
                                            <input type="text" class="input-theme-1 py-2 px-2 br-5">
                                        </div>

                                        <div class="d-flex">
                                            <button class="btn form__btn py-2 px-5 mb-2 fs-14">
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
                            </div>
                            <div class="tab-pane fade" id="tab-payoneer">
                                <div class="d-flex row">
                                    <div class="d-flex flex-column col-md-6">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fs-14">Withdrawal amount</span>
                                            <div class="d-flex align-items-center">
                                                <input type="text" value="0" class="input-theme-1 py-2 px-2 text-right br-5" style="width:110px;">
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14">Payment fees</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$20.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 dividor-border-theme-bottom">
                                            <span class="fs-14 fw-bold">You receive</span>
                                            <div class="d-flex align-items-center">
                                                <span class="ml-2 fw-bold">$0.00</span>
                                                <span class="ml-2">USD</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-column mb-4">
                                            <span class="mb-2">Bitcoin wallet address</span>
                                            <input type="text" class="input-theme-1 py-2 px-2 br-5">
                                        </div>

                                        <div class="d-flex">
                                            <button class="btn form__btn py-2 px-5 mb-2 fs-14">
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
                            </div>
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
            if(!$('.select2').hasClass('select2-container--default')){
                initPage();
            }
        });

        function initPage() {
            // Apply Select2 to all select elements
            $('.select2').select2({
                dropdownPosition: 'below',
            });

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);

            
            $(document).ready(function () {
                $('.tab-btn').on('click', function () {
                    var target = $(this).data('target');

                    // Remove active class from all buttons and tab panes
                    $('.tab-btn').removeClass('active');
                    $('.tab-pane').removeClass('show active');

                    // Activate clicked button and associated tab pane
                    $(this).addClass('active');
                    $(target).addClass('show active');
                });
            });
        }
    </script>
@endsection