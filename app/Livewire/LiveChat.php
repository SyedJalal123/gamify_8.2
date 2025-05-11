<?php

namespace App\Livewire;

use Livewire\Component;

class LiveChat extends Component
{

    public $user;
    public $message;
    public $senderId;
    public $recieverId;
    public $buyerRequestConId;

    public function mount() {
        // $this->user = $this->getUser();

        $this->senderId = auth()->user()->id;
        // $this->recieverId = 
    }

    public function render()
    {
        return view('livewire.live-chats');
    }

    public function getUser($userId) 
    {
        $user = User::find($userId);
    }

    public function sendMessage() 
    {
        dd($this->message);
    }
    
    
}
