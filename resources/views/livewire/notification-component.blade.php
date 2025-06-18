<div id="itemsContainerWrapper" class="br-9 position-realative fade-in-delay-small-2">
    
    <li class="@if($type == 'header') px-3 @endif">
        <div class="d-flex flex-row justify-content-between mb-2" onclick="event.stopPropagation()">
            <div class="d-flex flex-row align-items-center">
                <span class="signal-ping-dot mr-2"></span>
                <span class="text-theme-secondary fs-14">Connected</span>
            </div>
            @if(count(auth()->user()->unreadnotifications) !== 0)
            <div class="d-flex">
                <span 
                @if($type == 'header')      
                    onclick="   $('#notification-main-header-box').css('display','none');
                                $('#notifications-header-recheck').css('display','flex');"
                @else onclick="Livewire.dispatch('mark-all-as-read');" @endif
                class="fs-14 underline hover-remove-underline text-theme-primary cursor-pointer">Mark all as Read</span>
            </div>
            @endif
        </div>
    </li>

    <div class="text-theme-primary p-4 flex-column align-items-center" id="notifications-header-recheck" style="display: none;" onclick="event.stopPropagation()">
        <h6 class="text-center fw-bold mb-4">Are you sure you want mark all notifications as read?</h6>
        <div class="d-flex flex-row">
            <button class="btn btn-theme-white mr-2" 
                onclick="$('#notification-main-header-box').css('display','block');
                        $('#notifications-header-recheck').css('display','none')">
                Cancel
            </button>
            <button class="btn btn-theme-default" onclick="Livewire.dispatch('mark-all-as-read');">Mark as read</button>
        </div>
    </div>

    <li class="notification-main-box list-unstyled" id="notification-main-header-box">
        @foreach ($notifications as $notification)
            <div onclick="handleNotificationClick(event, '{{$notification->data['link']}}');" @if($type == 'header') wire:click="markAsRead('{{ $notification->id }}');" @endif class="notification-box cursor-pointer mb-1 d-flex justify-content-between text-theme-primary">
                <div class="d-flex">
                    <img src="{{asset(getGame($notification->data['game_id'])->image)}}" class="mt-1" width="30" height="30" alt="">
                    <div class="d-flex flex-column ml-3">
                        <div class="title d-flex flex-row align-items-center">
                            <div class="fs-13">{{$notification->data['title']}}</div>
                            <div class="opacity-50 small ml-3">{{shortTimeAgo($notification->created_at)}}</div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="opacity-50">{{$notification->data['data1']}}</div>
                            <div>
                                <span class="opacity-50">{{$notification->data['data2']}}</span>
                                <!-- <span class="opacity-50">Price: </span><strong>${{$notification->data['data2']}}</strong> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex position-relative"  x-data>
                    @if ($notification->read_at == null)
                        <span wire:click="markAsRead('{{ $notification->id }}')" class="d-none" id="mark-read-{{ $notification->id }}"></span>
                        
                        <span class="fs-13 underline position-absolute right-0 text-theme-primary cursor-pointer"
                        onclick="markNotificationAsRead('{{ $notification->id }}'); event.preventDefault(); event.stopImmediatePropagation();"
                        >Mark&nbsp;as&nbsp;Read</span>
                    @else
                        <i class="bi bi-check2 text-theme-secondary"></i>
                    @endif
                </div>
            </div>
        @endforeach
    </li>

    @if(count($notifications) == 0 && $type == 'header')
        <div class="text-theme-primary p-4 d-flex flex-column align-items-center">
            <h5 class="fw-bold">You’re all caught up!</h5>
            <span class="fs-14 text-center">You have no new notifications. Notifications are deleted after 30 days</span>
        </div>
    @endif

    @if ($notifications->hasPages() && $type !== 'header')
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $notifications->links() }}
        </div>
    @endif
</div>