<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Game;
use App\Models\Attribute;
use App\Models\ItemAttribute;
use App\Models\CategoryGame;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function create()
    {
        $categories = Category::with('categoryGames.game','categoryGames.services')->get();
        return view('frontend.items_create', compact('categories'));
    }

    public function index()
    {
        $categories = Category::all();
        return view('frontend.items_create', compact('categories'));
    }

    public function getGames(Request $request)
    {

        $categoryGames = CategoryGame::with('game')->whereHas('category', function ($query) use ($request) {
            $query->where('id', $request->category_id);
        })->get();
        
        return response()->json(['categoryGames' => $categoryGames]);
    }

    public function getAttributes(Request $request)
    {
        $CategoryGameId = $request->categoryGameId;
        $categoryGame = CategoryGame::where('id',$CategoryGameId)->with('game')->first();

        $attributes = Attribute::whereHas('categoryGames', function ($query) use ($CategoryGameId) {
            $query->where('category_game.id', $CategoryGameId); // Qualify the id
        })->get();

        // Group attributes by applies_to
        $gameAttributes = $attributes->where('applies_to', 1)->values();
        $categoryAttributes = $attributes->where('applies_to', 2)->values();

        return response()->json([
            'gameAttributes' => $gameAttributes,
            'categoryGame' => $categoryGame,

        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            // Validate the input
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'images' => 'array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,bmp,svg|max:2048',
            ]);
    
            DB::beginTransaction(); // Start transaction
    
            // Handle image uploads
            $imagePaths = [];
            $featureImagePath = null;
    
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $randomNumber = rand(1, 99999);
                    $filename = time() . '.' . $randomNumber . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filePath = 'uploads/items/' . $filename;
                    $image->move(public_path('uploads/items'), $filename);
                    $imagePaths[] = $filePath;
    
                    if ($request->feature_image == $image->getClientOriginalName()) {
                        $featureImagePath = $filePath;
                    }
    
                    if ($index === 0 && $featureImagePath === null) {
                        $featureImagePath = $filePath;
                    }
                }
            }
    
            // Save item
            $item = Item::create([
                'category_id'         => $request->category_id,
                'seller_id'           => Auth::id(),
                'category_game_id'    => $request->category_game_id,
                'title'               => $request->title ?? null,
                'images'              => !empty($imagePaths) ? json_encode($imagePaths) : null,
                'feature_image'       => $featureImagePath ?? null,
                'description'         => $request->description ?? null,
                'delivery_time'       => $request->delivery_time ?? null,
                'delivery_method'     => !empty($imagePaths) ? ($request->has('deliver_method') ? 'on' : 'off') : null,
                'account_info'        => !empty($imagePaths) ? json_encode($request->account_info) : null,
                'quantity_available'  => $request->quantity_available ?? null,
                'minimum_quantity'    => $request->minimum_quantity ?? null,
                'price'               => $request->price,
            ]);
    
            // Save discounts
            if ($request->has('discount_amont') && $request->has('discount_applied')) {
                $discountData = [];
                foreach ($request->discount_amont as $index => $amount) {
                    $discountData[] = [
                        'amount' => $amount,
                        'discount_percentage' => $request->discount_applied[$index],
                    ];
                }
                $item->discount = json_encode($discountData);
                $item->save();
            }
    
            // Save attributes
            $attributes = [];
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'attribute_')) {
                    $attributeId = str_replace('attribute_', '', $key);
                    $attributes[] = [
                        'item_id' => $item->id,
                        'attribute_id' => $attributeId,
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
    
            if (!empty($attributes)) {
                ItemAttribute::insert($attributes);
            }
    
            DB::commit(); // All done safely!
    
            return redirect()->back()->with('success', 'Offer created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function toggleService(Request $request)
    {   
        $serviceId = $request->input('service_id');
        $totalAvailable = $request->input('total_available');
        $subscribed = $request->input('subscribed');

        $seller = auth()->user(); // or auth('seller')->user();

        if (!$seller) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Find the service and get its category_game_id
        $service = \App\Models\Service::find($serviceId);

        $categoryGameId = $service->category_game_id;

        if ($subscribed === 'true') {
            $seller->services()->syncWithoutDetaching([$serviceId]);
        } else {
            $seller->services()->detach($serviceId);
        }

        // Count only services with the same category_game_id
        $totalSubscribed = $seller->services()
            ->where('category_game_id', $categoryGameId)
            ->count();

        return response()->json([
            'status' => 'success',
            'subscribedText' => $totalSubscribed > 0 
                ? "Subscribed {$totalSubscribed}/{$totalAvailable}" 
                : "Not Subscribed",
            'class' => $totalSubscribed > 0 
                ? "text-success" 
                : "text-muted"
        ]);

    }
    
    public function show(Item $item)
    {
        return view('frontend.seller.items_show', compact('item'));
    }
}





