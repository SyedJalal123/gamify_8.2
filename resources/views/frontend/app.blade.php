<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bootstrap-reboot.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bootstrap-grid.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/nouislider.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.mCustomScrollbar.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/paymentfont.min.css')}}">
        <link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/main.css')}}">
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/colors.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">

        <!-- Favicons -->
        <link rel="icon" type="image/png" href="https://gogame.volkovdesign.com/icon/favicon-32x32.png')}}" sizes="32x32">
        <link rel="apple-touch-icon" href="https://gogame.volkovdesign.com/icon/favicon-32x32.png')}}">

        <meta name="description" content="Digital marketplace HTML Template by Dmitry Volkov">
        <meta name="keywords" content="">
        <meta name="author" content="Dmitry Volkov">
        <title>{{ config('app.name', 'Gamify') }}</title>


        <link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
        <link type="text/css" rel="stylesheet" id="dark-mode-general-link">
        <style lang="en" type="text/css" id="dark-mode-custom-style"></style>
        <style lang="en" type="text/css" id="dark-mode-native-style"></style>
        <style lang="en" type="text/css" id="dark-mode-native-sheet"></style>

        @yield('css')
        @vite(['resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="dark-theme">
        
        <!-- header -->
        <header class="header">
            <div class="header__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="header__content">
                                <button class="header__menu" type="button">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
        
                                <a href="{{url('/')}}" class="header__logo">
                                    <h2 style="color: white;font-weight: 900;font-family: cursive;">Gamify</h2>
                                </a>
        
                                <ul class="header__nav">
                                    @php $categories = categories(); @endphp
                                    @foreach ($categories as $category)
                                        <li class="header__nav-item">
                                            <a class="header__nav-link" href="#" role="button" id="dropdownMenu0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$category->name}} <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 184l144 144 144-144"></path></svg></a>
            
                                            <ul class="dropdown-menu header__nav-menu" aria-labelledby="dropdownMenu0">
                                                @foreach ($category->categoryGames as $item)
                                                    <li>
                                                        <div class="d-flex">
                                                            <img src="{{asset($item->game->image)}}" alt="" width="28px">
                                                            <a href="{{url('catalog')}}/{{$item->id}}">
                                                                {{$item->game->name}} 
                                                                @if(in_array($item->category_id, [1,3])){{ $item->title }}@endif
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>  
                                    @endforeach
                                    {{-- <li class="header__nav-item">
                                        <a class="header__nav-link" href="https://gogame.volkovdesign.com/#" role="button" id="dropdownMenu0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 184l144 144 144-144"></path></svg></a>
        
                                        <ul class="dropdown-menu header__nav-menu" aria-labelledby="dropdownMenu0">
                                            <li><a href="https://gogame.volkovdesign.com/index.html">Home style 1</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/index2.html">Home style 2</a></li>
                                        </ul>
                                    </li>   
                                    <li class="header__nav-item">
                                        <a class="header__nav-link" href="https://gogame.volkovdesign.com/#" role="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalog <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 184l144 144 144-144"></path></svg></a>
        
                                        <ul class="dropdown-menu header__nav-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="https://gogame.volkovdesign.com/catalog.html">Catalog (sidebar left)</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/catalog2.html">Catalog (sidebar right)</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/category.html">Category page</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/details.html">Details style 1</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/details2.html">Details style 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="header__nav-item">
                                        <a class="header__nav-link" href="https://gogame.volkovdesign.com/#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 184l144 144 144-144"></path></svg></a>
        
                                        <ul class="dropdown-menu header__nav-menu" aria-labelledby="dropdownMenu2">
                                            <li><a href="https://gogame.volkovdesign.com/news.html">News (small grid)</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/news2.html">News (big grid)</a></li>
        
                                            <li class="dropdown-submenu">
                                                <a class="dropdown-item" href="https://gogame.volkovdesign.com/#" role="button" id="dropdownMenuSub" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Single page</a>
        
                                                <ul class="dropdown-menu header__nav-menu" aria-labelledby="dropdownMenuSub">
                                                    <li><a href="https://gogame.volkovdesign.com/article.html">Article</a></li>
                                                    <li><a href="https://gogame.volkovdesign.com/interview.html">Interview</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header__nav-item">
                                        <a class="header__nav-link" href="https://gogame.volkovdesign.com/faq.html">Help Center</a>
                                    </li>
                                    <li class="header__nav-item">
                                        <a class="header__nav-link header__nav-link--more" href="https://gogame.volkovdesign.com/#" role="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><circle cx="256" cy="256" r="32" style="fill:none; stroke-miterlimit:10;stroke-width:32px"></circle><circle cx="416" cy="256" r="32" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></circle><circle cx="96" cy="256" r="32" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></circle></svg>
                                        </a>
        
                                        <ul class="dropdown-menu header__nav-menu header__nav-menu--scroll mCustomScrollbar _mCS_1" aria-labelledby="dropdownMenu3" style="overflow: visible;"><div id="mCSB_1" class="mCustomScrollBox mCS-custom-bar2 mCSB_vertical mCSB_outside" style="max-height: 199px;"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                                            <li><a href="https://gogame.volkovdesign.com/checkout.html">Checkout</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/favorites.html">Favorites</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/about.html">About</a></li>
                                            @if(auth()->user())
                                                <li><a href="{{url('profile')}}">Profile</a></li>
                                                <li>
                                                    <a href="#">
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            @if(auth()->user())
                                                                <a href="route('logout')"
                                                                        onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                                    {{ __('Log Out') }}
                                                                </a>
                                                            @endif
                                                        </form>
                                                    </a>
                                                </li>
                                            @else
                                                <li><a href="{{url('login')}}">Sign in</a></li>
                                                <li><a href="{{url('register')}}">Sign up</a></li>
                                            @endif
                                            <li><a href="https://gogame.volkovdesign.com/forgot.html">Forgot password</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/privacy.html">Privacy policy</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/contacts.html">Contacts</a></li>
                                            <li><a href="https://gogame.volkovdesign.com/404.html">404 Page</a></li>
                                        </div></div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-custom-bar2 mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 115px; max-height: 189px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
                                    </li> --}}
                                </ul>
        
                                <div class="header__actions d-flex right-header justify-content-end">
                                    {{-- Language settings --}}
                                    {{-- <div class="header__lang">
                                        <a class="header__lang-btn" href="https://gogame.volkovdesign.com/#" role="button" id="dropdownMenuLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/uk.svg')}}" alt="">
                                            <span>EN</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M98,190.06,237.78,353.18a24,24,0,0,0,36.44,0L414,190.06c13.34-15.57,2.28-39.62-18.22-39.62H116.18C95.68,150.44,84.62,174.49,98,190.06Z"></path></svg>
                                        </a>
        
                                        <ul class="dropdown-menu header__lang-menu" aria-labelledby="dropdownMenuLang">
                                            <li><a href="https://gogame.volkovdesign.com/#"><img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/spain.svg')}}" alt=""><span>SP</span></a></li>
                                            <li><a href="https://gogame.volkovdesign.com/#"><img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/russia.svg')}}" alt=""><span>RU</span></a></li>
                                            <li><a href="https://gogame.volkovdesign.com/#"><img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/china.svg')}}" alt=""><span>CH</span></a></li>
                                        </ul>
                                    </div> --}}
                                    
        
                                    @if(auth()->user())
                                        {{-- Account Button --}}
                                        {{-- <a href="{{url('profile')}}" class="header__login">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M192,176V136a40,40,0,0,1,40-40H392a40,40,0,0,1,40,40V376a40,40,0,0,1-40,40H240c-22.09,0-48-17.91-48-40V336" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><polyline points="288 336 368 256 288 176" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline><line x1="80" y1="256" x2="352" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                            <span>
                                                account
                                            </span>
                                        </a> --}}
                                        <li class="header__nav-item mr-2 mr-md-3">
                                            <a  href="#" role="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="header__nav-link header__nav-link--more seller-avatar-header mr-2 d-flex align-items-center justify-content-center rounded-circle text-white">
                                                <i class="bi bi-chat-left-text fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="header__nav-item mr-2 mr-md-3">
                                            <a  href="#" role="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="header__nav-link header__nav-link--more seller-avatar-header mr-2 d-flex align-items-center justify-content-center rounded-circle text-white">
                                                <i class="bi bi-bell fs-16"></i>
                                                <span class="top-tag bg-yellow text-black count-notifications">{{count(auth()->user()->unreadnotifications)}}</span>
                                            </a>
                                            <ul class="dropdown-menu notification-dropdown header__nav-menu p-0 mCustomScrollbar _mCS_1" aria-labelledby="dropdownMenu4" style="overflow: visible;">
                                                <li class="p-2" style="border-bottom:1px solid grey;">
                                                    <div class="d-flex align-items-center justify-content-between color-white">
                                                        <div class="d-flex align-items-center">
                                                            <div class="pl-1 d-flex flex-column">
                                                                <span class="fs-14 fw-bold">Notifications</span>
                                                                <div class="d-flex">
                                                                    <div class="signal-ping-wrapper">
                                                                        <span class="signal-ping-dot"></span>
                                                                    </div>
                                                                    <span class="fs-13 text-black-40">Connected</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="text-center p-0"><a href="#" class="pb-2 p-0 justify-content-center">Mark all as read</a></li>
                                                <li class="notification-main-box">
                                                    @foreach (auth()->user()->unreadNotifications->take(6) as $notification)
                                                        <a href="{{$notification->data['link']}}" class="notification-box mb-1">
                                                            <div class="d-flex">
                                                                <img src="{{asset('uploads/games/5.webp')}}" class="mt-1" width="30" height="30" alt="">
                                                                <div class="d-flex flex-column ml-3">
                                                                    <div class="title d-flex flex-row align-items-center">
                                                                        <div class="fs-13">{{$notification->data['title']}}</div>
                                                                        <div class="opacity-50 small ml-3">{{shortTimeAgo($notification->created_at)}}</div>
                                                                    </div>
                                                                    <div class="d-flex flex-column">
                                                                        <div class="opacity-50">{{$notification->data['data1']}}</div>
                                                                        <div>
                                                                            <span class="opacity-50">{{$notification->data['data2']}}</span>
                                                                            {{-- <span class="opacity-50">Price: </span><strong>${{$notification->data['data2']}}</strong> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </li>
                                                <li class="mt-4">
                                                    <a href="#" class="pb-2 p-0 justify-content-center">
                                                        <button class="btn btn-dark fs-14">View all (<span class="count-notifications">{{count(auth()->user()->unreadnotifications)}}</span>)</button>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="header__nav-item">
                                            <a  href="#" role="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="header__nav-link header__nav-link--more seller-avatar-header mr-2 d-flex align-items-center justify-content-center rounded-circle text-white">
                                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                                            </a>
                                            <ul class="dropdown-menu header__nav-menu  mCustomScrollbar _mCS_1" aria-labelledby="dropdownMenu3" style="overflow: visible;min-width: 279px;">
                                                <li style="border-bottom:1px solid grey;">
                                                    <div class="d-flex align-items-center justify-content-between mb-2 color-white">
                                                        <div class="d-flex align-items-center">
                                                            <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                                                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                                                            </div>
                                                            
                                                            <div class="pl-1 d-flex flex-column">
                                                                <span class="fs-14">{{auth()->user()->name}}</span>
                                                                <span class="fs-13">$0.00</span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            @php $seller = get_seller(); @endphp
                                                            <a class="btn__1" @if($seller == null) data-toggle="modal" data-target="#exampleModal" href="#" @else  href="{{url('items/create')}}" @endif>
                                                                <span>Sell</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="sm-arrow"><a href="{{url('profile')}}" class="pb-2 light-border-black">Profile</a></li>
                                                <li class="sm-arrow"><a href="#">Orders</a></li>
                                                <li class="sm-arrow"><a href="#">Offers</a></li>
                                                <li class="sm-arrow"><a href="#" class="pb-2 light-border-black">Boosting</a></li>
                                                <li class="sm-arrow">    
                                                    <a href="#">
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            @if(auth()->user())
                                                                <a href="route('logout')"
                                                                        onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                                    {{ __('Log Out') }}
                                                                </a>
                                                            @endif
                                                        </form>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @else
                                        <a href="{{url('login')}}" class="header__login">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M192,176V136a40,40,0,0,1,40-40H392a40,40,0,0,1,40,40V376a40,40,0,0,1-40,40H240c-22.09,0-48-17.91-48-40V336" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><polyline points="288 336 368 256 288 176" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline><line x1="80" y1="256" x2="352" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                            <span>
                                                Sign in
                                            </span>
                                        </a>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="header__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="header__content">
                                {{-- <form action="https://gogame.volkovdesign.com/#" class="header__form">
                                    <input type="text" class="header__input w-100" placeholder="I&#39;m searching for...">
                                    <select class="header__select">
                                        <option value="0">All Categories</option>
                                        <option value="1">Action</option>
                                        <option value="3">Adventure</option>
                                        <option value="4">Fighting</option>
                                        <option value="5">Flight simulation</option>
                                        <option value="6">Platform</option>
                                        <option value="7">Racing</option>
                                        <option value="8">RPG</option>
                                        <option value="9">Sports</option>
                                        <option value="10">Strategy</option>
                                        <option value="11">Survival horror</option>
                                    </select>
                                    <button class="header__btn" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path><line x1="338.29" y1="338.29" x2="448" y2="448" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></line></svg>
                                    </button>
                                </form> --}}

                                <div class="header_search">
                                    <!-- Overlay -->
                                    <div id="customSearchOverlay" class="custom-search-overlay"></div>
                                
                                    <!-- Input + Dropdown -->
                                    <div class="custom-search-container">
                                        <div class="header__form">
                                            <input type="text" id="customSearchInput" class="header__input w-100" placeholder="Search Gamify">
                                            <button class="header__btn" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 512 512">
                                                    <path d="M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z"
                                                          style="fill:none;stroke:white;stroke-width:32px"/>
                                                    <line x1="338.29" y1="338.29" x2="448" y2="448"
                                                          style="fill:none;stroke:white;stroke-linecap:round;stroke-width:32px"/>
                                                </svg>
                                            </button>
                                        </div>
                                
                                        <!-- Results Dropdown -->
                                        <div id="customSearchDropdown" class="custom-search-dropdown">
                                            <h4>POPULAR CATEGORIES</h4>
                                            {{-- Optionally preload static popular ones here --}}
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="header__actions header__actions--2">
                                    <a href="https://gogame.volkovdesign.com/favorites.html" class="header__link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                                        <span>Favorites</span>
                                    </a>
        
                                    <a href="https://gogame.volkovdesign.com/checkout.html" class="header__link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><circle cx="176" cy="416" r="16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></circle><circle cx="400" cy="416" r="16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></circle><polyline points="48 80 112 80 160 352 416 352" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline><path d="M160,288H409.44a8,8,0,0,0,7.85-6.43l28.8-144a8,8,0,0,0-7.85-9.57H128" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                                        <span>$00.00</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
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
                                    <a href="https://gogame.volkovdesign.com/about.html">About Us</a>
                                    <a href="https://gogame.volkovdesign.com/catalog.html">Catalog</a>
                                    <a href="https://gogame.volkovdesign.com/news.html">News</a>
                                    <a href="https://gogame.volkovdesign.com/faq.html">Help Center</a>
                                    <a href="https://gogame.volkovdesign.com/contacts.html">Contacts</a>
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

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script><script> var publicPath = "{{ asset('/') }}"; </script>
        <script>
            window.Laravel = {
                user: @json(auth()->user())
            };
        </script>

        @livewireScripts

        @yield('js')
        <script src="{{asset('js/custom.js')}}"></script>        

        {{-- Notification Sound --}}
        @auth
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const userId = window.Laravel.user.id; // Pass user ID from Laravel to JS
                let unreadCount = parseInt(document.querySelector('.count-notifications').textContent) || 0;
        
                // Initialize Echo private channel listener for user notifications
                Echo.private(`App.Models.User.${userId}`)
                    .notification((notification) => {  
                        console.log(notification);
                        if(notification.category == 'notification'){
                            // Play sound (handle autoplay restrictions)
                            const audio = new Audio('/sounds/notification.mp3');
                            audio.play().catch(err => console.warn('Audio blocked:', err));
            
                            // Create the notification HTML dynamically
                            const notificationHTML = `
                                <li class="mb-1">
                                    <a href="${notification.link}" class="notification-box">
                                        <div class="d-flex">
                                            <img src="{{asset('uploads/games/5.webp')}}" class="mt-1" width="30" height="30" alt="">
                                            <div class="d-flex flex-column ml-3">
                                                <div class="title d-flex flex-row align-items-center">
                                                    <div class="fs-13">${notification.title}</div>
                                                    <div class="opacity-50 small ml-3">${shortTimeAgo(notification.created_at)}</div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <div class="opacity-50">${notification.data1}</div>
                                                    <div>
                                                        <span class="opacity-50">${notification.data2}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            `;
                            
                            // Insert the new notification at the top of the notification list
                            const notificationMainBox = document.querySelector('.notification-main-box');
                            if (notificationMainBox) {
                                notificationMainBox.insertAdjacentHTML('afterbegin', notificationHTML);
                            }
                            
                            // Increment the unread notification count
                            unreadCount++;
                            const countElements = document.querySelectorAll('.count-notifications');
                            countElements.forEach(countElement => {
                                countElement.textContent = unreadCount; // Update the unread count
                            });
                        }
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