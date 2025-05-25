<?php
use App\Models\Category;
use App\Models\Seller;
use App\Models\Item;
use App\Models\BuyerRequest;
use App\Models\Order;
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

if (!function_exists('timeToSec')) {
    function timeToSec(string $time): int
    {
        $map = [
            'min'  => 60,
            'h'    => 3600,
            'day'  => 86400,
            'days' => 86400,
        ];

        // Match patterns like "5 h", "2 days", etc.
        if (preg_match('/(\d+)\s*(min|h|day|days)/', strtolower($time), $matches)) {
            $value = (int) $matches[1];
            $unit = $matches[2];

            return $value * ($map[$unit] ?? 0);
        }

        return 0; // Fallback if format is invalid
    }
}


if (!function_exists('durationBreakdown')) {
    function durationBreakdown(int $seconds): array
    {
        $isNegative = $seconds < 0;
        $seconds = abs($seconds);

        $days = floor($seconds / 86400);
        $hours = floor(($seconds % 86400) / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        return [
            'negative' => $isNegative,
            'days' => $days,
            'hours' => $hours,
            'minutes' => $minutes,
            'seconds' => $secs,
        ];
    }
}

function countOrders($status, $orders) {
    $statusOrders = clone $orders;

    $conditions = [
        'pending delivery' => ['order_status' => 'pending delivery', 'disputed' => '0'],
        'delivered'        => ['order_status' => 'delivered', 'disputed' => '0'],
        'disputed'         => ['disputed' => '1'],
        'received'         => ['order_status' => 'received'],
        'completed'        => ['order_status' => 'completed'],
        'cancelled'        => ['order_status' => 'cancelled'],
    ];

    if (isset($conditions[$status])) {
        foreach ($conditions[$status] as $field => $value) {
            $statusOrders = $statusOrders->where($field, $value);
        }
        $statusOrders = $statusOrders->get();
    }

    return count($statusOrders);
}

function countOffers($offers, $status) {
    $offers = $offers->where('pause', $status);
    
    return $offers->count();
}

function getBuyerRequest($id) {
    return BuyerRequest::with([
        'service.categoryGame.category',
        'service.categoryGame.game',
    ])->find($id);
}