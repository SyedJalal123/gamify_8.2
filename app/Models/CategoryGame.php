<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryGame extends Model
{
    use HasFactory;
    protected $table = 'category_game';

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'category_game_attribute', 'category_game_id', 'attribute_id')
                    ->withPivot('visible');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
