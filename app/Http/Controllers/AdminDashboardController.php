<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryGame;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Service;
use App\Models\Game;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManager;
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
        $categoryGames = CategoryGame::with('attributes','game')->where('category_id', $cat->id)->orderBy('id', 'desc');
        

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
            ->addColumn('attributes', function($game) {

                $html = '';

                foreach ($game->attributes as $key => $attribute) {
                    $options = implode('<br>', $attribute->options);

                    $html .= ($key !== 0 ? ' - ' : '');
                    $html .= '<span class="px-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="' . 
                                htmlspecialchars($options, ENT_QUOTES, 'UTF-8') . '">' . 
                                htmlspecialchars($attribute->name, ENT_QUOTES, 'UTF-8') . 
                            '</span>';
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
                        <div data-bs-toggle="modal" onclick="edit_game_modal_values(\'' . $game->feature_image . '\', \'' . $game->title . '\', \'' . $game->id . '\')" data-bs-target="#kt_modal_edit_game" class="menu-item px-3 float-end">
                            <span class="menu-link px-3">Edit</span>
                        </div>
                ';
            })
            ->rawColumns(['title_data', 'attributes', 'action_data'])
            ->make(true);
        }

        return view('backend.items', compact('categoryGames','category'));
    }

    public function add_item(Request $request) {
        $categories = Category::all();
        $games = Game::orderBy('name','asc')->get();
        $attributes = Attribute::where('cloned','0')->get();

        return view('backend.add_item', compact('categories', 'games', 'attributes'));
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
                $formatted[$serviceIndex][$attributeIndex]['cloned'] = $value;
            }
        }
        
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
                            'type' => 'select',
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
                        $attribute->type = 'select';
                        $attribute->cloned = $record['cloned'][0];
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

}
