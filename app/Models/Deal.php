<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'title',
        'discount_percentage',
        'start_at',
        'end_at',
        'is_active'
    ];

    protected $dates = ['start_at', 'end_at'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function isRunning()
    {
        return $this->is_active &&
               now()->between($this->start_at, $this->end_at);
    }

    public function scopeActive($query)
    {
        return $query
            ->where('is_active', 1)
            ->where('start_at', '<=', now())
            ->where('end_at', '>', now());
    }

    public function isExpired()
    {
        return $this->end_at->isPast();
    }
}
