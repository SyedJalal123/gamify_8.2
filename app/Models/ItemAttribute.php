<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemAttribute extends Pivot
{
    use HasFactory;

    protected $table = 'item_attributes';
    protected $fillable = ['item_id', 'attribute_id', 'value'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function categoryGameAttribute()
    {
        return $this->hasOne(CategoryGameAttribute::class, 'attribute_id', 'attribute_id')
            ->where('category_game_id', $this->item->category_game_id);
    }
}
