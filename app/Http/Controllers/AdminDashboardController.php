<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryGame;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Service;
use App\Models\Game;
use App\Models\Order;
use App\Models\Seller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManager;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BoostingOfferNotification;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index() {
        return view('backend.dashboard');
    }

    public function games(Request $request) {
        $games = Game::with('attributes')->orderBy('id', 'desc');

        if($request->ajax()){

            return DataTables::eloquent($games)
            ->addColumn('title_data', function($game) {
                return '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <img src="'.asset("uploads/games/".$game->image_name).'" alt="'.$game->name.'" style="width: 32px;height: 32px;" class="w-100" />
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#" class="text-gray-800 text-hover-primary mb-1">'.$game->name.'</a>
                        </div>
                    </div>
                ';
            })
            ->addColumn('action_data', function($game) {
                return '
                        <div  data-bs-toggle="modal" onclick="edit_game_modal_values(\'' . $game->image . '\', \'' . $game->name . '\', \'' . $game->id . '\')" data-bs-target="#kt_modal_edit_game" class="menu-item px-3 float-end">
                            <span class="menu-link px-3">Edit</span>
                        </div>
                ';
            })
            ->rawColumns(['title_data', 'action_data'])
            ->make(true);
        }


        return view('backend.games', compact('games'));
    }

    public function add_game(Request $request) {
        // dd($request->all());

        try {
            if ($request->hasFile('image')) {
                // if ($user->profile && file_exists(public_path('uploads/games/' . $request->image))) {
                //     unlink(public_path('uploads/games/' . $request->image));
                //     unlink(public_path('uploads/games/28_' . $request->image));
                // }

                $image = $request->file('image');

                // Generate unique filename
                $randomNumber = rand(1, 99999);
                $filename = time() . '.' . $randomNumber . '.' . $image->getClientOriginalExtension();

                // Original upload path
                $originalPath = public_path('uploads/games/' . $filename);
                $image->move(public_path('uploads/games'), $filename);

                // Initialize Intervention Image
                $imgManager = new ImageManager(new Driver());

                // Resize to 125x125
                $img125 = $imgManager->read($originalPath)->cover(32, 32);
                $savePath125 = public_path('uploads/games/' . $filename);
                $img125->save($savePath125);

                // Resize to 44x44
                $img44 = $imgManager->read($originalPath)->cover(28, 28);
                $savePath44 = public_path('uploads/games/28_' . $filename);
                $img44->save($savePath44);

            }

            Game::create([
                'name' => $request->name,
                'image' => 'uploads/games/'.$filename,
                'image_name' => $filename,
            ]);
            
            return redirect()->back()->with('success', 'Game added successfully');
        } catch (\Exception $e) {
            Log::error('Game add failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while adding the game.');
        }
    }

    public function edit_game(Request $request) {
        // dd($request->all());

        try {
            $game = Game::where('id', $request->game_id)->first();

            if ($request->hasFile('image')) {
                // if ($game->image && file_exists(public_path($game->image))) {
                //     unlink(public_path($game->image));
                //     unlink(public_path('uploads/games/28_'.$game->image_name));
                // }

                $image = $request->file('image');

                // Generate unique filename
                $randomNumber = rand(1, 99999);
                $filename = time() . '.' . $randomNumber . '.' . $image->getClientOriginalExtension();

                // Original upload path
                $originalPath = public_path('uploads/games/' . $filename);
                $image->move(public_path('uploads/games'), $filename);

                // Initialize Intervention Image
                $imgManager = new ImageManager(new Driver());

                // Resize to 125x125
                $img125 = $imgManager->read($originalPath)->cover(32, 32);
                $savePath125 = public_path('uploads/games/' . $filename);
                $img125->save($savePath125);

                // Resize to 44x44
                $img44 = $imgManager->read($originalPath)->cover(28, 28);
                $savePath44 = public_path('uploads/games/28_' . $filename);
                $img44->save($savePath44);

                $game->image = 'uploads/games/'.$filename;
                $game->image_name = $filename;
            }

            $game->name = $request->name;
            $game->save();

            

            return redirect()->back()->with('success', 'Game updated successfully');
        } catch (\Exception $e) {
            Log::error('Game update failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while updating the game.');
        }
    }

    public function items(Request $request, $category) {
        if($category == 'TopUp') {
            $cat = 'Top Up';
        }else {
            $cat = $category;
        }
        // dd($category);
        $cat = Category::where('name', $cat)->first();
        $categoryGames = CategoryGame::with('attributes','game','items','services.attributes','services.buyerRequest')->where('category_id', $cat->id)->orderBy('id', 'desc');
        

        if($request->ajax()){
            return DataTables::eloquent($categoryGames)
            ->addColumn('title_data', function($game) {
                if($game->feature_image == null) {
                    $image = $game->game->image;
                }else {
                    $image = $game->feature_image;
                }

                return '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <img src="'.asset($image).'" alt="'.$game->title.'" style="width: 32px;height: 32px;" class="w-100" />
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#" class="text-gray-800 text-hover-primary mb-1">'.$game->game->name.' '.$game->title.'</a>
                        </div>
                    </div>
                ';
            })
            ->filterColumn('title_search', function ($query, $keyword) {
                $query->where(function($q) use ($keyword) {
                    $q->where('title', 'like', "%$keyword%")
                    ->orWhereHas('game', function($q2) use ($keyword) {
                        $q2->where('name', 'like', "%$keyword%");
                    });
                });
            })
            ->addColumn('offers_count', function($game) {
                $offers_count = 0;
                if($game->category_id == 5) {
                    foreach($game->services as $service) {
                        $offers_count += count($service->BuyerRequest);
                    }
                }
                else {
                    $offers_count = count($game->items);
                }

                return '
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-row">
                                    '.$offers_count.'
                                </div>
                            </div>
                    ';
            })
            ->addColumn('attributes', function($game) {

                $html = '-----------';
                if($game->category_id == 5) {
                    foreach ($game->services as $key => $service) {
                        if($key == 0)
                        $html = '';

                        $attributes = [];
                        foreach ($service->attributes as $attribute) {
                            $attributes[] = $attribute->name;
                        }
                        $attributeString = implode('<br>', $attributes);
                        
    
                        $html .= ($key !== 0 ? ' - ' : '');
                        $html .= '<span class="px-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="' . 
                                    htmlspecialchars($attributeString, ENT_QUOTES, 'UTF-8') . '">' . 
                                    htmlspecialchars($service->name, ENT_QUOTES, 'UTF-8') . 
                                '</span>';
                    }
                }
                else {
                    foreach ($game->attributes as $key => $attribute) {
                        if($key == 0)
                        $html = '';
    
                        $options = implode('<br>', $attribute->options);
    
                        $html .= ($key !== 0 ? ' - ' : '');
                        $html .= '<span class="px-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="' . 
                                    htmlspecialchars($options, ENT_QUOTES, 'UTF-8') . '">' . 
                                    htmlspecialchars($attribute->name, ENT_QUOTES, 'UTF-8') . 
                                '</span>';
                    }
                }
                
                return '
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-row">
                                '.$html.'
                            </div>
                        </div>
                ';
            })
            ->addColumn('action_data', function($game) {
                return '
                        <a href="'.url('admin/item/edit/'.$game->id).'" class="menu-item px-3 float-end">
                            <span class="menu-link px-3">Edit</span>
                        </a>
                ';
            })
            ->rawColumns(['title_data', 'attributes', 'offers_count', 'action_data'])
            ->make(true);
        }

        return view('backend.items', compact('categoryGames','category','cat'));
    }

    public function add_item(Request $request) {
        $categories = Category::all();
        $games = Game::orderBy('name','asc')->get();
        $attributes = Attribute::where('cloned','0')->get();

        return view('backend.add_item', compact('categories', 'games', 'attributes'));
    }

    public function edit_item(Request $request, $id) {
        $item = CategoryGame::with('items','attributes','services.attributes','services.buyerRequest')->where('id', $id)->first();
        $categories = Category::all();
        $games = Game::orderBy('name','asc')->get();
        $attributes = Attribute::where('cloned','0')->get();


        return view('backend.edit_item', compact('categories', 'games', 'attributes', 'item'));
    }

    public function get_attribute(Request $request) {
        // dd($request->all());

        $attribute = Attribute::find($request->attributeId);
        return $attribute;
    }

    public function store_item(Request $request) {
        // dd($request->all());

        $category = Category::find($request->category_id);

        $filepath = null;
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Generate unique filename
            $randomNumber = rand(1, 99999);
            $filename = time() . '.' . $randomNumber . '.' . $image->getClientOriginalExtension();

            // Original upload path
            $originalPath = public_path('uploads/games/' . $filename);
            $image->move(public_path('uploads/games'), $filename);

            // Initialize Intervention Image
            $imgManager = new ImageManager(new Driver());

            // Resize to 125x125
            $img125 = $imgManager->read($originalPath)->cover(100, 100);
            $savePath125 = public_path('uploads/games/' . $filename);
            $img125->save($savePath125);

            $filepath = 'uploads/games/'.$filename;

        }

        $name = $request->name;
        if($request->name == null){
            $name = $category->name;
        }

        $categoryGame = CategoryGame::create([
            'category_id' => $request->category_id,
            'game_id' => $request->game_id,
            'title' => $name,
            'feature_image' => $filepath,
            'currency_type' => $request->currency_type,
            'delivery_type' => $request->deliver_type,
        ]);

        // Filter all attribute fields
        $formatted = [];

        foreach ($request->all() as $key => $value) {
            if (preg_match('/^service_name_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $formatted[$serviceIndex]['service_name'] = $value;
            }

            if (preg_match('/^attribute_name_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['name'] = $value[0] ?? null;
            }

            if (preg_match('/^attribute_options_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['options'] = $value;
            }

            if (preg_match('/^attribute_cloned_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['cloned'] = $value[0];
            }

            if (preg_match('/^attribute_type_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['type'] = $value[0];
            }
        }

        // dd($formatted);

        foreach($formatted as $data) {
            if(isset($data['service_name'])){

                $service = Service::create([
                    'name' => $data['service_name'],
                    'category_game_id' => $categoryGame->id,
                ]);

                foreach($data as $key => $record) {
                    if($key != 'service_name'){

                        $attribute = Attribute::create([
                            'name' => $record['name'],
                            'options' => $record['options'],
                            'type' => $record['type'],
                            'cloned' => $record['cloned'],
                        ]);

                        $service->attributes()->attach($attribute->id);
                    }
                }
            }
            else {
                $key = 0;
                foreach($data as $record) {
                    if($record != null && $record['name'] != null){

                        $attribute = new Attribute;
                        $attribute->name = $record['name'];
                        $attribute->options = $record['options'];
                        $attribute->type = $record['type'];
                        $attribute->cloned = $record['cloned'];
                        if($key == 0 && $category->id == 3){
                            $attribute->topup = 1;
                        }

                        $attribute->save();                        

                        $categoryGame->attributes()->attach($attribute->id, ['visible' => 3]);
                        $key++;

                    }
                }
            }
        }
        
        return redirect()->back()->with('success', 'Item added successfully');
    }

    public function update_item(Request $request) { 
        // dd($request->all());

        $category = Category::find($request->category_id);
        $categoryGame = CategoryGame::findOrFail($request->category_game_id);

        $filepath = $categoryGame->feature_image;
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Generate unique filename
            $randomNumber = rand(1, 99999);
            $filename = time() . '.' . $randomNumber . '.' . $image->getClientOriginalExtension();

            // Original upload path
            $originalPath = public_path('uploads/games/' . $filename);
            $image->move(public_path('uploads/games'), $filename);

            // Initialize Intervention Image
            $imgManager = new ImageManager(new Driver());

            // Resize to 125x125
            $img125 = $imgManager->read($originalPath)->cover(100, 100);
            $savePath125 = public_path('uploads/games/' . $filename);
            $img125->save($savePath125);

            $filepath = 'uploads/games/'.$filename;

        }

        $name = $request->name;
        if($request->name == null){
            $name = $category->name;
        }

        
        $categoryGame->update([
            'game_id' => $request->game_id,
            'title' => $name,
            'feature_image' => $filepath,
            'currency_type' => $request->currency_type,
            'delivery_type' => $request->deliver_type,
        ]);

        // Filter all attribute fields
        $formatted = [];

        foreach ($request->all() as $key => $value) {
            if (preg_match('/^service_name_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $formatted[$serviceIndex]['service_name'] = $value;
            }

            if (preg_match('/^service_id_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $formatted[$serviceIndex]['service_id'] = $value;
            }

            if (preg_match('/^attribute_name_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['name'] = $value[0] ?? null;
            }

            if (preg_match('/^attribute_options_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['options'] = $value;
            }

            if (preg_match('/^attribute_cloned_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['cloned'] = $value[0];
            }

            if (preg_match('/^attribute_type_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['type'] = $value[0];
            }

            if (preg_match('/^attribute_id_(\d+)_(\d+)$/', $key, $match)) {
                $serviceIndex = $match[1];
                $attributeIndex = $match[2];
                $formatted[$serviceIndex][$attributeIndex]['id'] = $value[0];
            }
        }

        // dd($formatted);

        foreach($formatted as $data) {
            if(isset($data['service_name'])){

                if(isset($data['service_id'])){
                    $service = Service::findOrFail($data['service_id']);

                    $service->update([
                        'name' => $data['service_name'],
                    ]);
                }else {
                    $service = Service::create([
                        'name' => $data['service_name'],
                        'category_game_id' => $categoryGame->id,
                    ]);
                }

                foreach($data as $key => $record) {
                    if($key != 'service_name' && $key != 'service_id'){

                        if(isset($record['id'])){
                            $attribute = Attribute::where('id', $record['id'])->first();
                            $attribute->name = $record['name'];
                            $attribute->options = $record['options'];
                            $attribute->type = $record['type'];
                            $attribute->cloned = $record['cloned'];

                            $attribute->save(); 
                        }else {
                            $attribute = Attribute::create([
                                'name' => $record['name'],
                                'options' => $record['options'],
                                'type' => $record['type'],
                                'cloned' => $record['cloned'],
                            ]);
    
                            $service->attributes()->attach($attribute->id);
                        }
                    }
                }

                // Detach removed attribute relationships in bulk
                if (!empty($request->removed_attributes_ids)) {
                    $service->attributes()->detach($request->removed_attributes_ids);
                }

                // Delete multiple services in one go
                if (!empty($request->removed_services_ids)) {
                    Service::whereIn('id', $request->removed_services_ids)->delete();
                }
            }
            else {
                $key = 0;
                foreach($data as $record) {
                    if($record != null && $record['name'] != null){
                        if(isset($record['id'])){
                            $attribute = Attribute::where('id', $record['id'])->first();
                            $attribute->name = $record['name'];
                            $attribute->options = $record['options'];
                            $attribute->type = $record['type'];
                            $attribute->cloned = $record['cloned'];
                            if($key == 0 && $category->id == 3){
                                $attribute->topup = 1;
                            }

                            $attribute->save();                        
                        }else {
                            $attribute = new Attribute;
                            $attribute->name = $record['name'];
                            $attribute->options = $record['options'];
                            $attribute->type = $record['type'];
                            $attribute->cloned = $record['cloned'];
                            if($key == 0 && $category->id == 3){
                                $attribute->topup = 1;
                            }
                            $attribute->save();                        

                            $categoryGame->attributes()->attach($attribute->id, ['visible' => 3]);
                        }

                        $key++;

                    }
                }

                // Detach removed attribute relationships in bulk
                if (!empty($request->removed_attributes_ids)) {
                    $categoryGame->attributes()->detach($request->removed_attributes_ids);
                }
            }
        }
        
        return redirect()->back()->with('success', 'Item updated successfully');
    }

    public function orders(Request $request) {

        // dd($request->all());

        $orders = Order::with('categoryGame.game', 'categoryGame.category', 'buyer', 'seller');
        $games = Game::all();


        if($request->ajax()){

            $filterStatus = $request->filterStatus ?? null;
            $filterDuration = $request->filterDuration ?? null;
            $filterGames = $request->filterGames ?? null;
            $filterDate = $request->filterDate ?? null;

            if($filterStatus != null && $filterStatus != 'all') {

                if($filterStatus == 'received' || $filterStatus == 'completed' || $filterStatus == 'cancelled') {
                    $orders->where('order_status', $filterStatus);
                }
                elseif($filterStatus == 'disputed') {
                    $orders->where('disputed', '1')->whereIn('order_status', ['pending delivery', 'delivered']);
                }
                elseif($filterStatus == 'delivered' || $filterStatus == 'pending delivery') {
                    $orders->where('order_status', $filterStatus)->where('disputed', '0');
                }

            }

            if($filterGames != null && $filterGames != 'all') {
                $orders->wherehas('categoryGame', function($query) use ($filterGames){
                    $query->where('game_id', $filterGames);
                });
            }

            if($filterDuration != null && $filterDuration != 'recent') {
                $orders->where('created_at', '<', Carbon::now()->subMonths(3)->startOfDay());
            }else {
                $orders->where('created_at', '>=', Carbon::now()->subMonths(3)->startOfDay());
            }

            if($filterDate != null) {
                [$start, $end] = explode(' - ', $filterDate);
                $startDate = Carbon::createFromFormat('m/d/Y', trim($start))->startOfDay();
                $endDate = Carbon::createFromFormat('m/d/Y', trim($end))->endOfDay();

                $orders->whereBetween('created_at', [$startDate, $endDate]);
            }

            return DataTables::eloquent($orders)
            ->addColumn('title_data', function($order) {
                return '
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row mb-3">
                        <div class="text-theme-secondary fs-11 lh-1_3">order id: '.$order->order_id.'</div>
                    </div>
                    <div class="d-flex flex-row">
                        <img class="mr-3" style="width:36px;max-height:36px;" src="'.asset($order->categoryGame->game->image).'" alt="">
                        <div class="d-flex flex-column">
                            <div class="text-theme-secondary fs-13 lh-1_3">'.$order->categoryGame->game->name.'</div>
                            <div class="three-line-ellipsis fs-14 lh-1_3" style="max-width:225px;">'.$order->title.'</div>
                        </div>
                    </div>
                </div>
                ';
            })
            ->filterColumn('title_data', function($query, $keyword) {
                $query->where(function($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('order_id', 'like', "%{$keyword}%")
                    ;
                });
            })
            ->addColumn('buyer_data', function($order) {
                return '
                <a href="'.url('user-profile/'.$order->buyer->username.'?tab=Offers&category=Currency').'" target="_blank">'.$order->buyer->username.'</a>
                ';
            })
            ->addColumn('seller_data', function($order) {
                return '
                <a href="'.url('user-profile/'.$order->seller->username.'?tab=Offers&category=Currency').'" target="_blank">'.$order->seller->username.'</a>
                ';
            })
            ->filterColumn('buyer_seller', function($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->whereHas('buyer', function ($q2) use ($keyword) {
                        $q2->where('username', 'like', "%{$keyword}%");
                    })->orWhereHas('seller', function ($q3) use ($keyword) {
                        $q3->where('username', 'like', "%{$keyword}%");
                    });
                });
            })
            ->addColumn('created_at_data', function($order) {
                return Carbon::parse($order->created_at)->format('M d,Y, h:i A');
            })
            ->addColumn('price', function($order) {
                return '$'.number_format($order->total_price, 2);
            })
            ->addColumn('order_status', function($order) {
                if($order->order_status == 'completed') {
                    $order_pill_class = 'btn-theme-pill-green';
                    $order_status = $order->order_status;
                }
                elseif($order->order_status == 'received' || $order->order_status == 'delivered') 
                {
                    $order_pill_class = 'btn-theme-pill-blue';
                    $order_status = $order->order_status;
                }
                elseif($order->order_status == 'cancelled') 
                {
                    $order_pill_class = 'btn-theme-pill-red';
                    $order_status = $order->order_status;
                }
                elseif($order->disputed == 1) 
                {
                    $order_pill_class = 'btn-theme-pill-red';
                    $order_status = 'disputed';
                }
                elseif($order->order_status == 'pending delivery')
                {
                    $order_pill_class = 'btn-theme-pill-yellow';
                    $order_status = "Pending&nbsp;delivery";
                } 
                else
                {
                    $order_pill_class = 'btn-theme-pill-default';
                    $order_status = $order->order_status;
                }
                return '
                <span class="'.$order_pill_class.' br-6 p-1 text-capitalize" id="order-pill-'.$order->id.'">'.$order_status.'</span>
                ';
            })
            ->addColumn('quantity', function ($order) {
                return $order->quantity .' '. $order->categoryGame->currency_type;
            })
            ->addColumn('actions', function ($order) {
                return '<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                            Actions
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                    </g>
                                </svg>
                            </span>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 w-fit menu-state-bg-light-primary fw-bold fs-7 py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" onclick="change_order_status('.$order->id.', \'completed\')" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                    Mark as completed
                                </a>
                            </div>
                            <!--end::Menu item-->

                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" onclick="change_order_status('.$order->id.', \'cancelled\')" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                    Cancel order
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        ';
            })
            ->addColumn('mobile_summary', function ($order) {
                if($order->order_status == 'completed') {
                    $order_pill_class = 'btn-theme-pill-green';
                    $order_status = $order->order_status;
                }
                elseif($order->order_status == 'received' || $order->order_status == 'delivered') 
                {
                    $order_pill_class = 'btn-theme-pill-blue';
                    $order_status = $order->order_status;
                }
                elseif($order->order_status == 'cancelled') 
                {
                    $order_pill_class = 'btn-theme-pill-red';
                    $order_status = $order->order_status;
                }
                elseif($order->disputed == 1) 
                {
                    $order_pill_class = 'btn-theme-pill-red';
                    $order_status = 'disputed';
                }
                elseif($order->order_status == 'pending delivery')
                {
                    $order_pill_class = 'btn-theme-pill-yellow';
                    $order_status = "Pending&nbsp;delivery";
                } 
                else
                {
                    $order_pill_class = 'btn-theme-pill-default';
                    $order_status = $order->order_status;
                }
                return '
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center mb-2">
                        <img class="mr-3" style="width:36px;max-height:36px;" src="'.asset($order->categoryGame->game->image).'" alt="">
                        <div class="d-flex flex-column">
                            <div class="three-line-ellipsis fs-14 lh-1_3">'.$order->title.'</div>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="'.$order_pill_class.' br-6 px-1 py-0 text-capitalize">'.$order_status.'</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Type</div>
                        <div>'.$order->categoryGame->category->name.'</div>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Seller</div>
                        <a href="'.url('user-profile/'.$order->seller->username.'?tab=Offers&category=Currency').'" target="_blank">'.$order->seller->username.'</a>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Buyer</div>
                        <a href="'.url('user-profile/'.$order->buyer->username.'?tab=Offers&category=Currency').'" target="_blank">'.$order->buyer->username.'</a>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Ordered date</div>
                        <div>'.Carbon::parse($order->created_at)->format('M d,Y, h:i A').'</div>
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>Price($)</div>
                        <div>$'.$order->total_price.'</div>
                    </div>
                </div>
                ';
            })
            ->setRowAttr([
                'data-href' => function($order) {
                    return route('order-detail', $order->order_id); // Set URL here
                },
                'style' => 'cursor:pointer',
            ])
            ->rawColumns(['title_data', 'order_status', 'buyer_data', 'seller_data', 'actions', 'mobile_summary', 'row_url'])
            ->make(true);
        }

        $orders = $orders;
        $full_width = 1;

        return view('backend.orders', compact('orders', 'games','full_width'));
    }

    public function users(Request $request) {
        $users = User::with('seller');
        $games = Game::all();


        if($request->ajax()){

            $filterRole = $request->filterRole ?? null;
            $filterStatus = $request->filterStatus ?? null;
            $filterDate = $request->filterDate ?? null;

            if($filterRole != null && $filterRole != 'all') {
                if($filterRole == 'seller') {
                    $users->whereHas('seller')->where('role','!=','admin');
                }else {
                    $users = $users->where('role', $request->filterRole)->whereDoesntHave('seller');
                }
            }

            if($filterStatus != null && $filterStatus != 'all') {
                $users = $users->where('status', $request->filterStatus);
            }

            if($filterDate != null) {
                [$start, $end] = explode(' - ', $filterDate);
                $startDate = Carbon::createFromFormat('m/d/Y', trim($start))->startOfDay();
                $endDate = Carbon::createFromFormat('m/d/Y', trim($end))->endOfDay();

                $users->whereBetween('created_at', [$startDate, $endDate]);
            }

            return DataTables::eloquent($users)
            ->addColumn('title_data', function($user) {
                return '
                <div class="d-flex flex-row">
                    <img class="mr-3" style="width:36px;max-height:36px;" src="'.asset($user->profile).'" alt="">
                    <div class="d-flex flex-column">
                        <div class="text-theme-secondary fs-13 lh-1_3">'.$user->username.'</div>
                    </div>
                </div>
                ';
            })
            ->addColumn('role', function($user) {
                if($user->seller != null && $user->role != 'admin') {
                    $role = 'seller';
                }else {
                    $role = $user->role;
                }
                return $role;
            })
            ->addColumn('status', function($user) {
                return '<span id="user-status-'.$user->id.'">'.$user->status.'</span>';
            })
            ->addColumn('created_at_data', function($user) {
                return Carbon::parse($user->created_at)->format('M d,Y, h:i A');
            })
            
            ->addColumn('actions', function ($user) {
                return '<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                            Actions
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                    </g>
                                </svg>
                            </span>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 w-fit menu-state-bg-light-primary fw-bold fs-7 py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" onclick="ban_user('.$user->id.',\'banned\')" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                    Ban user
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" onclick="ban_user('.$user->id.',\'active\')" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                    Active user
                                </a>
                            </div>
                        </div>
                        <!--end::Menu-->
                        ';
            })
            ->setRowAttr([
                'data-href' => function($user) {
                    return url('user-profile/'.$user->username.'?tab=Offers&category=Currency'); // Set URL here
                },
                'style' => 'cursor:pointer',
            ])
            ->rawColumns(['title_data', 'role', 'status', 'actions'])
            ->make(true);
        }

        $users = $users;
        // $full_width = 1;

        return view('backend.users', compact('users', 'games'));
    }

    public function alerts(Request $request) {
        $notifications = auth()->user()->notifications()
            ->where('type', 'App\Notifications\OrderDisputedNotification')->get();

        return view('backend.alerts', compact('notifications'));
    }

    public function disputes(Request $request) {
        $disputes = Order::where('disputed', 1)->with('categoryGame.game', 'categoryGame.category', 'buyer', 'seller')->orderBy('dispute_won', 'asc');

        if($request->ajax()){
            $filterStatus = $request->filterStatus ?? null;
            $filterDate = $request->filterDate ?? null;

            if($filterStatus != null && $filterStatus != 'all') {
                $disputes = $disputes->where('dispute_won', null);
            }

            if($filterDate != null) {
                [$start, $end] = explode(' - ', $filterDate);
                $startDate = Carbon::createFromFormat('m/d/Y', trim($start))->startOfDay();
                $endDate = Carbon::createFromFormat('m/d/Y', trim($end))->endOfDay();

                $disputes->whereBetween('disputed_at', [$startDate, $endDate]);
            }

            return DataTables::eloquent($disputes)
            ->addColumn('title_data', function($dispute) {
                return '
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row mb-3">
                        <div class="text-theme-secondary fs-11 lh-1_3">order id: '.$dispute->order_id.'</div>
                    </div>
                    <div class="d-flex flex-row">
                        <img class="mr-3" style="width:36px;max-height:36px;" src="'.asset($dispute->categoryGame->game->image).'" alt="">
                        <div class="d-flex flex-column">
                            <div class="text-theme-secondary fs-13 lh-1_3">'.$dispute->categoryGame->game->name.'</div>
                            <div class="three-line-ellipsis fs-14 lh-1_3" style="max-width:225px;">'.$dispute->title.'</div>
                        </div>
                    </div>
                </div>
                ';
            })
            ->filterColumn('title_data', function($query, $keyword) {
                $query->where(function($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('order_id', 'like', "%{$keyword}%");
                })->orWhereHas('categoryGame.game', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('buyer_seller', function($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->whereHas('buyer', function ($q2) use ($keyword) {
                        $q2->where('username', 'like', "%{$keyword}%");
                    })->orWhereHas('seller', function ($q3) use ($keyword) {
                        $q3->where('username', 'like', "%{$keyword}%");
                    });
                });
            })
            ->addColumn('dispute_won_data', function($dispute) {
                if ($dispute->dispute_won == null) {
                    return '<span class="badge badge-light-warning">Pending</span>';
                } elseif($dispute->dispute_won == $dispute->seller_id) {
                    return '<span class="badge badge-light-primary">Seller</span>';
                }else {
                    return '<span class="badge badge-light-success">Buyer</span>';
                }
                
            })
            ->addColumn('disputed_at_data', function($dispute) {
                return Carbon::parse($dispute->disputed_at)->format('M d,Y, h:i A');
            })
            
            // ->addColumn('actions', function ($user) {
            //     return '<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
            //                 Actions
            //                 <span class="svg-icon svg-icon-5 m-0">
            //                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            //                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            //                             <polygon points="0 0 24 0 24 24 0 24"></polygon>
            //                             <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
            //                         </g>
            //                     </svg>
            //                 </span>
            //             </a>
            //             <!--begin::Menu-->
            //             <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 w-fit menu-state-bg-light-primary fw-bold fs-7 py-4" data-kt-menu="true">
            //                 <div class="menu-item px-3">
            //                     <a href="#" onclick="ban_user('.$user->id.',\'banned\')" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
            //                         Ban user
            //                     </a>
            //                 </div>
            //                 <div class="menu-item px-3">
            //                     <a href="#" onclick="ban_user('.$user->id.',\'active\')" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
            //                         Active user
            //                     </a>
            //                 </div>
            //             </div>
            //             <!--end::Menu-->
            //             ';
            // })
            ->setRowAttr([
                'data-href' => function($dispute) {
                    return url('order/'.$dispute->order_id); // Set URL here
                },
                'style' => 'cursor:pointer',
            ])
            ->rawColumns(['title_data', 'dispute_won_data', 'actions'])
            ->make(true);
        }

        return view('backend.disputes', compact('disputes'));
    }

    public function sellerRequests(Request $request) {
        $dataset = Seller::with('user');

        if($request->ajax()){
            $filterStatus = $request->filterStatus ?? null;
            $filterDate = $request->filterDate ?? null;

            if($filterStatus != null && $filterStatus != 'all') {
                $dataset = $dataset->where('verified', $filterStatus);
            }

            if($filterDate != null) {
                [$start, $end] = explode(' - ', $filterDate);
                $startDate = Carbon::createFromFormat('m/d/Y', trim($start))->startOfDay();
                $endDate = Carbon::createFromFormat('m/d/Y', trim($end))->endOfDay();

                $dataset->whereBetween('created_at', [$startDate, $endDate]);
            }

            return DataTables::eloquent($dataset)
            ->addColumn('title_data', function($data) {
                if($data->user->profile !== null){
                    $profile = '<img src="'.url('uploads/profile/thumbnails').'/'.$data->user->profile.'" class="br-40 mr-2" style="width:36px;height36px;">';
                } else {
                    $profile = strtoupper(substr($data->user->name,0,1));
                }

                return '
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center">
                        <a  href="'.url('user-profile'.auth()->user()->username).'?tab=Offers&category=Currency" target="_blank" id="dropdownMenu3" data-toggle="dropdown" data-bs-auto-close="false" aria-haspopup="true" aria-expanded="false" class="header__nav-link header__nav-link--more seller-avatar-header me-2 d-flex align-items-center justify-content-center rounded-circle text-white">
                            '.$profile.'
                        </a>
                        <div class="d-flex flex-column">
                            <div class="text-theme-secondary fs-13 lh-1_3">'. $data->user->username .'</div>
                            <div class="three-line-ellipsis fs-14 lh-1_3" style="max-width:225px;">'. $data->first_name .' '. $data->middle_name .' '. $data->last_name .'</div>
                        </div>
                    </div>
                </div>
                ';
            })
            ->filterColumn('title_data', function($query, $keyword) {
                $query->where(function($q) use ($keyword) {
                    $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('middle_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%");
                })->orWhereHas('user', function($q) use ($keyword) {
                    $q->where('username', 'like', "%{$keyword}%");
                });
            })
            // ->filterColumn('buyer_seller', function($query, $keyword) {
            //     $query->where(function ($q) use ($keyword) {
            //         $q->whereHas('buyer', function ($q2) use ($keyword) {
            //             $q2->where('username', 'like', "%{$keyword}%");
            //         })->orWhereHas('seller', function ($q3) use ($keyword) {
            //             $q3->where('username', 'like', "%{$keyword}%");
            //         });
            //     });
            // })
            ->addColumn('verified_data', function($data) {
                if ($data->verified == 0) {
                    return '<span class="badge badge-light-warning" id="user-status-'.$data->id.'">Pending</span>';
                } elseif($data->verified == 1) {
                    return '<span class="badge badge-light-success" id="user-status-'.$data->id.'">Verified</span>';
                } elseif($data->verified == 2) {
                    return '<span class="badge badge-light-danger" id="user-status-'.$data->id.'">Rejected</span>';
                } elseif($data->verified == 3) {
                    return '<span class="badge badge-light-danger" id="user-status-'.$data->id.'">Banned</span>';
                }
                
            })
            ->addColumn('created_at_data', function($data) {
                if($data->updated_at != null){
                    return Carbon::parse($data->updated_at)->format('M d,Y, h:i A');
                }else {
                    return Carbon::parse($data->created_at)->format('M d,Y, h:i A');
                }
            })
            ->orderColumn('created_at_data', function ($query, $order) {
                $query->orderByRaw('COALESCE(updated_at, created_at) ' . $order);
            })
            ->addColumn('actions', function ($data) {
                return '
                        <button class="btn btn-light-primary btn-sm show-details" data-id="'.$data->id.'">Details</button>
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                            Actions
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                    </g>
                                </svg>
                            </span>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 w-fit menu-state-bg-light-primary fw-bold fs-7 py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" onclick="change_seller_status('.$data->id.', 1)" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                    Verify Seller
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                Instead of onclick here show a modal and add reasons in it and show that reason to seller if not rejected
                                <a href="#" onclick="change_seller_status('.$data->id.', 2)" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                    Reject Seller
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" onclick="change_seller_status('.$data->id.', 3)" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                    Ban Seller
                                </a>
                            </div>
                        </div>
                        <!--end::Menu-->
                        ';
            })
            ->setRowAttr([
                'data-id' => function($data) {
                    return $data->id;
                },
                'class' => 'clickable-row',
                'style' => 'cursor: pointer',
            ])
            ->rawColumns(['title_data', 'verified_data', 'created_at_data', 'actions'])
            ->make(true);
        }

        return view('backend.seller_requests', compact('dataset'));
    }

    public function change_order_status(Request $request) {
        // dd($request->all());

        $order = Order::find($request->orderId);
        
        if ($request->orderStatus == 'cancelled') {
            $order->order_status = 'cancelled';
            $order->cancelation_reason = '0';
            $order->cancelation_details = 'Cancelled by Gamify';
            $order->cancelled_at = now();
        } elseif ($request->orderStatus == 'completed') {
            $order->order_status = 'completed';
        }

        $order->save();

        return $order;
    }

    public function change_user_status(Request $request) {
        // dd($request->all());

        $user = User::find($request->userId);
        
        $user->status = $request->userStatus;
        $user->save();

        return $user;
    }

    public function change_seller_status(Request $request) {
        // dd($request->all());

        $seller = Seller::find($request->sellerId);
        $seller->verified = $request->sellerStatus;
        $seller->save();

        if($request->sellerStatus == 3){
            $user = User::find($seller->user_id);
            
            $user->status = 'banned';
            $user->save();
        }

        if($request->sellerStatus == 1){
            $title_data = 'Now you are verfied as seller';
        } 
        elseif ($request->sellerStatus == 2)
        {
            $title_data = 'You are not verfied as seller';
        }

        $data = [
            'title' => $title_data,
            'data1' => '',
            'data2' => '',
            'link' => '#',
            'game_id' => 0,
        ];

        Notification::send($seller->user, new BoostingOfferNotification($data));

        return $seller;
    }
}
