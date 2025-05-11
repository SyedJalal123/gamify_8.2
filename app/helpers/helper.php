<?php
use App\Models\Category;
use App\Models\Seller;
use Carbon\Carbon;

function categories(){
    $categories = Category::with('categoryGames.game')->get();
    return $categories;
}

function get_seller(){
    $seller = Seller::where('user_id', auth()->user()->id)->first();
    return $seller;
}


function shortTimeAgo($datetime) {
    $time = Carbon::parse($datetime);
    $now = Carbon::now();
    $diff = $time->diff($now);

    if ($diff->y >= 1) return $time->format('M d, Y');    // e.g., Mar 12, 2023
    if ($diff->m >= 1) return $time->format('M d');       // e.g., Mar 12
    if ($diff->d > 0) return $diff->d . 'd';
    if ($diff->h > 0) return $diff->h . 'h';
    if ($diff->i > 0) return $diff->i . 'm';
    return 'now';
}