<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['seller_id', 'category_game_id', 'deal_id', 'title', 'images', 'feature_image', 'images_path', 'description', 'delivery_time', 'delivery_method', 'account_info', 'quantity_available', 'minimum_quantity', 'price', 'discount', 'pause', 'expires_at'];

    protected $casts = [
        'images' => 'array',
        'discount' => 'array',
        'account_info' => 'array'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function categoryGame()
    {
        return $this->belongsTo(CategoryGame::class, 'category_game_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'item_attributes')
                ->using(ItemAttribute::class)
                ->withPivot('value')          // Include pivot columns
                ->withTimestamps();            // Include timestamps (if any)
    }


    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function getFinalPriceAttribute()
    {
        if (!$this->deal || !$this->deal->isRunning()) {
            return $this->price;
        }

        return round(
            $this->price - ($this->price * $this->deal->discount_percentage / 100),
            2
        );
    }
}
