<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ServiceAttribute extends Pivot
{
    use HasFactory;

    public function buyerRequestAttribute()
    {
        return $this->hasMany(BuyerRequestAttribute::class, 'attribute_id', 'attribute_id');
    }
}
