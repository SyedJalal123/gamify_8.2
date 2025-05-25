<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'user_id',
        'expires_at',
        'description',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'buyer_request_attributes')
                    ->withPivot('value') // If you have extra column(s) in pivot
                    ->withTimestamps();   // If you have timestamps in pivot
    }
    public function requestOffers()
    {
        return $this->hasMany(RequestOffer::class);
    }
    
    public function buyerRequestConversation() {
        return $this->hasMany(BuyerRequestConversation::class);
    }

    
}
