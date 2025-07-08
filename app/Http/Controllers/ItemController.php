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
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function create(Request $request)
    {
        $category = $request->category;

        $categories = Category::with('categoryGames.game','categoryGames.services')->get();
        return view('frontend.items_create', compact('categories', 'category'));
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
        
        if(auth()->user()->role == 'admin') {
            return redirect()->back()->with('error', 'You can\'t perform this action.');
        }
        
        if($request->category_id == 1 || $request->category_id == 3) {
            $attributes = [];
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'attribute_')) {
                    $attributeId = str_replace('attribute_', '', $key);
                    $attributes[] = $value;
                }
            }

            $items = Item::where('seller_id', auth()->id())
                ->where('category_game_id', $request->category_game_id)
                ->whereHas('attributes', function ($query) use ($attributes) {
                    $query->whereIn('item_attributes.value', $attributes);
                }, '=', count($attributes)) // Require all values to match
                ->with('attributes', 'categoryGame.game', 'seller')
                ->get();

            if(count($items) != 0) {
                return redirect()->back()->with('error', 'Offer already existed!');
            }
        }

        try {
            // Validate the input
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'images' => 'array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,bmp,svg|max:4048',
            ]);
    
            DB::beginTransaction(); // Start transaction
    
            // Handle image uploads
            $imagePaths = [];
            $featureImagePath = null;
            $cateId = $request->category_id;
    
            $account_info = [];
            foreach ($request->account_info as $key => $info) {
                $account_id = Str::uuid()->toString();
                $sold = 'no';

                $account_info[$account_id] = [
                    'id'    => $account_id,
                    'info'  => $info,
                    'sold'  => $sold
                ];
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $randomNumber = rand(1, 99999);
                    $filename = time() . '.' . $randomNumber . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                    $folderPath = 'uploads/items/';
                    $filePath = 'uploads/items/' . $filename;
                    $image->move(public_path('uploads/items'), $filename);

                    // Resize Image
                    $imgManager = new ImageManager(new Driver());

                    $thumbImg = $imgManager->read($filePath);
                    $thumbImg->cover(255, 255);
                    $savePath = public_path('uploads/items/thumbnails/' . $filename);
                    $thumbImg->save($savePath);
                    
                    $imagePaths[] = $filename;
    
                    if ($request->feature_image == $image->getClientOriginalName()) {
                        $featureImagePath = $filename;
                    }
    
                    if ($index === 0 && $featureImagePath === null) {
                        $featureImagePath = $filename;
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
                'images_path'         => $folderPath ?? null,
                'description'         => $request->description ?? null,
                'delivery_method'     => ($cateId == 2) ? $request->delivery_method : null,
                'delivery_time'       => ($request->delivery_method == 'manual' || ($cateId !== 2 && $request->delivery_time)) ? $request->delivery_time : 'instant',
                'account_info'        => ($cateId == 2) ? $account_info : null,
                'quantity_available'  => ($cateId == 2 && $request->delivery_method == 'automatic') ? count($request->account_info) : $request->quantity_available,
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

    public function update(Request $request) 
    {
        // dd($request->all());
        // try {
            // Validate the input
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'images' => 'array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,bmp,svg|max:4048',
            ]);
            
            DB::beginTransaction(); // Start transaction
            
            // Handle image uploads
            $imagePaths = [];
            $existingImages = $request->existing_images ?? null;
            $featureImagePath = $request->feature_image ?? null;

            $cateId = $request->category_id;

            if($existingImages != null){
                foreach($existingImages as $image) {
                    $imagePaths[] = $image;
                }
            }


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $randomNumber = rand(1, 99999);
                    $filename = time() . '.' . $randomNumber . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                    $folderPath = 'uploads/items/';
                    $filePath = 'uploads/items/' . $filename;
                    $image->move(public_path('uploads/items'), $filename);

                    // Resize Image
                    $imgManager = new ImageManager(new Driver());

                    $thumbImg = $imgManager->read($filePath);
                    $thumbImg->cover(255, 255);
                    $savePath = public_path('uploads/items/thumbnails/' . $filename);
                    $thumbImg->save($savePath);
                    
                    $imagePaths[] = $filename;
    
                    if ($request->feature_image == $image->getClientOriginalName()) {
                        $featureImagePath = $filename;
                    }
    
                    if ($index === 0 && $featureImagePath === null) {
                        $featureImagePath = $filename;
                    }
                }
            }
            
            $availableQuantity = $request->quantity_available;
            $account_info = [];
            
            if($request->account_info != null) {
                foreach ($request->account_info as $key => $info) {
                    if(isset($request->account_id[$key])) {
                        $account_id = $request->account_id[$key];
                        $sold = $request->account_sold[$key];
                    }else {
                        $account_id = Str::uuid()->toString();
                        $sold = 'no';
                    }
                    
                    $account_info[$account_id] = [
                        'id'    => $account_id,
                        'info'  => $info,
                        'sold'  => $sold
                    ];
                }
            }

            if(count($account_info) != 0) {
                $UnsoldAccounts = collect($account_info)
                    ->where('sold', 'no');

                $availableQuantity = count($UnsoldAccounts);
            }


            // Save item
            $item = Item::with('categoryGame.category')->find($request->offer_id);
            $item->update([
                'category_id'         => $request->category_id,
                'seller_id'           => Auth::id(),
                'category_game_id'    => $request->category_game_id,
                'title'               => $request->title ?? null,
                'images'              => !empty($imagePaths) ? json_encode($imagePaths) : null,
                'feature_image'       => $featureImagePath ?? null,
                'description'         => $request->description ?? null,
                'delivery_method'     => ($cateId == 2) ? $request->delivery_method : null,
                'delivery_time'       => ($request->delivery_time && $request->delivery_method == 'manual') ? $request->delivery_time : 'instant',
                'account_info'        => ($cateId == 2) ? $account_info : null,
                'quantity_available'  => $availableQuantity,
                'minimum_quantity'    => $request->minimum_quantity ?? 1,
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
    
            DB::commit(); // All done safely!
    
            return redirect('offers/'.$item->categoryGame->category->name)->with('success', 'Offer updated successfully!');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->back()->with('error', $e->getMessage());
        // }

    }

    public function toggleService(Request $request)
    {   
        if(auth()->user()->role !== 'admin') {
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

    }
    
    public function show(Item $item)
    {
        return view('frontend.seller.items_show', compact('item'));
    }
}





