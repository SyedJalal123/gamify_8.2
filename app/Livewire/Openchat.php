<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BuyerRequest;
use App\Models\BuyerRequestConversation;
use App\Models\Message;
use App\Events\AdminMessageSentEvent;
use App\Events\MessageSeenEvent;
use App\Events\MessageSentEvent;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class Openchat extends Component
{
    use WithFileUploads;
    
    public $reciever;
    public $buyerRequestConversation;
    public $conversations;
    public $message;

    #[Validate('nullable|file|max:80024')]
    public $file;

    public $identity;
    public $chatMessages;
    public $buyerRequest;
    public $senderId;
    
    public function mount() 
    {
        if($this->buyerRequestConversation != null){
            $this->reciever = $this->buyerRequestConversation->seller_id == auth()->id()
                            ? $this->buyerRequestConversation->buyer
                            : $this->buyerRequestConversation->seller;

            $this->readAllMessages();
            $this->getAllMessages();
            $this->senderId = auth()->id();
        }

    }


    #[On('show-chat')]
    #[On('open-chat')]
    public function openChat($conversationId, $recieverId = null) 
    {
        if($this->conversations->firstWhere('id', $conversationId) !== null){
            $conversation = $this->conversations->firstWhere('id', $conversationId);
        }else {
            $conversation = BuyerRequestConversation::with(['buyer', 'seller', 'messages.sender','messages.reciever', 'order.categoryGame.category', 'buyerRequest'])->find($conversationId);
        }

        $this->buyerRequestConversation = $conversation;

        $this->getAllMessages();

        $this->reciever = $this->buyerRequestConversation->seller_id == auth()->id()
                        ? $this->buyerRequestConversation->buyer
                        : $this->buyerRequestConversation->seller;
                        
        $this->dispatch('sidebar-updated');

        $this->readAllMessages();
    }

    public function render()
    {
        return view('livewire.live-chats');
    }

    #[On('sendMessage')]
    public function sendMessage($message = null) 
    {
        // dd($this->file, $this->message);

        $this->validate();
        
        if($message !== null){
            $this->message = $message;
        }

        if($this->message != null || $this->file != null){
            $sentMessage = $this->saveMessage();

            $this->reset(['message', 'file']);

            $this->chatMessages[] = $sentMessage;
            
            
            if(auth()->user()->role == 'admin'){
                broadcast(new MessageSentEvent($sentMessage, $this->buyerRequestConversation->buyer_id));
                broadcast(new MessageSentEvent($sentMessage, $this->buyerRequestConversation->seller_id));
            }else {
                broadcast(new MessageSentEvent($sentMessage, $this->reciever->id));
                broadcast(new AdminMessageSentEvent($sentMessage));
                
            }

            $this->dispatch('message-updated');
            
        }
    }

    public function saveMessage()
    {
        # File Handling
        if($this->file){
            $fileNameShow = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);;
            $fileNameSave = 'Gamify_'.$this->file->hashName();
            $realPath = $this->file->getRealPath();
            $folderPath = 'uploads/messages/'.$fileNameSave;
            $fileType = $this->file->getMimeType();
            
            $fileMoved = File::move($realPath, public_path('uploads/messages') . '/' . $fileNameSave);
        }else {
            $fileNameShow = null;
            $fileName = null;
            $folderPath = null;
            $fileType = null;
        }

        $message = Message::create([
            'buyer_request_conversation_id' => $this->buyerRequestConversation->id,
            'sender_id' => auth()->id(),
            'reciever_id' => $this->reciever->id,
            'message' => $this->message,
            'file_name' =>  $fileNameShow,
            'file_path' =>  $folderPath,
            'file_type' => $fileType,
        ]);

        return $message;
    }

    #[On('message-received')]
    public function listenMessage($event)
    {
        $newMessage = Message::find($event['id']);

        if($this->buyerRequestConversation->id == $event['buyer_request_conversation_id']){
            $this->chatMessages[] = $newMessage;
        }

        $this->dispatch('message-updated');

        $this->readAllMessages();
    }
    

    public function getAllMessages() 
    {
        $this->chatMessages = $this->buyerRequestConversation->messages;
    }

    #[On('readAllMessages')]
    public function readAllMessages()
    {
        if(auth()->user()->role !== 'admin') {
            $chatMessages = $this->buyerRequestConversation->messages()
            ->where('reciever_id', auth()->user()->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
            
            if($chatMessages !== 0){
                broadcast(new MessageSeenEvent($this->reciever->id, $this->buyerRequestConversation->id));
            }
        }
    }

    #[On('chat-seen')]
    public function chatSeen($event){
        if($event['conversationId'] == $this->buyerRequestConversation->id)
        $this->getAllMessages();
    }
}
