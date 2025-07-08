@extends('frontend.app')

@section('css')
    <style>
        .section--first {
            padding-top: 144px !important;
        }

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
    <section class="section section--bg section--first"  style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
        <div class="row m-0 position-relative zi-2">
            <div class="d-none d-lg-block col-md-2 p-0">
                @include('frontend.includes.sidebar')
            </div>

            <div class="col-md-12 col-lg-10 pt-5">
                <div class="row">
                    <div class="col-12" style="max-width: 1048px;">
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="bi bi-star fs-20 fw-bold text-default"></i>
                            <h3 class="ml-2 mb-0 fw-bold text-theme-primary first-letter-cap">Feeback</h3>
                        </div>

                        
                        <div class="d-flex flex-column flex-md-row justify-content-between background-theme-body-1 text-theme-primary px-0 px-md-4 py-0 py-md-3 mb-3">
                            <div class="d-flex flex-row flex-50 justify-content-between">
                                <div class="d-flex flex-column flex-50 p-2 p-md-0 pl-md-4 dividor-border-theme-right">
                                    <div class="d-flex flex-column">
                                        <i class="bi bi-arrow-left-right mb-3 text-theme-marine"></i>
                                        <h6 class="mb-1 fs-15 text-theme-secondary fw-bold">COMPLETED ORDERS</h6>
                                        <h4>{{ count(userCompletedOrders(auth()->id())) }}</h4>
                                    </div>
                                </div>
                                <div class="d-flex flex-column flex-50 p-2 p-md-0 pl-md-4 dividor-border-theme-right">
                                    <div class="d-flex flex-column">
                                        <i class="fa fa-thumbs-up mb-3 text-theme-emerald"></i>
                                        <h6 class="mb-1 fs-15 text-theme-secondary fw-bold">POSITIVE FEEDBACK</h6>
                                        <h4>{{ count(userPositiveFeebacks(auth()->id())) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row flex-50 justify-content-between">
                                <div class="d-flex flex-column flex-50 p-2 p-md-0 pl-md-4 dividor-border-theme-right dividor-border-theme-top dividor-border-theme-top-md-0">
                                    <div class="d-flex flex-column">
                                        <i class="fa fa-thumbs-down mb-3 text-theme-cherry"></i>
                                        <h6 class="mb-1 fs-15 text-theme-secondary fw-bold">NEGATIVE FEEDBACK</h6>
                                        <h4>{{ count(userNegativeFeebacks(auth()->id())) }}</h4>
                                    </div>
                                </div>
                                <div class="d-flex flex-column flex-50 p-2 p-md-0 pl-md-4 dividor-border-theme-top dividor-border-theme-top-md-0">
                                    <div class="d-flex flex-column">
                                        <i class="bi bi-star-fill mb-3 text-theme-yellow-1"></i>
                                        <h6 class="mb-1 fs-15 text-theme-secondary fw-bold">FEEDBACK SCORE</h6>
                                        <h4>{{ userFeedbackScore(auth()->id()) }}%</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0">
                            <form method="GET" id="desktopFilterForm">
                                <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                                    <a wire:navigate href="{{url('feedback')}}?feedbackRating=All" class="btn btn-theme-default mb-1 {{ $feedbackRating == 'All' ? 'active' : '' }} mr-2">All</a>
                                    <a wire:navigate href="{{url('feedback')}}?feedbackRating=Positive" class="btn btn-theme-default mb-1 {{ $feedbackRating == 'Positive' ? 'active' : '' }} mr-2">Positive</a>
                                    <a wire:navigate href="{{url('feedback')}}?feedbackRating=Negative" class="btn btn-theme-default mb-1 {{ $feedbackRating == 'Negative' ? 'active' : '' }} mr-2">Negative</a>
                                </div>
                            </form>
                        </div>
                        
                        <div id="itemsContainerWrapper" class="br-9 position-realative fade-in-delay-small-2">
                            <div id="feedback-show" class="d-flex flex-column border-theme-1 background-theme-body-1 text-theme-primary px-3 pb-4 pt-2 mb-3">
                                @if(count($orders) != 0)
                                    @foreach ($orders as $order) 
                                        <a @if($order->seller_id == auth()->id()) wire:navigate href="{{ url('order') }}/{{ $order->order_id }}" @else href="#" onclick="event.preventDefault()" @endif class="@if($order->seller_id !== auth()->id()) cursor-default @endif text-theme-primary dividor-border-theme-bottom py-3 px-md-4 d-flex flex-column position-relative">
                                            <div class="d-flex flex-row mb-2">
                                                @if($order->feedback == 1)
                                                    <i class="fa fa-thumbs-up fs-20 pr-3 text-theme-teal"></i>
                                                @else
                                                    <i class="fa fa-thumbs-down fs-20 pr-3 text-theme-cherry"></i>
                                                @endif
        
                                                <div class="d-flex fs-14">
                                                    <span>{{ $order->categoryGame->category->name }}</span>
                                                    <span class="mx-1 text-theme-secondary">|</span>
                                                    <span class="text-theme-secondary three-ch-ellipsis">{{ $order->buyer->name }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex text-theme-secondary">
                                                <div class="d-flex fs-14" style="white-space: pre-line; overflow: hidden;">{!! $order->feedback_comment !!}</div>
                                            </div>

                                            <div class="position-absolute top-0 right-0 p-1 px-2 cursor-pointer fs-12 text-theme-secondary">{{ shortTimeAgo($order->feedback_at) }} {{ shortTimeAgo($order->feedback_at) != 'now' ? 'ago' : ''}}</div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="pt-4 pb-2 text-theme-secondary">
                                        No reviews found
                                    </div>
                                @endif
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