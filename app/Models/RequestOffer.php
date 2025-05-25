<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_request_id',
        'price',
        'delivery_time',
        'user_id',
    ];

    // Define the relationship to the BuyerRequest model
    public function buyerRequest()
    {
        return $this->belongsTo(BuyerRequest::class);
    }

    // Define the relationship to the User model (creator of the offer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversation() {
        return $this->hasOne(BuyerRequestConversation::class, 'buyer_request_id', 'buyer_request_id');
    }
}
