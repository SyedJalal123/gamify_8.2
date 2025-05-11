<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BuyerRequestConversation;
use App\Events\ChatCreatedEvent;
use Livewire\Attributes\On;

class LiveUser extends Component
{
    public $buyerId;
    public $sellerId;
    public $buyerRequest;
    public $identity;
    public $conversations;


    #[On('sidebar-update')]
    public function mount() {
        $this->dispatch('sidebar-updated');
        
        // Sort the conversations manually
        $this->conversations = $this->conversations->sortByDesc(function ($conversation) {
            $latestMessage = $conversation->messages->sortByDesc('created_at')->first();
            return $latestMessage ? $latestMessage->created_at : $conversation->created_at;
        })->values(); // Reset keys
        
        
    }

    
    #[On('start-chat')]
    public function startChat($buyerId, $sellerId)
    {
        $conversation = BuyerRequestConversation::create([
            'buyer_request_id' => $this->buyerRequest->id,
            'buyer_id' => $buyerId,
            'seller_id' => $sellerId
        ]);

        $this->buyerId = $buyerId;
        $this->sellerId = $sellerId;

        $this->conversations = $this->conversations->prepend($conversation);

        $reciever = $this->identity == 'seller'
                        ? $conversation->buyer
                        : $conversation->seller;
        

        broadcast(new ChatCreatedEvent($conversation, $reciever));

        $this->dispatch('conversation-created', sellerId: $conversation->seller_id);
        $this->dispatch('show-chat', conversationId: $conversation->id);
        
    }

    #[On('chat-created')]
    public function updateConversations($conversation)
    {
        $conversation = BuyerRequestConversation::find($conversation['id']);
        $this->conversations = $this->conversations->prepend($conversation);

        if(count($this->conversations) == 1) {
            $this->dispatch('show-chat', conversationId: $conversation->id);
        }

        $this->dispatch('conversation-created', sellerId: $conversation->seller_id);
        $this->dispatch('sidebar-updated');
    }

    public function render()
    {
        return view('livewire.live-users');
    }
    
}
