<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Game;
use App\Models\Attribute;
use App\Models\ItemAttribute;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $item = Item::with(['game', 'seller', 'attributes'])->findOrFail($request->item_id);
        $quantity = max(1, (int) $request->quantity);
        $price = $item->price * $quantity;

        return view('frontend.checkout', compact('item', 'quantity', 'price'));
    }
    public function checkout(Request $request)
    {
        $item = Item::with(['attributes', 'game', 'category'])->findOrFail($request->item_id);
        $quantity = $request->quantity ?? null;

        return view('frontend.checkout', compact('item', 'quantity'));
    }
}
