<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerRequestConversation extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_request_id',
        'order_id',
        'buyer_id',
        'seller_id',
    ];

    public function buyer (){
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function seller (){
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function buyerRequest (){
        return $this->belongsTo(BuyerRequest::class, 'buyer_request_id', 'id');
    }

    public function order (){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function unreadMessages()
    {
        return $this->hasMany(Message::class)->where('read_at', null);
    }
}
