<div class="scroll-y mh-325px my-5 px-5">

    <div class="@if($type == 'header') px-3 @endif">
        <div class="d-flex flex-row mb-2 @if($type == 'header') justify-content-center @else justify-content-between @endif">
            <div class="d-flex flex-row align-items-center">
                <span class="text-theme-secondary fs-14"></span>
            </div>
            @if(count_user_unread_noti() !== 0)
            <div class="d-flex">
                <span 
                @if($type == 'header')      
                    onclick="$('#notification-main-header-box').attr('style', 'display: none !important'); 
                            $('#notifications-header-recheck').attr('style', 'display: flex !important');"
                @else onclick="Livewire.dispatch('mark-all-as-read');" @endif
                class="fs-14 underline hover-remove-underline text-theme-primary cursor-pointer">Mark all as Read</span>
            </div>
            @endif
        </div>
    </div>

    <div class="text-theme-primary p-4 flex-column align-items-center" id="notifications-header-recheck" style="display: none;" onclick="event.stopPropagation()">
        <h6 class="text-center fw-bold mb-4">Are you sure you want mark all notifications as read?</h6>
        <div class="d-flex flex-row">
            <button class="btn btn-light-danger me-2" 
                onclick="$('#notification-main-header-box').css('display','block');
                        $('#notifications-header-recheck').css('display','none')">
                Cancel
            </button>
            <button class="btn btn-light-primary" onclick="Livewire.dispatch('mark-all-as-read');">Mark as read</button>
        </div>
    </div>
    
    <!--begin::Item-->
    <div class="d-flex flex-column" id="notification-main-header-box">
        @if (count($notifications) > 0)    
            @foreach ($notifications as $notification)
            <!--begin::Item-->
            <div class="d-flex flex-stack py-4">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-2">
                    <!--begin::Code-->
                    {{-- <img src="{{asset(getGame($notification->data['game_id'])->image)}}" class="mt-1 me-3" width="30" height="30" alt=""> --}}
                    {{-- <span class="w-70px badge badge-light-success me-4">200 OK</span> --}}
                    @if ($notification->data['title'] == 'Order Dispute')
                        @php
                            $pill_class = 'badge-light-danger';
                            $pill = 'Dispute';
                        @endphp

                        @if ($notification->data['reason'] == 0)
                            @php $title = 'General Notification'; @endphp
                        @elseif ($notification->data['reason'] == 1)
                            @php $title = 'Guaranteed delivery time is overdue'; @endphp
                        @elseif ($notification->data['reason'] == 2)
                            @php $title = 'Seller claims goods were delivered, but the order was not received'; @endphp
                        @elseif ($notification->data['reason'] == 3)
                            @php $title = 'Cannot claim purchase due to in-game issues'; @endphp
                        @elseif ($notification->data['reason'] == 4)
                            @php $title = 'Order is not as described'; @endphp
                        @elseif ($notification->data['reason'] == 5)
                            @php $title = 'Seller is unresponsive'; @endphp
                        @else
                            @php $title = 'Other'; @endphp
                        @endif
                    @elseif ($notification->data['title'] == 'Request')
                        @php
                            $pill_class = 'badge-light-primary';
                            $pill = $notification->data['title'];
                        @endphp
                    @endif
                    
                    <span class="w-70px badge {{ $pill_class }} me-4">{{ $pill }}</span>

                    {{-- @php $order = getOrder('$notification->data['data1']'); @endphp --}}
                    <a href="{{ url($notification->data['link']) }}" @if($type == 'header') wire:click="markAsRead('{{ $notification->id }}');" @endif 
                        {{ $notification->data['title'] == 'Order Dispute' ? 'target="_blank"' : '' }}
                        class="text-gray-800 text-hover-primary fs-12 fw-bold">{!! $notification->data['data1'] !!}</a>
                    {{-- <a href="#" class="text-gray-800 text-hover-primary fw-bold">New order</a> --}}
                </div>
                <!--end::Section-->

                <div class="d-flex position-relative align-items-center">
                    <!--begin::Label-->
                    <span class="badge badge-light fs-8">{{shortTimeAgo($notification->created_at)}}</span>
                    <!--end::Label-->

                    <div class="d-flex position-relative align-items-center justify-content-center" style="min-width: 20px;">
                        @if ($notification->read_at == null)
                            <span wire:click="markAsRead('{{ $notification->id }}')" class="d-none" id="mark-read-{{ $notification->id }}"></span>
                            
                            <span class="fs-13 position-absolute right-0 text-theme-primary cursor-pointer"
                            onclick="markNotificationAsRead('{{ $notification->id }}');"
                            >x</span>
                        @else
                            <i class="bi bi-check2 text-theme-secondary"></i>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div>No activity found</div>
        @endif
    </div>
    <!--end::Item-->

    @if ($notifications->hasPages() && $type !== 'header')
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
