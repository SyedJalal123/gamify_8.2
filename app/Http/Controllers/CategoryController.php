<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Game;
use App\Models\Attribute;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('frontend.seller.categories_select', compact('categories'));
    }

    public function getGames(Request $request)
    {
        $games = Game::whereHas('categories', function ($query) use ($request) {
            $query->where('categories.id', $request->category_id);
        })->get();

        return response()->json(['games' => $games]);
    }

    public function getAttributes(Request $request)
    {
        $attributes = Attribute::where('category_id', $request->category_id)
            ->orWhere('game_id', $request->game_id)
            ->get();

        return response()->json(['attributes' => $attributes]);
    }
}
