<div class="scroll-y mh-325px my-5 px-8">
    @foreach ($notifications as $notification)
    <!--begin::Item-->
    <div class="d-flex flex-stack py-4">
        <!--begin::Section-->
        <div class="d-flex align-items-center me-2">
            <!--begin::Code-->
            <img src="{{asset(getGame($notification->data['game_id'])->image)}}" class="mt-1 me-3" width="30" height="30" alt="">
            {{-- <span class="w-70px badge badge-light-success me-4">200 OK</span> --}}
             <div class="d-flex flex-column">
                <a @if($notification->data['title'] == 'New Order') href="{{ url('admin/orders') }}" @endif class="title d-flex flex-row align-items-center">
                    <div class="fs-13">{{$notification->data['title']}}</div>
                </a>
                <div class="d-flex flex-column">
                    <div class="opacity-50">{{$notification->data['data1']}}</div>
                </div>
            </div>
            {{-- <a href="#" class="text-gray-800 text-hover-primary fw-bold">New order</a> --}}
        </div>
        <!--end::Section-->
        <!--begin::Label-->
        <span class="badge badge-light fs-8">{{shortTimeAgo($notification->created_at)}}</span>
        <!--end::Label-->
    </div>
    <!--end::Item-->
    @endforeach
</div>
