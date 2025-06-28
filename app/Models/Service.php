<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_game_id'];

    public function categoryGame()
    {
        return $this->belongsTo(CategoryGame::class);
    }

    public function sellers()
    {
        return $this->belongsToMany(User::class, 'seller_service');
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'service_attributes')->using(ServiceAttribute::class)->withTimestamps();
    }
    public function buyerRequest()
    {
        return $this->hasMany(BuyerRequest::class, 'service_id', 'id');
    }
}