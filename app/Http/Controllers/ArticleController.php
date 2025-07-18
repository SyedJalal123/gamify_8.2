<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;

class ArticleController extends Controller
{
    public function index(Request $request) 
    {
        $collections = ArticleCategory::with('articles')->get();
        return view('frontend.article-collections', compact('collections'));
    }

    public function collections(Request $request, $slug) 
    {
        return view('frontend.article-collection');
    }

    public function articles(Request $request, $slug) 
    {
        return view('frontend.articles');
    }

    public function get_articles_search(Request $request) 
    {
        $search = $request->search;

        $articles = Article::where('title','like','%'. $search .'%')->get();
        return $articles;
    }
}
