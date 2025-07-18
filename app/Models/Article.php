<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['category_id','title','short_description','description'];

    public function category() 
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
