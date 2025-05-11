<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function games() 
    {
        return $this->belongsToMany(Game::class, 'category_game');
    }

    // public function attributes()
    // {
    //     return $this->hasMany(Attribute::class);
    // }
    public function categoryGames()
    {
        return $this->hasMany(CategoryGame::class);
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class, 'attribute_category');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
