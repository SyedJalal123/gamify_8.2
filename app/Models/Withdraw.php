<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'fees',
        'conversation_rate',
        'received',
        'data1',
        'data2',    
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
