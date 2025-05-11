<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryGameAttribute extends Model
{
    use HasFactory;
    protected $table = 'category_game_attribute'; // Pivot table
    public $timestamps = false; // if you don't need created_at/updated_at

    public function categoryGame()
    {
        return $this->belongsTo(CategoryGame::class, 'category_game_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
