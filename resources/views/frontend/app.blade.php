<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bootstrap-reboot.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bootstrap-grid.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/nouislider.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.mCustomScrollbar.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/paymentfont.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/main.css')}}">
        <link href="{{ asset('css/toastr.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
        
        <!-- Select2 CSS -->
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/colors.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">

        <!-- Favicons -->
        <link rel="icon" type="image/png" href="https://gogame.volkovdesign.com/icon/favicon-32x32.png')}}" sizes="32x32">
        <link rel="apple-touch-icon" href="https://gogame.volkovdesign.com/icon/favicon-32x32.png')}}">

        <meta name="description" content="Gamify best online games buying and selling platform">
        <meta name="keywords" content="">
        <meta name="page-version" content="{{ now()->timestamp }}">
        <title>{{ config('app.name', 'Gamify') }}</title>


        <link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
        <link type="text/css" rel="stylesheet" id="dark-mode-general-link">
        <style lang="en" type="text/css" id="dark-mode-custom-style"></style>
        <style lang="en" type="text/css" id="dark-mode-native-style"></style>
        <style lang="en" type="text/css" id="dark-mode-native-sheet"></style>
        
        <div id="dynamic-css">
            @yield('css')

            @if (Route::currentRouteName() == 'home')
                <style>
                    .section--first {
                        background: url('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bgg.jpg') center top 0px / auto 500px no-repeat;
                        padding-top: 130px;
                    }
                    @media (max-width:1200px) {
                        .section--first {
                            background: url('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2-sm.jpg') center top 53px / auto 500px no-repeat;
                            padding-top: 90px;
                        }
                    }
                </style>
            @elseif(Route::currentRouteName() == 'item.detail' || Route::currentRouteName() == 'profile' || Route::currentRouteName() == 'checkout'|| Route::currentRouteName() == 'order-detail' || Route::currentRouteName() == 'article-collection')
                <style>
                    .section--first {
                        background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2.jpg') center top 0px / auto 500px no-repeat;
                        padding-top: 90px;
                    }
                    @media (max-width:1200px) {
                        .section--first {
                            background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2-sm.jpg') center top 53px / auto 500px no-repeat;
                            padding-top: 60px;
                        }
                    }
                </style>
            @elseif(Str::startsWith(Route::currentRouteName(), 'seller-dashboard.'))
                <style>
                    .section--first {
                        background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2.jpg') center top 0px / auto 500px no-repeat;
                        padding-top: 0px;
                    }
                    @media (max-width:1200px) {
                        .section--first {
                            background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2-sm.jpg') center top 53px / auto 500px no-repeat;
                            padding-top: 70px;
                        }
                    }
                </style>
            @elseif(Route::currentRouteName() == 'boosting-request')
                <style>
                    .section--first {
                        background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2.jpg') center top 0px / auto 500px no-repeat;
                        padding-top: 130px;
                    }
                    @media (max-width:1200px) {
                        .section--first {
                            background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2-sm.jpg') center top 53px / auto 500px no-repeat;
                            padding-top: 90px;
                        }
                    }
                </style>
            
            @elseif(Route::currentRouteName() == 'articles')
                <style>
                    .section--first {
                        padding-top: 0px !important;
                        background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2.jpg') center top 0px / auto 500px no-repeat !important;
                    }
                    @media (max-width:1200px) {
                        .section--first {
                            padding-top: 0px !important;
                            background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2-sm.jpg') center top 0px / auto 500px no-repeat !important;
                        }
                    }
                </style>
            @else
                <style>
                    .section--first {
                        background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2.jpg') center top 0px / auto 500px no-repeat;
                        padding-top: 143px;
                    }
                    @media (max-width:1200px) {
                        .section--first {
                            background: url('/GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2-sm.jpg') center top 53px / auto 500px no-repeat;
                            padding-top: 90px;
                        }
                    }
                </style>
            
            @endif
        </div>
        
        @vite(['resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="dark-theme">
        
        <!-- header -->
        @include('frontend.includes.header')
        <!-- end header -->

        @yield('content')

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer__navs">
                            <div class="footer__nav footer__nav--1">
                                <div class="footer__title"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><polygon points="336 320 32 320 184 48 336 320" style="fill:none;stroke-linejoin:round;stroke-width:32px"></polygon><path d="M265.32,194.51A144,144,0,1,1,192,320" style="fill:none;stroke-linejoin:round;stroke-width:32px"></path></svg> <span>Gamify</span></div>

                                <nav class="footer__list">
                                    <a href="{{ url('article-collections') }}">Help Center</a>
                                    <a href="{{ url('/') }}">Marketplae</a>
                                    <a href="#">Contact us</a>
                                    <a href="#">Bug Bounty</a>
                                    <a href="#">Become a Partner</a>
                                    {{-- <a href="#">Blog</a> --}}
                                </nav>
                            </div>

                            <div class="footer__nav footer__nav--2">
                                <div class="footer__title"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M467.51,248.83c-18.4-83.18-45.69-136.24-89.43-149.17A91.5,91.5,0,0,0,352,96c-26.89,0-48.11,16-96,16s-69.15-16-96-16a99.09,99.09,0,0,0-27.2,3.66C89,112.59,61.94,165.7,43.33,248.83c-19,84.91-15.56,152,21.58,164.88,26,9,49.25-9.61,71.27-37,25-31.2,55.79-40.8,119.82-40.8s93.62,9.6,118.66,40.8c22,27.41,46.11,45.79,71.42,37.16C487.1,399.86,486.52,334.74,467.51,248.83Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path><circle cx="292" cy="224" r="20"></circle><path d="M336,288a20,20,0,1,1,20-19.95A20,20,0,0,1,336,288Z"></path><circle cx="336" cy="180" r="20"></circle><circle cx="380" cy="224" r="20"></circle><line x1="160" y1="176" x2="160" y2="272" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="208" y1="224" x2="112" y2="224" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg> <span>Games</span></div>

                                <nav class="footer__list footer__list--double">
                                    <a href="https://gogame.volkovdesign.com/#">Dota 2</a>
                                    <a href="https://gogame.volkovdesign.com/#">StarCraft 2</a>
                                    <a href="https://gogame.volkovdesign.com/#">CS:GO</a>
                                    <a href="https://gogame.volkovdesign.com/#">League of Legends</a>
                                    <a href="https://gogame.volkovdesign.com/#">Battlegrounds</a>
                                </nav>

                                <nav class="footer__list footer__list--double">
                                    <a href="https://gogame.volkovdesign.com/#">Call of Duty</a>
                                    <a href="https://gogame.volkovdesign.com/#">Hearthstone</a>
                                    <a href="https://gogame.volkovdesign.com/#">Halo</a>
                                    <a href="https://gogame.volkovdesign.com/#">Vainglory</a>
                                    <a href="https://gogame.volkovdesign.com/#">World of Tanks</a>
                                </nav>
                            </div>

                            <div class="footer__nav footer__nav--3">
                                <div class="footer__title"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="176" y1="416" x2="176" y2="480" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><path d="M80,32H272a32,32,0,0,1,32,32V476a4,4,0,0,1-4,4H48a0,0,0,0,1,0,0V64A32,32,0,0,1,80,32Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><path d="M320,192H432a32,32,0,0,1,32,32V480a0,0,0,0,1,0,0H304a0,0,0,0,1,0,0V208A16,16,0,0,1,320,192Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><path d="M98.08,431.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,431.87Z"></path><path d="M98.08,351.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,351.87Z"></path><path d="M98.08,271.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,271.87Z"></path><path d="M98.08,191.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,191.87Z"></path><path d="M98.08,111.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,111.87Z"></path><path d="M178.08,351.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,178.08,351.87Z"></path><path d="M178.08,271.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,178.08,271.87Z"></path><path d="M178.08,191.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,178.08,191.87Z"></path><path d="M178.08,111.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,178.08,111.87Z"></path><path d="M258.08,431.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,258.08,431.87Z"></path><path d="M258.08,351.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,258.08,351.87Z"></path><path d="M258.08,271.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,258.08,271.87Z"></path><ellipse cx="256" cy="176" rx="15.95" ry="16.03" transform="translate(-49.47 232.56) rotate(-45)"></ellipse><path d="M258.08,111.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,258.08,111.87Z"></path><path d="M400,400a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z"></path><path d="M400,320a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z"></path><path d="M400,240a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z"></path><path d="M336,400a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z"></path><path d="M336,320a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z"></path><path d="M336,240a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z"></path></svg> <span>For partners</span></div>

                                <nav class="footer__list">
                                    <a href="https://gogame.volkovdesign.com/#">Affiliate program</a>
                                    <a href="https://gogame.volkovdesign.com/#">Selling on Gamify</a>
                                    <a href="https://gogame.volkovdesign.com/#">Terms and conditions</a>
                                    <a href="https://gogame.volkovdesign.com/#">Privacy policy</a>
                                    <a href="https://gogame.volkovdesign.com/#">Marketing Partnership</a>
                                </nav>

                                <div class="footer__contacts">
                                    <a class="footer__link" href="tel:+18092345678">+1 809 234-56-78</a>
                                    <a class="footer__link" href="mailto:support@gamify">support@gamify</a>

                                    <div class="footer__social">
                                        <a class="fb" href="https://gogame.volkovdesign.com/#"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M455.27,32H56.73A24.74,24.74,0,0,0,32,56.73V455.27A24.74,24.74,0,0,0,56.73,480H256V304H202.45V240H256V189c0-57.86,40.13-89.36,91.82-89.36,24.73,0,51.33,1.86,57.51,2.68v60.43H364.15c-28.12,0-33.48,13.3-33.48,32.9V240h67l-8.75,64H330.67V480h124.6A24.74,24.74,0,0,0,480,455.27V56.73A24.74,24.74,0,0,0,455.27,32Z"></path></svg></a>
                                        <a class="inst" href="https://gogame.volkovdesign.com/#"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.33,69.33a93.62,93.62,0,0,1,93.34,93.34V349.33a93.62,93.62,0,0,1-93.34,93.34H162.67a93.62,93.62,0,0,1-93.34-93.34V162.67a93.62,93.62,0,0,1,93.34-93.34H349.33m0-37.33H162.67C90.8,32,32,90.8,32,162.67V349.33C32,421.2,90.8,480,162.67,480H349.33C421.2,480,480,421.2,480,349.33V162.67C480,90.8,421.2,32,349.33,32Z"></path><path d="M377.33,162.67a28,28,0,1,1,28-28A27.94,27.94,0,0,1,377.33,162.67Z"></path><path d="M256,181.33A74.67,74.67,0,1,1,181.33,256,74.75,74.75,0,0,1,256,181.33M256,144A112,112,0,1,0,368,256,112,112,0,0,0,256,144Z"></path></svg></a>
                                        <a class="tw" href="https://gogame.volkovdesign.com/#"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M496,109.5a201.8,201.8,0,0,1-56.55,15.3,97.51,97.51,0,0,0,43.33-53.6,197.74,197.74,0,0,1-62.56,23.5A99.14,99.14,0,0,0,348.31,64c-54.42,0-98.46,43.4-98.46,96.9a93.21,93.21,0,0,0,2.54,22.1,280.7,280.7,0,0,1-203-101.3A95.69,95.69,0,0,0,36,130.4C36,164,53.53,193.7,80,211.1A97.5,97.5,0,0,1,35.22,199v1.2c0,47,34,86.1,79,95a100.76,100.76,0,0,1-25.94,3.4,94.38,94.38,0,0,1-18.51-1.8c12.51,38.5,48.92,66.5,92.05,67.3A199.59,199.59,0,0,1,39.5,405.6,203,203,0,0,1,16,404.2,278.68,278.68,0,0,0,166.74,448c181.36,0,280.44-147.7,280.44-275.8,0-4.2-.11-8.4-.31-12.5A198.48,198.48,0,0,0,496,109.5Z"></path></svg></a>
                                        <a class="vk" href="https://gogame.volkovdesign.com/#"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M484.7,132c3.56-11.28,0-19.48-15.75-19.48H416.58c-13.21,0-19.31,7.18-22.87,14.86,0,0-26.94,65.6-64.56,108.13-12.2,12.3-17.79,16.4-24.4,16.4-3.56,0-8.14-4.1-8.14-15.37V131.47c0-13.32-4.06-19.47-15.25-19.47H199c-8.14,0-13.22,6.15-13.22,12.3,0,12.81,18.81,15.89,20.84,51.76V254c0,16.91-3,20-9.66,20-17.79,0-61-66.11-86.92-141.44C105,117.64,99.88,112,86.66,112H33.79C18.54,112,16,119.17,16,126.86c0,13.84,17.79,83.53,82.86,175.77,43.21,63,104.72,96.86,160.13,96.86,33.56,0,37.62-7.69,37.62-20.5V331.33c0-15.37,3.05-17.93,13.73-17.93,7.62,0,21.35,4.09,52.36,34.33C398.28,383.6,404.38,400,424.21,400h52.36c15.25,0,22.37-7.69,18.3-22.55-4.57-14.86-21.86-36.38-44.23-62-12.2-14.34-30.5-30.23-36.09-37.92-7.62-10.25-5.59-14.35,0-23.57-.51,0,63.55-91.22,70.15-122" style="fill-rule:evenodd"></path></svg></a>
                                        <a class="tch" href="https://gogame.volkovdesign.com/#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M80 32l-32 80v304h96v64h64l64-64h80l112-112V32zm336 256l-64 64h-96l-64 64v-64h-80V80h304z"></path><path d="M320 143h48v129h-48zM208 143h48v129h-48z"></path></svg></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="footer__wrap">
                            <a class="footer__logo" href="https://gogame.volkovdesign.com/index.html">
                                <h2 style="color: white;font-weight: 900;font-family: cursive;">Gamify</h2>
                                {{-- <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/logo.svg')}}" alt=""> --}}
                            </a>

                            <span class="footer__copyright">© Gamify, 2020—2021 <br> Create by <a href="https://themeforest.net/user/dmitryvolkov/portfolio" target="_blank">Dmitry Volkov</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->
        
        <div id="loadingScreen">
            <div class="loader-circle"></div>
        </div>   

        <!-- JS -->
        {{-- <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery-3.5.1.min.js.download')}}"></script> --}}

        <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bootstrap.bundle.min.js.download')}}"></script>
        <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/owl.carousel.min.js.download')}}"></script>
        <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.magnific-popup.min.js.download')}}"></script>
        <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/wNumb.js.download')}}"></script>
        <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/nouislider.min.js.download')}}"></script>
        <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.mousewheel.min.js.download')}}"></script>
        <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.mCustomScrollbar.min.js.download')}}"></script>
        <script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/main.js.download')}}"></script>   
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset('js/toastr.js')}}"></script>
        <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>

        <!-- Select2 JS -->
        <script src="{{asset('js/select2.min.js')}}"></script>
        
        <script> var publicPath = "{{ asset('/') }}"; </script>
        <script> var homePath = "{{ url('/') }}"; </script>
        <script>
            window.Laravel = {
                user: @json(auth()->user())
            };

            $(document).ready(function() {
                $('.header__nav-link').dropdown();
            });

            @session('success')
                toastr.success('{{ $value }}');
            @endsession

            @session('changed')
                toastr.changed('{{ $value }}');
            @endsession

            @session('info')
                toastr.info('{{ $value }}');
            @endsession

            @session('warning')
                toastr.warning('{{ $value }}');
            @endsession

            @session('error')
                toastr.error('{{ $value }}');
            @endsession

        </script>

        @livewireScripts

        
        <script src="{{asset('js/custom.js')}}"></script>
        
        <div id="dynamic-js">
            @yield('js')
        </div>
        

        <!-- Load BotMan Widget -->
            {{-- <script>
                var botmanWidget = {
                    aboutText: 'Support Bot',
                    introMessage: "", // 🔥 Remove default message
                    placeholderText: "Type a message...",
                    mainColor: "#0d6efd",
                    title: "Support Chat",
                    chatServer: "{{ url('/botman') }}",
                    frameEndpoint: '/botman/chat'
                };
            </script>
            
            <script src="{{ asset('js/widget.js') }}" defer></script>

            <!-- Auto Trigger a Button at Startup -->
            <script>

                function waitForWidget() {
                    if (typeof botmanChatWidget !== 'undefined') {
                        console.log("✅ BotManChatWidget loaded");
                        botmanChatWidget.whisper("/init");
                        botmanChatWidget.close();
                    } else {
                        console.warn("⏳ Waiting for BotManChatWidget...");
                        setTimeout(waitForWidget, 500); // keep trying until it loads
                    }
                }

                window.addEventListener('load', waitForWidget);
            </script> --}}
        <!-- Load BotMan Widget -->

        <!-- Load chatWoot Widget -->
        <script>
            window.chatwootSettings = {
                websiteToken: 'qFvA78pRpa8xx9umw2xYUfhm',
                baseUrl: 'https://app.chatwoot.com'
            };

            window.isChatwootLoaded = window.isChatwootLoaded || false;

            function destroyChatwootIframe() {
                const iframe = document.querySelector('iframe[src*="chatwoot"]');
                const holder = document.querySelector('#cw-bubble-holder');
                if (iframe) iframe.remove();
                if (holder) holder.remove();
                window.chatwootSDK = undefined;
                window.$chatwoot = undefined;
                window.isChatwootLoaded = false;
            }

            function initChatwoot() {
                if (window.isChatwootLoaded) return;

                const script = document.createElement('script');
                script.src = window.chatwootSettings.baseUrl + "/packs/js/sdk.js";
                script.defer = true;
                script.async = true;

                script.onload = function () {
                    window.chatwootSDK.run({
                        websiteToken: window.chatwootSettings.websiteToken,
                        baseUrl: window.chatwootSettings.baseUrl
                    });
                    window.isChatwootLoaded = true;
                };

                document.body.appendChild(script);
            }

            document.addEventListener('DOMContentLoaded', initChatwoot);

            document.addEventListener('livewire:navigated', function () {
                destroyChatwootIframe();
                setTimeout(initChatwoot, 300);
            });
        </script>
        <!-- Load chatWoot Widget -->

        {{-- Notification Sound --}}
        @auth
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const userId = window.Laravel.user.id; // Pass user ID from Laravel to JS
                let unreadCount = parseInt(document.querySelector('.count-notifications').textContent) || 0;

                if (!window.app_models_user) {
                    window.app_models_user = {};
                }

                if (!window.app_models_user[userId]) {
                    const games = @json(\App\Models\Game::all()->keyBy('id'));
                    // Initialize Echo private channel listener for user notifications
                    Echo.private(`App.Models.User.${userId}`)
                        .notification((notification) => {  
                            // console.log(notification);
                            if(notification.category == 'notification'){
                                // Play sound (handle autoplay restrictions)
                                const audio = new Audio('/sounds/notification.mp3');
                                audio.play().catch(err => console.warn('Audio blocked:', err));
                                
                                Livewire.dispatch('notification-received');

                                // const game = games[notification.game_id];

                                // Create the notification HTML dynamically
                                
                                // const notificationHTML = `
                                //     <li class="mb-1">
                                //         <a wire:navigate href="${notification.link}" class="notification-box">
                                //             <div class="d-flex">
                                //                 <img src="{{asset('${game.image}')}}" class="mt-1" width="30" height="30" alt="">
                                //                 <div class="d-flex flex-column ml-3">
                                //                     <div class="title d-flex flex-row align-items-center">
                                //                         <div class="fs-13">${notification.title}</div>
                                //                         <div class="opacity-50 small ml-3">${shortTimeAgo(notification.created_at)}</div>
                                //                     </div>
                                //                     <div class="d-flex flex-column">
                                //                         <div class="opacity-50">${notification.data1}</div>
                                //                         <div>
                                //                             <span class="opacity-50">${notification.data2}</span>
                                //                         </div>
                                //                     </div>
                                //                 </div>
                                //             </div>
                                //         </a>
                                //     </li>
                                // `;
                                
                                // // Insert the new notification at the top of the notification list
                                // const notificationMainBox = document.querySelector('.notification-main-box');
                                // if (notificationMainBox) {
                                //     notificationMainBox.insertAdjacentHTML('afterbegin', notificationHTML);
                                // }

                                
                                // Increment the unread notification count
                                // unreadCount++;
                                // const countElements = document.querySelectorAll('.count-notifications');
                                // countElements.forEach(countElement => {
                                //     countElement.textContent = unreadCount; // Update the unread count
                                // });
                            }
                    });
                    window.app_models_user[userId] = true;
                }
                
                window.addEventListener('popstate', function () {
                    Livewire.navigate(window.location);
                });
            });
            
        </script>
        @endauth
            
            
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seller verification required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container__top d-flex align-items-center flex-column">
                                <img class="app-image" alt="Seller Details review" height="47" width="47" loading="eager" fetchpriority="auto" ng-img="true" src="https://w9g7dlhw3kaank.www.eldorado.gg/WDlx5231QLHO4pNG8aWDLC6fwyjcgZYq1rK6yiNBBlMlTqwI5oZAqBlyRUmA07HH6oAYiZxmF6PrQLDdoG4x7M6i7mNzNoQx80fB84tuP1nmjA0kdWLI5YVxsT5YbpbXPbr" srcset="https://assetsdelivery.eldorado.gg/v7/_assets_/miscellaneous/v6/id-verification.svg?w=47 1x, https://assetsdelivery.eldorado.gg/v7/_assets_/miscellaneous/v6/id-verification.svg?w=94 2x">
                                <strong>Seller Verification</strong>
                                <div role="status" tabindex="0" aria-label="Documents required">
                                    <span class="badge badge-pill badge-danger">Documents required</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{url('seller-verification')}}" class="btn btn-primary">Verify</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Show Live Image Modal -->
        <div class="modal fade" id="liveMediaModal" tabindex="-1" role="dialog" aria-labelledby="liveMediaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="liveMediaModalLabel">Media</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="liveMediaContent">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a id="downloadBtn" href="#" class="btn btn-primary" download target="_blank"><i class="bi-download"></i> Download</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>