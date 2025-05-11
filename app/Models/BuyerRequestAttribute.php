<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerRequestAttribute extends Model
{
    use HasFactory;

    public function buyerRequest()
    {
        return $this->belongsTo(BuyerRequest::class, 'buyer_request_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
