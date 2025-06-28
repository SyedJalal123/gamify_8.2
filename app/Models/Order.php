<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'item_id',
        'request_offer_id',
        'category_game_id',
        'buyer_id',
        'seller_id',
        'title',
        'quantity',
        'price',
        'discount_in_per',
        'payment_fees',
        'other_taxes',
        'total_price',
        'payment_method',
        'delivery_type',
        'payment_status',
        'order_status',
        'disputed',
        'cancelation_reason',
        'cancelation_details',
        'dispute_won',
        'dispute_reason',
        'dispute_details',
        'feedback',
        'feedback_comment',
        'feedback_at',
        'disputed_at',
        'cancelled_at',
        'delivered_at',
        'created_at',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function offer()
    {
        return $this->belongsTo(RequestOffer::class, 'request_offer_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function chat()
    {
        return $this->hasOne(BuyerRequestConversation::class);
    }

    public function categoryGame()
    {
        return $this->belongsTo(CategoryGame::class, 'category_game_id');
    }
}
