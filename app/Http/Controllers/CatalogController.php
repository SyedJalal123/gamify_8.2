<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Attribute;
use App\Models\Service;
use App\Models\CategoryGame;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogController extends Controller
{
    public function index(Request $request, $category_game_id)
    {
        $categoryGame = CategoryGame::with('category', 'game', 'services')->find($category_game_id);
    
        $attributes = Attribute::whereHas('categoryGames', fn($q) => $q->where('category_game_id', $category_game_id))->get();
        $itemsQuery = Item::where('category_game_id', $category_game_id);
    
        ////// FILTERS ////////////////////////////////////////////////////////////
            // Apply attribute filters
            foreach ($request->query() as $key => $value) {
                if (str_starts_with($key, 'attr_') && !empty($value)) {
                    $attributeId = str_replace('attr_', '', $key);
                    $itemsQuery->whereHas('attributes', fn($q) => 
                        $q->where('attribute_id', $attributeId)->where('value', $value)
                    );
                }
            }
            // Apply search filter
            if ($searchTerm = $request->input('search')) {
                $itemsQuery->where(fn($query) => $query->where('title', 'like', "%$searchTerm%")
                    ->orWhereHas('attributes', fn($q) => $q->where('value', 'like', "%$searchTerm%"))
                    ->orWhere('price', 'like', "%$searchTerm%"));
            }
            // Apply sorting
            if ($request->sort === 'price_asc') {
                $itemsQuery->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $itemsQuery->orderBy('price', 'desc');
            } else {
                $itemsQuery->latest();
            }
        ///////////////////////////////////////////////////////////////////////////

        if ($categoryGame->category->id == 3) {
            $items = $itemsQuery->with('attributes', 'categoryGame.game', 'seller')->get();
            $grouped = collect();  // Holds the lowest price items
            
            foreach ($items as $item) {
                $keyAttribute = $item->attributes->first(fn($attr) => $attr->topup == 1);
                if (!$keyAttribute) continue;
            
                $value = $keyAttribute->pivot->value;
            
                if (!isset($grouped[$value])) {
                    // First occurrence, set as lowest
                    $grouped[$value] = $item;
                } else {
                    $existing = $grouped[$value];
            
                    if (
                        $item->price < $existing->price ||
                        ($item->price == $existing->price && $item->created_at < $existing->created_at)
                    ) {
                        // New item is better; update the grouped item
                        $grouped[$value] = $item;
                    }
                }
            }
            // dd($grouped);
            // Sort by topup value
            $sortedItems = $grouped->sortBy(
                fn($item) => $item->attributes->first(fn($attr) => $attr->topup == 1)->pivot->value ?? PHP_INT_MAX
            );

            $page = request()->get('page', 1);
            $perPage = 30;
            
            $paginatedItems = new LengthAwarePaginator(
                $sortedItems->slice(($page - 1) * $perPage, $perPage)->values(),
                $sortedItems->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            // Handle AJAX for category 3
            if ($request->ajax()) {
                $main = view('frontend.catalog.topup-items', compact('sortedItems', 'paginatedItems'))->render();

                return response()->json([
                    'main' => $main,
                ]);
            }
            
    
            return view('frontend.catalog.topupCatalog', compact('categoryGame', 'attributes', 'sortedItems', 'items', 'paginatedItems'));
        }else if ($categoryGame->category->id == 5){
            return view('frontend.catalog.boostingCatalog', compact('categoryGame'));
        }

        // Default category view
        $items = $itemsQuery->with('attributes', 'categoryGame.game', 'seller')->paginate(12)->withQueryString();
    
        if ($request->ajax()) {
            // Optional: render differently if needed
            return view('frontend.catalog._items', compact('items'))->render();
        }
    
        return view('frontend.catalog.catalog', compact('categoryGame', 'items', 'attributes'));
    }
    public function getItemDetails($id)
    {
        $item = Item::with('categoryGame.game', 'seller', 'attributes')->find($id);


        $categoryGameId = $item->category_game_id;
        $attributes = $item->attributes;

        // If the current item exists and has attributes
        if ($item && $attributes->count()) {
            // Get attribute ID => value map from pivot
            $attributeValues = $attributes->mapWithKeys(fn($attr) => [$attr->id => $attr->pivot->value]);

            // Fetch all items with the same category_game_id, excluding the current item
            $candidates = Item::with('categoryGame.game', 'seller', 'attributes')
                ->where('category_game_id', $categoryGameId)
                ->where('id', '!=', $item->id)
                ->get();

            // Filter items that match all attribute-value pairs
            $secondary = $candidates->filter(function ($candidate) use ($attributeValues) {
                $candidateAttributes = $candidate->attributes->mapWithKeys(fn($attr) => [$attr->id => $attr->pivot->value]);

                return $candidateAttributes->count() === $attributeValues->count()
                    && $candidateAttributes->diffAssoc($attributeValues)->isEmpty();
            });
        } else {
            // If the item has no attributes or doesn't exist
            $secondary = collect(); // Empty collection
        }

        $secondary = view('frontend.catalog.topup-items-secondary', compact('secondary'))->render();

        if (!$item) {
            return response()->json(['success' => false]);
        }
        $topup = $item->attributes->firstWhere('topup', 1)?->pivot->value ?? 1;

        
        return response()->json([
            'success' => true,
            'item' => [
                'id' => $item->id,
                'title' => ($topup . ' ' . ($item->title ?? $item->categoryGame->title)),
                'price' => number_format($item->price * $topup, 2),
                'image' => asset($item->feature_image ?? $item->categoryGame->feature_image),
                'delivery_time' => $item->delivery_time,
                'description' => $item->description,
                'seller' => $item->seller->seller->first_name ?? 'Seller',
                'attributes' => $item->attributes,
                'topup' => $topup,
            ],
            'secondary' => $secondary,
        ]);


    }   
    public function liveSearch(Request $request)
    {
        $query = $request->get('q');
        
        if ($query) {
            $results = DB::table('category_game') // Query from category_game table
                ->join('games', 'category_game.game_id', '=', 'games.id') // Join with games table to get game details
                ->join('categories', 'category_game.category_id', '=', 'categories.id') // Join with categories table to get category details
                ->where(function ($q1) use ($query) {
                    $q1->where('category_game.title', 'LIKE', "%{$query}%") // Search in category_game.title
                       ->orWhere('games.name', 'LIKE', "%{$query}%"); // Search in games.name
                })
                ->select(
                    DB::raw("CONCAT(games.name, ' ', category_game.title) as name"), // Combine game name and category game title
                    'category_game.id as category_game_id', // Return category_game.id instead of category_id or game_id
                    'games.image', // Include game image
                    'category_game.title', // Return title from category_game
                )
                ->limit(10) // Limit the number of results
                ->get();
        } else {
            // Default behavior when no query is provided
            $results = DB::table('category_game')
                ->join('games', 'category_game.game_id', '=', 'games.id')
                ->join('categories', 'category_game.category_id', '=', 'categories.id')
                ->whereIn('category_game.id', function ($query) {
                    $query->selectRaw('MIN(id)')
                          ->from('category_game')
                          ->groupBy('game_id');
                })
                ->select(
                    DB::raw("CONCAT(games.name, ' ', category_game.title) as name"),
                    'category_game.id as category_game_id', // Return category_game.id instead
                    'games.image',
                    'category_game.title',
                )
                ->limit(8) // Limit the number of results
                ->get();
        }
    
        // Map results to return in the desired format
        $mapped = $results->map(function ($item) {
            return [
                'name' => $item->name, // Combined name of game and category game title
                'image' => asset(($item->image ?? 'default.png')), // Fallback image if none exists
                'link' => route('catalog.index', [$item->category_game_id]) // Pass category_game_id for route
            ];
        });
        
        return response()->json($mapped);
    }
    public function itemDetail(Item $item)
    {
        $item->load(['attributes','categoryGame.game', 'categoryGame.attributes']);

        // Detect if category is explicitly 'Gold'
        $isCurrency = strtolower($item->categoryGame->category->id) == 1;
        return view('frontend.item-detail', [
            'item' => $item,
            'categoryGame' => $item->categoryGame,
            'isCurrency' => $isCurrency
        ]);
    }
}
