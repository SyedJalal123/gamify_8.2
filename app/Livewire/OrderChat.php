<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BuyerRequest;
use App\Models\Message;
use App\Events\MessageSeenEvent;
use App\Events\OrderMessageSentEvent;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class OrderChat extends Component
{
    use WithFileUploads;

    public $reciever;
    public $conversation;
    public $message;

    #[Validate('nullable|file|max:80024')]
    public $file;

    public $identity;
    public $chatMessages;
    public $buyerRequest;
    public $senderId;

    /**
     * Create a new component instance.
     */
    public function mount()
    {
        $this->reciever = $this->identity == 'seller'
                ? $this->conversation->buyer
                : $this->conversation->seller;
                
        $this->readAllMessages();
        $this->getAllMessages();
        $this->senderId = auth()->id();
    }

    #[On('sendMessage')]
    public function sendMessage($message = null) 
    {
        $this->validate();
        
        if($message !== null){
            $this->message = $message;
        }

        if($this->message != null || $this->file != null){
            $sentMessage = $this->saveMessage();

            $this->reset(['message', 'file']);

            $this->chatMessages[] = $sentMessage;

            broadcast(new OrderMessageSentEvent($sentMessage));
            
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
            'buyer_request_conversation_id' => $this->conversation->id,
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

        if($this->conversation->id == $event['buyer_request_conversation_id']){
            $this->chatMessages[] = $newMessage;
        }

        $this->dispatch('message-updated');

        $this->readAllMessages();
    }
    

    public function getAllMessages() 
    {
        $this->chatMessages = $this->conversation->messages;
    }

    #[On('readAllMessages')]
    public function readAllMessages()
    {
        $chatMessages = $this->conversation->messages()
        ->where('reciever_id', auth()->user()->id)
        ->whereNull('read_at')
        ->update(['read_at' => now()]);
        
        if($chatMessages !== 0){
            broadcast(new MessageSeenEvent($this->reciever->id, $this->conversation->id));
        }
    }

    #[On('chat-seen')]
    public function chatSeen($event)
    {
        if($event['conversationId'] == $this->conversation->id)
        $this->getAllMessages();
    }
    
    public function render()
    {
        return view('livewire.order-chat');
    }
}
