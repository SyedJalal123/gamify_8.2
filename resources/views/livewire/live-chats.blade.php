<div class="card m-0 p-0">
    @if(request()->segments()[0] == 'order')
    <style>
        @media (max-width: 768px) {
            .card {
                height: 507px !important;
            }
        }
    </style>
    @endif
    @if($buyerRequestConversation != null)
    <div class="d-flex d-md-none @if(request()->segments()[0] == 'order') d-none @endif px-3 py-2 fs-16 text-white cursor-pointer back">
        <i class="bi-caret-left-fill"></i>
        <span class="ml-2">Inbox</span>
    </div>
    <div class="card-header msg_head">
        <div class="d-flex bd-highlight">
            <div class="img_cont">
                <div class="user_img seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                    {{ strtoupper(substr($reciever->name,0,1)) }}
                </div>
                {{-- <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img"> --}}
                <span class="online_icon"></span>
            </div>
            <div class="user_info">
                <span>{{$reciever->name}}</span>
                <p class="one-line-ellipsis">
                    @if ($buyerRequestConversation->order_id != null)
                        Order for {{ $buyerRequestConversation->buyer_request_id == null ? $buyerRequestConversation->order->categoryGame->category->name : $buyerRequestConversation->buyerRequest->service->name }}
                    @else
                        Boosting request: {{ $buyerRequestConversation->buyerRequest->request_id }}
                    @endif
                </p>
            </div>
            {{-- <div class="video_cam">
                <span><i class="fas fa-video"></i></span>
                <span><i class="fas fa-phone"></i></span>
            </div> --}}
        </div>
        <span id="action_menu_btn"><i class="bi-three-dots-vertical"></i></span>
        <div class="action_menu">
            <ul>
                <li><i class="fas fa-user-circle"></i> View profile</li>
                <li><i class="fas fa-users"></i> Add to close friends</li>
                <li><i class="fas fa-plus"></i> Add to group</li>
                <li><i class="fas fa-ban"></i> Block</li>
            </ul>
        </div>
    </div>
    <div class="card-body fade-in-delay-small msg_card_body pb-0 mb-0 px-1 px-md-3" style="height: 351px;">
        <input type="hidden" name="" id="conversationId" value="{{$buyerRequestConversation->id}}">
        <div class="d-flex flex-column mb-4">
            @if($buyerRequestConversation->buyer_request_id != null)
                <div class="d-flex justify-content-start mb-1">
                    <div class="msg_cotainer w-100 py-1 border-theme-left-tag-default">
                        <div class="message-box w-100 mw-100 d-flex flex-row justify-content-between align-items-end">
                            <span class="message-formatting mw-100">
                                Boosting Request chat started:<br>
                                <a class="underline text-theme-primary" target="_blank" href="{{ url('boosting-request') }}/{{ $buyerRequestConversation->buyer_request_id }}">{{ url('boosting-request') }}/{{ $buyerRequestConversation->buyerRequest->request_id }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
            @if ($buyerRequestConversation->order_id != null)
                <div class="d-flex justify-content-start">
                    <div class="msg_cotainer w-100 py-1 border-theme-left-tag-default">
                        <div class="message-box w-100 mw-100 d-flex flex-row justify-content-between align-items-end">
                            <span class="message-formatting mw-100">
                                Order Created: <a class="underline text-theme-primary" target="_blank" href="{{ url('order') }}/{{ $buyerRequestConversation->order->order_id }}">{{ url('order') }}/{{ $buyerRequestConversation->order->order_id }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @foreach ($chatMessages as $message)
            {{-- @if($message->sender_id == auth()->id()) --}}
                <div class="d-flex @if($message->sender_id == auth()->id()) justify-content-end @else justify-content-start @endif mb-4">
                    <div class="msg_cotainer @if($message->sender_id == auth()->id() || (auth()->user()->role == 'admin' && $message->sender_id == $buyerRequestConversation->buyer_id)) msg_cotainer_send @endif p-0">
                        @if (str_starts_with($message->file_type, 'image/') || str_starts_with($message->file_type, 'video/'))
                            @if (str_starts_with($message->file_type, 'video/'))
                                <div class="position-relative d-inline-block cursor-pointer" style="width: 312px; height: 170px;"data-toggle="modal" 
                                data-target="#liveMediaModal" onclick="showLiveImageModal('{{ asset($message->file_path) }}', 'video')">
                                    <video class="img-fluid rounded h-100" width="312" muted>
                                        <source src="{{ asset($message->file_path) }}" type="{{ $message->file_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                    <span class="position-absolute" 
                                        style="top: 50%; left: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                                        <i class="bi-play-circle" style="font-size: 48px; color:grey; opacity: 0.8;"></i>
                                    </span>
                                </div>
                            @else
                            <div data-toggle="modal" data-target="#liveMediaModal" class="cursor-pointer text-center" style="width: 312px; height: 170px;">
                                <img src="{{ asset($message->file_path) }}"
                                    onclick="showLiveImageModal('{{ asset($message->file_path) }}', 'image')"
                                    class="img-fluid rounded h-webkit-fill" alt="Image">
                                <i class="bi-arrows-fullscreen" style="position: absolute;right: 0;top: 0;padding: 2px 8px;color: #a5a5a5;" 
                                    onclick="showLiveImageModal('{{ asset($message->file_path) }}', 'image')"
                                    data-toggle="modal" data-target="#liveMediaModal"></i>
                            </div>
                            @endif
                        @elseif ($message->file_type != null)
                            @php $parts = explode('.', $message->file_path); @endphp
                            <a href="{{asset($message->file_path)}}" download class="d-flex justify-content-between cursor-pointer bg-white text-black py-1 px-3 br-3 min-w-20ch">
                                <div class="d-flex flex-start">
                                    <span class="truncate-text">{{ $message->file_name }}</span>.<span>{{  end($parts) }}</span>
                                </div>
                                <div class="d-flex">
                                    <i class="bi-download"></i>
                                </div>
                            </a>
                        @endif
                        <div class="message-box d-flex flex-row justify-content-between align-items-end">
                            <span class="message-formatting">
                                @if (auth()->user()->role == 'admin')
                                    @if($message->sender_id !== auth()->user()->id)
                                    <span class="text-black-50-2"><i>{{$message->sender_id == $buyerRequestConversation->seller_id ? 'Seller' : 'Buyer'}}:</i></span>
                                    @endif
                                @endif

                                @if ($message->sender->role == 'admin' && auth()->user()->role != 'admin')
                                    <span class="text-black-50-2"><i>Gamify: </i></span>
                                @endif
                                
                                {{$message->message}}
                                </span>     
                            @if($message->sender_id == auth()->id())
                            <i class="fs-10 fw-bold px-1 text-black-40" style="letter-spacing: -2.5px;">✓@if($message->read_at !== null)✓@endif</i>
                            @endif
                        </div>
                        <span class="msg_time_send @if($message->sender_id == auth()->id()) text-right right-0 @endif">{{shortTimeAgo($message->created_at)}}</span>
                    </div>
                    <!-- <div class="img_cont_msg">
                        <div class="user_img seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                            {{ strtoupper(substr($message->sender->name,0,1)) }}
                        </div>
                    </div> -->
                </div>
            {{-- @else
                <div class="d-flex justify-content-start mb-4">
                    <!-- <div class="img_cont_msg">
                        <div class="user_img_msg seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                            {{ strtoupper(substr($message->sender->name,0,1)) }}
                        </div>
                    </div> -->
                    <div class="msg_cotainer">
                        @if (str_starts_with($message->file_type, 'image/') || str_starts_with($message->file_type, 'video/'))
                            @if (str_starts_with($message->file_type, 'video/'))
                                <div class="position-relative d-inline-block cursor-pointer" style="width: 150px; height: auto;"data-toggle="modal" 
                                data-target="#liveMediaModal" onclick="showLiveImageModal('{{ asset($message->file_path) }}', 'video')">
                                    <video class="img-fluid rounded" width="150" muted>
                                        <source src="{{ asset($message->file_path) }}" type="{{ $message->file_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                    <span class="position-absolute" 
                                        style="top: 50%; left: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                                        <i class="bi-play-circle" style="font-size: 48px; color:grey; opacity: 0.8;"></i>
                                    </span>
                                </div>
                            @else
                                <img data-toggle="modal" data-target="#liveMediaModal"  src="{{ asset($message->file_path) }}" 
                                onclick="showLiveImageModal('{{ asset($message->file_path) }}', 'image')"
                                class="img-fluid rounded cursor-pointer" style="width: 150px;" alt="Image">
                                <i class="bi-arrows-fullscreen" style="position: absolute;right: 0;top: 0;padding: 2px 8px;color: #a5a5a5;"></i>
                            @endif
                        @elseif ($message->file_type != null)
                            @php $parts = explode('.', $message->file_path); @endphp
                            <a href="{{asset($message->file_path)}}" download class="d-flex justify-content-between cursor-pointer bg-white text-black py-1 px-3 br-3 min-w-20ch">
                                <div class="d-flex flex-start">
                                    <span class="truncate-text">{{ $message->file_name }}</span>.<span>{{  end($parts) }}</span>
                                </div>
                                <div class="d-flex">
                                    <i class="bi-download"></i>
                                </div>
                            </a>
                        @endif
                        <div class="message-box d-flex flex-row justify-content-between align-items-center">
                            <span class="message-formatting">{{$message->message}}</span>     
                        </div>
                        <span class="msg_time">{{shortTimeAgo($message->created_at)}}</span>
                    </div>
                </div>
            @endif --}}
        @endforeach
    </div>
    <div class="card-footer">
        <form wire:submit="sendMessage">
            <!-- file preview -->
                <div class="d-flex"
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <div class="files">
                        <div class="files-box">
                            <div x-show="uploading" class="file-show file-show-load flex-column bg-white align-items-center p-4 px-5 br-3">
                                <div class="d-flex">
                                    <div id="itemsOverlay">
                                        <div class="spinner-border spinner-border-medium" role="status"></div>
                                    </div>
                                    <span class="ml-2">Uploading</span>
                                    <div wire:click="$cancelUpload('file');" class="delete-upload">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="red" class="bi bi-x" viewBox="4 4 8 8">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                    </div>
                                </div>
                                <progress class="mt-2" max="100" x-bind:value="progress"></progress>
                            </div>
                            @if ($file)
                                <div wire:loading.remove wire:target="file" class="file-show other-file-show">
                                    @php
                                        $isImage = str_starts_with($file->getMimeType(), 'image/') ? true : false;
                                    @endphp
                                    <div class="text-danger p-2 position-absolute" style="top: -34px; left: -7px;">
                                        @error('file') {{$message}}  @enderror
                                    </div>
                                    @if ($isImage)
                                        <img src="{{ $file->temporaryUrl() }}" class="object-cover rounded-lg " alt="">
                                        <div wire:click="$set('file', '')" class="delete-upload">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="red" class="bi bi-x" viewBox="4 4 8 8">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                            </svg>
                                        </div>
                                    @else
                                        <span class="w-full bg-white px-3 pr-4 py-1 br-3">{{ $file->getClientOriginalName() }}</span>
                                        <div wire:click="$set('file', '')" class="delete-upload" style="top: -1px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="red" class="bi bi-x" viewBox="4 4 8 8">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @if($buyerRequestConversation->buyerRequest !== null && $buyerRequestConversation->buyerRequest->status == 'cancelled')
                    <div class="input-group">
                        <div class="input-group-append w-100">
                            <input type="text" disabled value="This conversation is no longer available" class="form-control input-theme-1">
                        </div>
                    </div>
                    @else
                    <div class="input-group">
                        <div class="input-group-append">
                            <label for="fileAttachment" class="input-group-text attach_btn cursor-pointer" :class="{ 'cursor-wait': uploading }" >
                                <i class="bi-paperclip"></i>
                            </label>
                            <input type="file" id="fileAttachment" x-bind:disabled="uploading" wire:model="file" class="d-none" />
                        </div>
                        <input type="hidden" value="{{$reciever->id}}">
                        <input type="hidden" value="{{$buyerRequestConversation->id}}">
                        <input type="text" wire:model="message" class="form-control type_msg" id="chatInput" autocomplete="off" placeholder="Type your message...">
                        <div class="input-group-append">
                            <button type="submit" x-bind:disabled="uploading" :class="{ 'cursor-wait': uploading }" id="chatSendBtn" class="input-group-text send_btn"><i class="bi-send-fill"></i></button>
                        </div>
                    </div>
                    @endif
                </div>
        </form>
    </div>
    @endif
</div>
