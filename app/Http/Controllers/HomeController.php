<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryGame;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        $categories = Category::with('games')->get();
        $currencies = CategoryGame::where('category_id',1)->with('game')->get();
        $accounts = CategoryGame::where('category_id',2)->with('game')->get();
        $topups = CategoryGame::where('category_id',3)->with('game')->get();
        $items = CategoryGame::where('category_id',4)->with('game')->get();

        return view('frontend.home', compact('categories', 'accounts', 'currencies', 'topups', 'items'));
    }

    function clearCache() {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        return "Config and cache cleared!";
    }

    function getHeaderSearchItems(Request $request) {
        $search = $request->search;

        $games = CategoryGame::where('category_id', $request->categoryId)->with('game')
        ->whereHas('game', function($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
        })
        ->get();

        return $games;
    }
}
