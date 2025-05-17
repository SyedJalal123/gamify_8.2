<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['seller_id', 'category_game_id', 'title', 'images', 'feature_image', 'images_path', 'description', 'delivery_time', 'delivery_method', 'account_info', 'quantity_available', 'minimum_quantity', 'price', 'discount'];

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
}
