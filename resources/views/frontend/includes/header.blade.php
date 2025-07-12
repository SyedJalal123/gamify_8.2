<header class="header" style="position: relative;">
    <div class="header__wrap" 
        style="padding: 0px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <button class="header__menu" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <a wire:navigate href="{{url('/')}}" class="header__logo">
                            <h2 style="color: white;font-weight: 900;font-family: cursive;">Gamify</h2>
                        </a>

                        <div class="header_search justify-content-center header_search_pc">
                            <!-- Overlay -->
                            <div id="customSearchOverlay" class="custom-search-overlay"></div>
                        
                            <!-- Input + Dropdown -->
                            <div class="custom-search-container">
                                <div class="header__form">
                                    <input type="text" id="customSearchInput" class="header__input w-100" autocomplete="off" placeholder="Search Gamify">
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
                                    <a wire:navigate href="{{url('messages')}}?messageType=All" role="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="header__nav-link header__nav-link--more seller-avatar-header mr-2 d-flex align-items-center justify-content-center rounded-circle text-white">
                                        <i class="bi bi-chat-left-text fs-16"></i>
                                    </a>
                                </li>
                                <li class="header__nav-item mr-3 mr-md-3">
                                    <a  href="#" role="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="header__nav-link header__nav-link--more seller-avatar-header mr-2 d-flex align-items-center justify-content-center rounded-circle text-white">
                                        <i class="bi bi-bell fs-16"></i>
                                        <span class="top-tag bg-yellow text-black count-notifications">{{ count_user_unread_noti() }}</span>
                                    </a>
                                    <ul class="dropdown-menu notification-dropdown header__nav-menu p-0 mCustomScrollbar _mCS_1" aria-labelledby="dropdownMenu4" style="overflow: visible;">
                                        <li class="p-2" style="border-bottom:1px solid grey;">
                                            <div class="d-flex align-items-center justify-content-between color-white">
                                                <div class="d-flex align-items-center">
                                                    <div class="pl-1 d-flex flex-column">
                                                        <span class="fs-14 fw-bold">Notifications</span>
                                                    </div>
                                                <div>
                                                    
                                                </div>
                                            </div>
                                        </li>
                                        <li class="notification-main-box">
                                            <ul>
                                                @livewire('NotificationComponent', ['type' => 'header'])
                                            </ul>
                                        </li>
                                        <li class="mt-4">
                                            <a wire:navigate href="{{url('notifications')}}" class="pb-2 p-0 justify-content-center">
                                                <button class="btn btn-dark fs-14">View all 
                                                    <span id="count-header-button" class="@if(count_user_unread_noti() == 0) d-none @endif">(<span class="count-notifications">{{ count_user_unread_noti() }}</span>)</span>
                                                </button>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="header__nav-item">
                                    <a  href="#" role="button" id="dropdownMenu3" data-toggle="dropdown" data-bs-auto-close="false" aria-haspopup="true" aria-expanded="false" class="header__nav-link header__nav-link--more seller-avatar-header mr-2 d-flex align-items-center justify-content-center rounded-circle text-white">
                                        @if(auth()->user()->profile !== null)
                                            <img src="{{ url('uploads/profile/thumbnails') }}/{{auth()->user()->profile}}" class="br-40 mr-2" alt="">
                                        @else
                                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu header__nav-menu mCustomScrollbar _mCS_1 stay-open p-2" aria-labelledby="dropdownMenu3" style="overflow: visible;min-width: 279px;">
                                        <li style="border-bottom:1px solid grey;">
                                            <div class="d-flex align-items-center justify-content-between mb-2 color-white">
                                                <div class="d-flex align-items-center">
                                                    @if(auth()->user()->profile !== null)
                                                        <img src="{{ url('uploads/profile/thumbnails') }}/{{auth()->user()->profile}}" class="br-40 mr-2" alt="">
                                                    @else
                                                        <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                                                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="pl-1 d-flex flex-column">
                                                        <a wire:navigate href="{{ url('user-profile') }}/{{ auth()->user()->username }}?tab=Offers&category=Currency" class="p-0">
                                                            <span class="fs-14">{{auth()->user()->name}}</span>
                                                        </a>
                                                        <span class="fs-13">$0.00</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    @php $seller = get_seller(); @endphp
                                                    <a class="btn__1" @if($seller == null || ($seller != null && $seller->verified != 1)) data-toggle="modal" data-target="#exampleModal" href="#" @else wire:navigate href="{{url('items/create')}}" @endif>
                                                        <span>Sell</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="p-0">
                                            @if(auth()->user()->role == 'admin')
                                            <div class="sidebar-menu mt-1">
                                                <a href="{{url('admin/dashboard')}}" class="sidebar-title sidebar-item p-1">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-activity fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Admin Dashboard</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endif
                                            <div class="sidebar-menu d-lg-none mt-1">
                                                <div class="sidebar-title p-1" data-toggle="collapse" data-target="#headbarOptions_1" aria-expanded="false" aria-controls="serviceOptions">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-cart fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Orders</div>
                                                        </div>
                                                    </div>
                                                    <i class="arrow-icon bi bi-chevron-down mr-1"></i>
                                                </div>

                                                <div class="collapse {{ in_array(request()->path(), ['orders/purchased', 'orders/sold']) ? 'show' : '' }}" id="headbarOptions_1">
                                                    <div class="d-flex flex-column ml-3">
                                                        <a wire:navigate href="{{ url('orders/purchased') }}" class="sidebar-item {{ request()->path() == 'orders/purchased' ? 'active' : '' }}">Purchased orders</a>
                                                        <a wire:navigate href="{{ url('orders/sold') }}" class="sidebar-item {{ request()->path() == 'orders/sold' ? 'active' : '' }}">Sold orders</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sidebar-menu d-lg-none mt-1">
                                                <div class="sidebar-title p-1" data-toggle="collapse" data-target="#headbarOptions_2" aria-expanded="false" aria-controls="serviceOptions">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-tag fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Offers</div>
                                                        </div>
                                                    </div>
                                                    <i class="arrow-icon bi bi-chevron-down mr-1"></i>
                                                </div>

                                                <div class="collapse {{ in_array(request()->path(), ['offers/Currency', 'offers/Accounts', 'offers/Top%20Up', 'offers/Items']) ? 'show' : '' }}" id="headbarOptions_2">
                                                    <div class="d-flex flex-column ml-3">
                                                        <a wire:navigate href="{{ url('offers/Currency') }}" class="sidebar-item {{ request()->path() == 'offers/Currency' ? 'active' : '' }}">Currency</a>
                                                        <a wire:navigate href="{{ url('offers/Accounts') }}" class="sidebar-item {{ request()->path() == 'offers/Accounts' ? 'active' : '' }}">Accounts</a>
                                                        <a wire:navigate href="{{ url('offers/Top Up') }}" class="sidebar-item {{ request()->path() == 'offers/Top%20Up' ? 'active' : '' }}">Top Up</a>
                                                        <a wire:navigate href="{{ url('offers/Items') }}" class="sidebar-item {{ request()->path() == 'offers/Items' ? 'active' : '' }}">Items</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sidebar-menu d-lg-none mt-1">
                                                <div class="sidebar-title p-1" data-toggle="collapse" data-target="#headbarOptions_3" aria-expanded="false" aria-controls="serviceOptions">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-chevron-double-up fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Boosting</div>
                                                        </div>
                                                    </div>
                                                    <i class="arrow-icon bi bi-chevron-down mr-1"></i>
                                                </div>

                                                <div class="collapse{{ in_array(request()->path(), ['boosting/my-requests', 'boosting/received-requests']) ? 'show' : '' }}" id="headbarOptions_3">
                                                    <div class="d-flex flex-column ml-3">
                                                        <a wire:navigate href="{{ url('boosting/my-requests') }}" class="sidebar-item {{ request()->path() == 'boosting/my-requests' ? 'active' : '' }}">My Requests</a>
                                                        <a wire:navigate href="{{ url('boosting/received-requests') }}" class="sidebar-item {{ request()->path() == 'boosting/received-requests' ? 'active' : '' }}">Received requests</a>
                                                        <a wire:navigate href="{{ url('items/create') }}?category=boosting" class="sidebar-item">Boosting subscriptions</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sidebar-menu d-none d-lg-block mt-1">
                                                <a wire:navigate href="{{url('orders/purchased')}}" class="sidebar-title p-1">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-cart fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Orders</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="sidebar-menu d-none d-lg-block mt-1">
                                                <a wire:navigate href="{{ url('offers/Currency') }}" class="sidebar-title p-1">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-tag fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Offers</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="sidebar-menu d-none d-lg-block mt-1">
                                                <a wire:navigate href="{{ url('boosting/my-requests') }}" class="sidebar-title p-1">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-chevron-double-up fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Boosting</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="sidebar-menu mt-2 pt-1 dividor-border-theme-top">
                                                <a wire:navigate href="{{url('messages')}}?messageType=All" class="sidebar-title sidebar-item p-1 {{ request()->path() == 'messages' ? 'active' : '' }}">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-chat-left-dots fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Messages</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="sidebar-menu mt-1">
                                                <a wire:navigate href="{{url('notifications')}}" class="sidebar-title sidebar-item p-1 {{ request()->path() == 'notifications' ? 'active' : '' }}">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-bell fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Notifications</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="sidebar-menu mt-1">
                                                <a wire:navigate href="{{url('feedback')}}?feedbackRating=All" class="sidebar-title sidebar-item p-1 {{ request()->path() == 'feedback' ? 'active' : '' }}">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-star fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Feedback</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="sidebar-menu mt-1">
                                                <a wire:navigate href="{{url('settings')}}" class="sidebar-title sidebar-item p-1">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-gear fs-20 mr-2"></i>
                                                        <div>
                                                            <div class="font-weight-bold">Account settings</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="sidebar-menu mt-2 pt-1 dividor-border-theme-top">
                                                <div class="sidebar-title sidebar-item p-1">
                                                    <form class="d-flex align-items-center" method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <i class="bi bi-arrow-bar-right fs-20 mr-2"></i>
                                                        @if(auth()->user())
                                                            <a class="font-weight-bold p-0" href="route('logout')"
                                                                    onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                                {{ __('Log Out') }}
                                                            </a>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                            <!---->
                                        </div>
                                        {{-- <li class="sm-arrow"><a wire:navigate href="{{url('profile')}}" class="pb-2 light-border-black">Profile</a></li>
                                        <li class="sm-arrow"><a wire:navigate href="{{ url('orders/purchased') }}">Orders</a></li>
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
                                        </li> --}}
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

    <div class="header__wrap" 
        style="position: absolute;
        right: 0;
        left: 0;
        border-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content nav-pc d-flex justify-content-center" 
                        style="margin-top: 19px;
                            background: #1b222eba;
                            border: 1px solid var(--border-1);
                            border-radius: 40px;
                            height: 49px;"
                        >
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

                        <ul class="header__nav mx-0">
                            @php $categories = categories(); @endphp
                            @foreach ($categories as $category)
                                <li class="header__nav-item mr-0" style="padding-right: 99px;">
                                    <a class="header__nav-link" href="#" role="button" id="dropdownMenu0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{$category->name}} 
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 184l144 144 144-144"></path>
                                        </svg>
                                    </a>
    
                                    <ul class="dropdown-menu header__nav-menu" aria-labelledby="dropdownMenu0">
                                        @foreach ($category->categoryGames as $item)
                                            <li>
                                                <div class="d-flex">
                                                    <img src="{{asset($item->game->image)}}" alt="" width="28px">
                                                    <a href="{{url('catalog')}}/{{$item->id}}" wire:navigate>
                                                        {{$item->game->name}} 
                                                        @if(in_array($item->category_id, [1,3])){{ $item->title }}@endif
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>  
                            @endforeach
                        </ul>  
                        {{-- mega menu --}}
                        

                        {{-- <div class="header__actions header__actions--2">
                            <a href="https://gogame.volkovdesign.com/favorites.html" class="header__link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                                <span>Favorites</span>
                            </a>

                            <a href="https://gogame.volkovdesign.com/checkout.html" class="header__link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><circle cx="176" cy="416" r="16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></circle><circle cx="400" cy="416" r="16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></circle><polyline points="48 80 112 80 160 352 416 352" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline><path d="M160,288H409.44a8,8,0,0,0,7.85-6.43l28.8-144a8,8,0,0,0-7.85-9.57H128" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                                <span>$00.00</span>
                            </a>
                        </div> --}}

                        <div class="header_search d-flex justify-content-center header_search_phone pt-3 w-100">
                            <!-- Overlay -->
                            <div id="customSearchOverlay2" class="custom-search-overlay"></div>
                        
                            <!-- Input + Dropdown -->
                            <div class="custom-search-container w-100">
                                <div class="header__form w-100">
                                    <input type="text" id="customSearchInput2" class="header__input w-100" autocomplete="off" placeholder="Search Gamify">
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
                                <div id="customSearchDropdown2" class="custom-search-dropdown">
                                    <h4>POPULAR CATEGORIES</h4>
                                    {{-- Optionally preload static popular ones here --}}
                                </div>
                            </div>
                            
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</header>