@extends('frontend.app')

@section('css')
    <style>
        section {
            font-size: 14px;
        }
       /* .select2-container--default .select2-selection--single {
            height: 39px !important;
            font-size: 14px;
        } */
        .d-none {
            display: none !important;
        }
        @media (min-width: 768px) {
            .d-md-block {
                display: block !important;
            }
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/live-chat.css')}}">
@endsection

@section('content')
    @php
        $conversations = $identity === 'buyer'
            ? $buyerRequest->buyerRequestConversation
            : $buyerRequest->buyerRequestConversation->where('seller_id', auth()->id());
    @endphp
    <section class="section section--bg section--first" style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
        <div class="container mb-5 p-0" style="max-width: 1118px;">
            <div class="row d-flex flex-row justify-content-between align-items-center mb-5 px-3">
                <div class="d-flex flex-row align-items-center col-md-8">
                    <img onclick="get_live_feeds()" src="{{ asset($buyerRequest->service->categoryGame->game->image) }}" style="width: 40px;height: max-content;">
                    <div class="d-flex flex-column ml-3">
                        <h5 class="text-white fs-18 mb-0">{{ $buyerRequest->service->categoryGame->game->name }} - {{ $buyerRequest->service->name }}</h5>
                        <div class="text-black-40">Created: {{ $buyerRequest->created_at->format('F j, Y, g:i:s A') }}</div>
                        <div class="text-black-40">Expires: {{ $buyerRequest->expires_at->format('F j, Y, g:i:s A') }}</div>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-start align-items-md-end col-md-4 mt-4 mt-md-0">
                    @if(count($conversations) !== 0 && ($identity == 'seller'))
                        <button onclick="scrollToClass('live-chat')" class="btn btn-secondary w-max">Chat with Buyer</button>
                    @elseif($identity == 'buyer')
                        <button class="btn btn-secondary w-max">Cancel Request</button>
                    @endif
                </div>
            </div>
            <div class="alerts col-12 w-100">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!-- Main Box -->
            <div class="d-flex flex-column main-box px-2">
                <div class="Offers-live-feed d-flex flex-column pb-4">
                    <div class="d-flex justify-content-md-between flex-column flex-md-row">
                        <div class="offer-live-feed-title d-flex align-items-center mt-1 mb-3 px-3">
                            <div class="signal-ping-wrapper">
                                <span class="signal-ping-dot"></span>
                                <span class="signal-ping-circle"></span>
                                <span class="signal-ping-circle"></span>
                            </div>
                            <div class="d-flex flex-column text-white ml-3">
                                <div class="fw-bold">Offers live feed</div>
                                <div class="small text-black-40">Connected</div>
                            </div>
                        </div>
                        <div class="notifications-data d-flex flex-column flex-md-row text-white pb-2 p-md-0">
                            <div class="d-flex align-items-center ml-4 pb-2 fs-15">
                                <i class="bi bi-bell fs-19 pr-1"></i>
                                <span>Notified sellers: 666</span>
                            </div>
                            <div class="d-flex align-items-center ml-4 pb-2 fs-15">
                                <i class="bi bi-eye fs-19 pr-1"></i>
                                <span>Seen by: 45</span>
                            </div>
                            <div class="d-flex align-items-center ml-4 pb-2 fs-15">
                                <i class="bi bi-tag fs-19 pr-1"></i>
                                <span>Offers created: 6</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex bg-white br-2 flex-column align-items-center" id="live-feed">
                        @include('frontend.offers-live-feed', ['buyerRequest' => $buyerRequest])
                    </div>
                </div>
                <div class="live-chat @if(count($conversations) == 0) d-none @endif d-flex flex-column mb-4 pb-4">
                    <div class="live-chat-title d-flex align-items-center mt-1 mb-3">
                        <div class="signal-ping-wrapper">
                            <span class="red-ping-dot"></span>
                        </div>
                        <div class="d-flex flex-column text-white ml-2">
                            <div class="fw-bold">LIVE CHAT WITH SELLERS</div>
                        </div>
                    </div>
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
                                            @livewire('liveUser', ['buyerRequest' => $buyerRequest, 'identity' => $identity, 'conversations' => $conversations])
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                                <div class="live-chats col-md-8 m-0 p-0 chat">
                                    @livewire('Openchat', ['buyerRequestConversation' => $conversations->first(), 'identity' => $identity, 'buyerRequest' => $buyerRequest])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="request-details row d-flex pb-4 pb-md-2 mb-4 m-md-0 mx-0">
                    <div class="col-md-8 p-0 pr-md-4 pb-4">
                        <div class="bg-white">
                            <div class="px-4 py-3 border-bottom fw-bold">
                                Request Detials
                            </div>
                            <div>
                                @if($identity == 'seller')
                                <div class="d-flex justify-content-between px-4 py-2 border-bottom">
                                    <div class="seller_details d-flex text-left">
                                        <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                                            S
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div id="sellerName" class="fs-15 fw-bold">{{$buyerRequest->user->name}}</div>
                                            <div class="d-flex align-items-center">
                                                <i class="text-success bi bi-star-fill"></i>
                                                <span class="text-black-70 mx-1 fs-13">99.3%</span>
                                                <a href="#" class="fs-13">27,066 reviews</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @foreach ($buyerRequest->attributes as $attribute)
                                    <div class="d-flex justify-content-between px-4 py-2 border-bottom">
                                        @if ($attribute->type == 'select')
                                            <div class="">Select your {{$attribute->name}}</div>
                                            <div class="fw-bold">{{$attribute->pivot->value}}</div>
                                        @else
                                            <div class="">Input your {{$attribute->name}}</div>
                                            <div class="fw-bold">{{$attribute->pivot->value}}</div>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="row m-0 d-flex justify-content-between px-4 py-2 border-bottom">
                                    @if ($buyerRequest->description != null && $buyerRequest->service->name !== 'Custom Request')
                                        <div class="col-6 p-0">Provide any additional information</div>
                                        <div class="fw-bold col-6 p-0 text-right">{{$buyerRequest->description}}</div>
                                    @elseif ($buyerRequest->service->name == 'Custom Request')
                                        <div class="">Describe your request</div>
                                        <div class="fw-bold">{{$buyerRequest->description}}</div>
                                    @endif
                                </div>
                                @if($identity == 'seller')
                                <div class="d-flex px-4 py-3">
                                    @php
                                        $isRelated = $buyerRequest->requestOffers->contains(function ($offer) {
                                            return $offer->user_id === auth()->id();
                                        });
                                    @endphp

                                    @if(count($conversations) == 0)
                                    <button onclick="Livewire.dispatch('start-chat', { buyerId: {{ $buyerRequest->user_id }}, sellerId: {{ auth()->id() }} }); HideById('seller-chat-btn');scrollToClass('live-chat');" id="seller-chat-btn" class="btn btn-secondary fs-14 p-2 px-3 mr-2">
                                        Start Chat
                                    </button>
                                    @endif

                                    @if(!$isRelated)
                                        <button class="btn btn-dark fs-14 p-2 px-3" data-toggle="modal" data-target="#createOfferModal">Create Offer</button>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-0">
                        <div class="px-4 py-3 border-bottom fw-bold bg-white">
                            Attachments
                        </div>
                        <div class="d-flex justify-content-center align-items-center h-50 bg-white">
                            <span class="text-muted py-5">No photos uploaded</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="createOfferModal" tabindex="-1" role="dialog" aria-labelledby="createOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{url('create-offer')}}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="createOfferModalLabel">Create Boosting offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="container px-md-5">
                        <div class="container__top d-flex align-item-start align-items-md-end flex-column">

                            <input type="hidden" name="buyer_request_id" value="{{$buyerRequest->id}}">
                            <div class="mb-3 d-flex flex-column flex-md-row align-items-start align-items-md-center">
                                <label for="nameInput" class="form-label mr-2 fs-13">Price&nbsp;$:</label>
                                <input type="number" class="form-control" name="price" id="nameInput" placeholder="Enter price" style="min-width: 272px; max-width: 272px; width: 100%;" required>
                            </div>

                            <div class="mb-3 d-flex flex-column flex-md-row align-items-start align-items-md-center">
                                <label for="roleSelect" class="form-label mr-2 fs-13">Delivery time:</label>
                                <div style="min-width: 272px; max-width: 272px; width: 100%;">
                                    <select class="form-select" name="delivery_time" id="roleSelect" required>
                                        <option selected disabled>Select Delivery time</option>
                                        <option value="20 min">20 min</option>
                                        <option value="1 h">1 h</option>
                                        <option value="2 h">2 h</option>
                                        <option value="3 h">3 h</option>
                                        <option value="5 h">5 h</option>
                                        <option value="8 h">8 h</option>
                                        <option value="12 h">12 h</option>
                                        <option value="1 day">1 day</option>
                                        <option value="2 days">2 days</option>
                                        <option value="3 days">3 days</option>
                                        <option value="7 days">7 days</option>
                                        <option value="14 days">14 days</option>
                                        <option value="28 days">28 days</option>
                                        <option value="45 days">45 days</option>
                                        <option value="60 days">60 days</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create offer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Apply Select2 to all select elements
            $('select').select2({
                dropdownPosition: 'below',
                dropdownParent: $('#createOfferModal'),
            });
            $('#action_menu_btn').click(function() {
                $('.action_menu').toggle();
            });

            // Rearranging Format
            let userId = @json(auth()->user()->id);  // Get user ID dynamically from Laravel
            let buyerRequestId = @json($buyerRequest->user_id);

            // Get the div elements by class
            let div1 = document.getElementsByClassName('Offers-live-feed')[0];  // Get the first element with class 'Offers-live-feed'
            let div2 = document.getElementsByClassName('live-chat')[0];  // Get the first element with class 'live-chat'
            let div3 = document.getElementsByClassName('request-details')[0];  // Get the first element with class 'request-details'


            // Check if the elements exist and if the user is not the buyer request user
            if (div1 && div2 && div3) {
                if (userId !== buyerRequestId) {
                    div1.style.order = 2;
                    div2.style.order = 3;
                    div3.style.order = 1;
                }
            } else {
                console.error("One or more elements are missing in the DOM.");
            }
        });

        function get_live_feeds(){
            let url = new URL(window.location.href);
            $.ajax({
                url: url.toString(),
                method: 'GET',
                success: function (response) {
                    $('#live-feed').html(response); // Replace item list
                },
                error: function () {
                    alert('Something went wrong.');
                }
            });
        }

        function create_offer(){
            let url = new URL(window.location.href);
            $.ajax({
                url: '/create-offer',
                method: 'POST',
                success: function (response) {
                    
                },
                error: function () {
                    alert('Something went wrong.');
                }
            });
        }

        window.addEventListener('load', function () {
            const chatBody = document.querySelector('.msg_card_body');
            if (chatBody) {
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });

        $(document).ready(function() {
            setTimeout(() => {
                scroll_bottom('.msg_card_body');
            }, 500);
        });

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

        Livewire.on('conversation-created', (conversation) => {
            HideById('chat-btn-'+conversation['sellerId']);
            HideById('seller-chat-btn');
            $('.live-chat').removeClass('d-none');
        });

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

            // $('#chatInput').on('keypress', function (e) {
            //     if (e.which === 13 && !e.shiftKey) {
            //         e.preventDefault();
            //         messageFormSubmission(); // call the same function
            //     }
            // });

            // $('#chatSendBtn').on('click', function () {
            //     messageFormSubmission();
            // });

            function messageFormSubmission() {
                let input = $('#chatInput');
                let message = input.val().trim();

                if (message) {
                    Livewire.dispatch('sendMessage', { message: message });
                    input.val(''); // Clear input immediately
                }
            }
        });
    </script>


    <!-- Initialize Echo private channel listener for user notifications -->
    @auth
        <script>
            $(document).ready(function() {
                const userId = window.Laravel.user.id; // Pass user ID from Laravel to JS
                const buyerRequestId = {{ $buyerRequest->id }};

                let unreadCount = parseInt(document.querySelector('.count-notifications').textContent) || 0;
        
                Echo.private(`App.Models.User.${userId}`)
                    .notification((notification) => {  
                        if (notification.category == 'notification' || notification.category == 'offersUpdate') {
                            get_live_feeds()
                        }                 
                    });

                Echo.private(`chat-channel.${buyerRequestId}`)
                    .listen('MessageSentEvent', (e) => {
                        if(e['message']['sender_id'] != userId)
                        Livewire.dispatch('message-received', [e.message]);
                    });

                Echo.private(`chat-creation-channel.${userId}`)
                    .listen('ChatCreatedEvent', (e) => {
                        Livewire.dispatch('chat-created', [e.conversation]);
                    });

                Echo.private(`message-seen.${userId}`)
                    .listen('MessageSeenEvent', (e) => {
                        Livewire.dispatch('chat-seen', [e]);
                    });
            });
        </script>
    @endauth

@endsection
