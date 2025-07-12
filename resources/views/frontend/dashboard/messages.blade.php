@extends('frontend.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/seller-dashboard.css')}}">
    <style>
        .d-none {
            display: none !important;
        }

        @media (min-width: 768px) {
            .d-md-flex {
                display: flex !important;
            }

            .d-md-block {
                display: block !important;
            }
        }
        
    </style>
    <link rel="stylesheet" href="{{asset('css/live-chat.css')}}">
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="row m-0 position-relative zi-2">
            <div class="d-none d-lg-block col-md-2 p-0">
                @include('frontend.includes.sidebar')
            </div>

            <div class="col-md-12 col-lg-10 pt-lg-5 mt-lg-5 pm-1200-0">
                <div class="row">
                    <div class="col-12" style="max-width: 1048px;">
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="bi bi-chat-left-dots fs-20 fw-bold text-default"></i>
                            <h3 class="ml-2 mb-0 fw-bold text-theme-primary first-letter-cap">Messages</h3>
                        </div>
                        <div class="mb-0">
                            <form method="GET" id="desktopFilterForm">
                                <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                                    <a wire:navigate href="{{url('messages')}}?messageType=All" class="btn btn-theme-default mb-1 {{ $messageType == 'All' ? 'active' : '' }} mr-2">All</a>
                                    <a wire:navigate href="{{url('messages')}}?messageType=Boosting" class="btn btn-theme-default mb-1 {{ $messageType == 'Boosting' ? 'active' : '' }} mr-2">Boosting</a>
                                    <a wire:navigate href="{{url('messages')}}?messageType=Orders" class="btn btn-theme-default mb-1 {{ $messageType == 'Orders' ? 'active' : '' }} mr-2">Orders</a>
                                    <a wire:navigate href="{{url('messages')}}?messageType=Support" class="btn btn-theme-default mb-1 {{ $messageType == 'Support' ? 'active' : '' }} mr-2">Support</a>
                                    <a wire:navigate href="{{url('messages')}}?messageType=DirectBuyerSeller" class="btn btn-theme-default mb-1 {{ $messageType == 'DirectBuyerSeller' ? 'active' : '' }} mr-2">Pre-purchase</a>
                                </div>
                            </form>
                        </div>
                        
                        <div id="itemsContainerWrapper" class="br-9 position-realative fade-in-delay-small-2">
                            @if(count($conversations) !== 0)
                                <div class="live-chat d-flex flex-column mb-4 pb-4">
                                    <div class="d-flex live-chat-data py-2 px-0">
                                        <div class="container-fluid h-100 px-0">
                                            <div class="row m-0 justify-content-center w-100">
                                                <div class="live-users col-md-4 m-0 p-0 pl-md-0 pr-md-2 chat">
                                                    <div class="card mb-sm-3 m-md-0 contacts_card mt-0">
                                                        <div class="card-header p-0">
                                                            <div class="input-group px-4 pt-3 py-1 d-flex justify-content-between">
                                                                <div class="text-white fw-bold fs-15">Browser notifications</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" id="chat_notifications" class="custom-control-input service-toggle">
                                                                    <label class="custom-control-label text-white" for="chat_notifications"></label>
                                                                </div>
                                                            </div>
                                                            <div class="input-group px-3 py-1">
                                                                <input type="text" placeholder="Search..." name="" class="form-control search">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text search_btn"><i class="bi-search"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body contacts_body" style="height: 437px;">
                                                            @livewire('LiveUser', ['conversations' => $conversations])
                                                        </div>
                                                        <div class="card-footer"></div>
                                                    </div>
                                                </div>
                                                <div class="live-chats col-md-8 m-0 p-0 chat">
                                                    @livewire('Openchat', ['buyerRequestConversation' => $conversations->first(), 'conversations' => $conversations])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-theme-primary mx-1 my-4">
                                    No conversations found
                                </div>
                            @endif
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
        }


        $(document).ready(function() {
            setTimeout(() => {
                scroll_bottom('.msg_card_body');

                var conId = $('#conversationId').val();

                $('.conversations').each(function() {
                    $(this).removeClass('active');
                });

                $(`#conversation_${conId}`).addClass('active');
                $(`#redDot_${conId}`).addClass('d-none');
            }, 500);
        });

        if (!window.sidebarUpdatedListener) {
            window.sidebarUpdatedListener = true;

            Livewire.on('sidebar-updated', () => {
                setTimeout(() => {
                    scroll_bottom('.msg_card_body');

                    var conId = $('#conversationId').val();

                    $('.conversations').each(function() {
                        $(this).removeClass('active');
                    });

                    $(`#conversation_${conId}`).addClass('active');
                    $(`#redDot_${conId}`).addClass('d-none');
                    
                }, 0.1);
            });
        }

        if (!window.messageUpdatedListener) {
            window.messageUpdatedListener = true;

            Livewire.on('message-updated', () => {
                setTimeout(() => {
                    let buffer = 350; // pixels from bottom
                    let $el = $('.msg_card_body');
                    let isNearBottom = $el.scrollTop() + $el.innerHeight() >= $el[0].scrollHeight - buffer;

                    if(isNearBottom){
                        scroll_bottom('.msg_card_body');
                        Livewire.dispatch('sidebar-update');
                    }
                }, 0.1);
            });
        }

        $(document).ready(function () {
            if (window.innerWidth <= 768) {

                $('.live-chats').hide();

                // Show chat, hide users
                $('.conversations').on('click', function () {
                    $('.live-users').hide();
                    $('.live-chats').show();
                });

                // Back to users
                $('.back').on('click', function () {
                    $('.live-chats').hide();
                    $('.live-users').show();
                });
            }
        });
    </script>

    <!-- Initialize Echo private channel listener for user notifications -->
    @auth
        <script>
            $(document).ready(function() {
                if (!window.chat_channel) {
                    window.chat_channel = {};
                }
                if (!window.chat_creation_channel) {
                    window.chat_creation_channel = {};
                }
                if (!window.message_seen) {
                    window.message_seen = {};
                }


                const userId = window.Laravel.user.id; // Pass user ID from Laravel to JS

                if (!window.chat_channel[userId]) {
                    Echo.private(`chat-channel.${userId}`)
                        .listen('MessageSentEvent', (e) => {
                            Livewire.dispatch('message-received', [e.message]);
                        });
                    window.chat_channel[userId] = true;
                }
                if (!window.chat_creation_channel[userId]) {
                    Echo.private(`chat-creation-channel.${userId}`)
                        .listen('ChatCreatedEvent', (e) => {
                            Livewire.dispatch('chat-created', [e.conversation]);
                        });
                    window.chat_creation_channel[userId] = true;
                }
                if (!window.message_seen[userId]) {
                    Echo.private(`message-seen.${userId}`)
                        .listen('MessageSeenEvent', (e) => {
                            Livewire.dispatch('chat-seen', [e]);
                        });                    
                    window.message_seen[userId] = true;
                }
            });
        </script>
    @endauth
@endsection