<ui class="contacts">
    @foreach ($conversations as $key => $conversation)
        @php
            $reciever = auth()->id() === $conversation->buyer_id
                ? $conversation->seller
                : $conversation->buyer;
        @endphp
        <li wire:click="$dispatch('open-chat', { conversationId: {{ $conversation->id }}, recieverId: {{ $reciever->id }} })"
            class="cursor-pointer conversations" id="conversation_{{$conversation->id}}">
            <div class="d-flex bd-highlight py-2">
                <div class="img_cont">
                    <div class="user_img seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                        {{ strtoupper(substr($reciever->name,0,1)) }}
                    </div>
                    {{-- <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img"> --}}
                    <span class="online_icon"></span>
                </div>
                <div class="user_info">
                    <div class="d-flex align-items-center">
                        <span class="fs-15">{{$reciever->name}}</span>
                        @if(
                            $conversation->messages->last() &&
                            $conversation->messages->last()->sender_id != auth()->id() &&
                            $conversation->messages->last()->read_at === null
                        )
                        <span class="ml-2 mt-1 red-ping-dot" id="redDot_{{$conversation->id}}"></span>
                        @endif
                    </div>

                    <p class="one-line-ellipsis-2 small-message m-0">
                        @if($lastMessage = $conversation->messages->last())
                            {{ $lastMessage->message }}
                            @if($lastMessage->file_name)
                                {{ $lastMessage->file_name }}
                            @endif
                        @else
                            No messages yet
                        @endif
                    </p>
                </div>
            </div>
        </li>
    @endforeach
</ui>