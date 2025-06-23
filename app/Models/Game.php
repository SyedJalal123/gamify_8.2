<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = ['name','image','image_name'];

    public function categories() 
    {
        return $this->belongsToMany(Category::class, 'category_game');
    }

    // public function attributes()
    // {
    //     return $this->hasMany(Attribute::class);
    // }

    public function attributes() {
        return $this->belongsToMany(Attribute::class, 'attribute_game');
    }
    
    public function categoryGames()
    {
        return $this->hasMany(CategoryGame::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
