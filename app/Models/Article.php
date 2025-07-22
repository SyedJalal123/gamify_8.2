<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Article extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['category_id','title','short_description','description'];

    public function collection() 
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function category() 
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }
}
