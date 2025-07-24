<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    use SoftDeletes;
    protected $fillable = ['order_id', 'balance', 'description', 'payment_type', 'user_type', 'payment_method'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
