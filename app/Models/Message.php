<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'reciever_id',
        'buyer_request_conversation_id',
        'message',
        'file_name',
        'file_path',
        'file_type',
        'status',
        'delivered_at',
        'read_at',
    ];

    public function sender (){
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function reciever (){
        return $this->belongsTo(User::class, 'reciever_id', 'id');
    }

    public function buyerRequestConversation (){
        return $this->belongsTo(BuyerRequestConversation::class, 'buyer_request_conversation_id', 'id');
    }
}
