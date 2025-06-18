<nav class="left-0 background-theme-body-1 py-2">

    <div class="user-details d-flex flex-row align-items-center px-2 py-2 pb-3 dividor-border-theme-bottom">
        <div class="user-image mr-2" style="height: 40px; width: 40px;">
            <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
        </div>
        <!---->
        <div class="user-info">
            <h6 class="username fw-bold m-0">
                <a href="#" class="text-theme-primary"> {{ auth()->user()->name }} </a>
                <i class="bi bi-shield-fill-check"></i>
                <!---->
            </h6>
            <div class="registered-date">
                <p class="m-0"> Registered: 3/3/25 </p>
            </div>
            <!---->
        </div>
    </div>
    <!---->
    <!---->
    <div class="pl-2 pr-0 pt-2">
        <div class="sidebar-menu mt-1">
            <div class="sidebar-title p-1" data-toggle="collapse" data-target="#sidebarOptions_1" aria-expanded="false" aria-controls="serviceOptions">
                <div class="d-flex align-items-center">
                    <i class="bi bi-cart fs-20 mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Orders</div>
                    </div>
                </div>
                <i class="arrow-icon bi bi-chevron-down mr-1"></i>
            </div>

            <div class="collapse {{ in_array(request()->path(), ['orders/purchased', 'orders/sold']) ? 'show' : '' }}" id="sidebarOptions_1">
                <div class="d-flex flex-column ml-3">
                    <a wire:navigate href="{{ url('orders/purchased') }}" class="sidebar-item {{ request()->path() == 'orders/purchased' ? 'active' : '' }}">Purchased orders</a>
                    <a wire:navigate href="{{ url('orders/sold') }}" class="sidebar-item {{ request()->path() == 'orders/sold' ? 'active' : '' }}">Sold orders</a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu mt-1">
            <div class="sidebar-title p-1" data-toggle="collapse" data-target="#sidebarOptions_2" aria-expanded="false" aria-controls="serviceOptions">
                <div class="d-flex align-items-center">
                    <i class="bi bi-tag fs-20 mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Offers</div>
                    </div>
                </div>
                <i class="arrow-icon bi bi-chevron-down mr-1"></i>
            </div>

            <div class="collapse {{ in_array(request()->path(), ['offers/Currency', 'offers/Accounts', 'offers/Top%20Up', 'offers/Items']) ? 'show' : '' }}" id="sidebarOptions_2">
                <div class="d-flex flex-column ml-3">
                    <a wire:navigate href="{{ url('offers/Currency') }}" class="sidebar-item {{ request()->path() == 'offers/Currency' ? 'active' : '' }}">Currency</a>
                    <a wire:navigate href="{{ url('offers/Accounts') }}" class="sidebar-item {{ request()->path() == 'offers/Accounts' ? 'active' : '' }}">Accounts</a>
                    <a wire:navigate href="{{ url('offers/Top Up') }}" class="sidebar-item {{ request()->path() == 'offers/Top%20Up' ? 'active' : '' }}">Top Up</a>
                    <a wire:navigate href="{{ url('offers/Items') }}" class="sidebar-item {{ request()->path() == 'offers/Items' ? 'active' : '' }}">Items</a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu mt-1">
            <div class="sidebar-title p-1" data-toggle="collapse" data-target="#sidebarOptions_3" aria-expanded="false" aria-controls="serviceOptions">
                <div class="d-flex align-items-center">
                    <i class="bi bi-chevron-double-up fs-20 mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Boosting</div>
                    </div>
                </div>
                <i class="arrow-icon bi bi-chevron-down mr-1"></i>
            </div>

            <div class="collapse {{ in_array(request()->path(), ['boosting/my-requests', 'boosting/received-requests']) ? 'show' : '' }}" id="sidebarOptions_3">
                <div class="d-flex flex-column ml-3">
                    <a wire:navigate href="{{ url('boosting/my-requests') }}" class="sidebar-item {{ request()->path() == 'boosting/my-requests' ? 'active' : '' }}">My Requests</a>
                    <a wire:navigate href="{{ url('boosting/received-requests') }}" class="sidebar-item {{ request()->path() == 'boosting/received-requests' ? 'active' : '' }}">Received requests</a>
                    <a wire:navigate href="{{ url('items/create') }}?category=boosting" class="sidebar-item">Boosting subscriptions</a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu mt-1">
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
            <a href="#" class="sidebar-title sidebar-item p-1">
                <div class="d-flex align-items-center">
                    <i class="bi bi-gear fs-20 mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Account settings</div>
                    </div>
                </div>
            </a>
        </div>
        <!---->
    </div>

    <div class="py-2 pl-2 pr-0">
        <div class="sidebar-menu mt-1">
            <a href="#" class="sidebar-title sidebar-item p-1">
                <div class="d-flex align-items-center">
                    <i class="bi bi-box-arrow-up-right fs-20 mr-2"></i>
                    <div>
                        <div class="font-weight-bold">View Profile</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

</nav>
