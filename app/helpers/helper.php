<?php
use App\Models\Category;
use App\Models\Seller;
use App\Models\Item;
use App\Models\Game;
use App\Models\BuyerRequest;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

function generateUniqueGamifyUsername(): string
{
    $prefixes = [
        'Neo', 'Dark', 'Fast', 'Hyper', 'Cool', 'Zero', 'Ultra', 'Blue', 'Fire', 'Cloud', 'Nova', 'Bright', 'Alpha', 'Beta', 'Quick', 'Sky', 'Steel', 'Shadow', 'Lunar', 'Crimson',
        'Jet', 'Silver', 'Iron', 'Flame', 'Lucky', 'Icy', 'Turbo', 'Glow', 'Solar', 'Tech', 'Game', 'Air', 'Echo', 'Pixel', 'Mono', 'Cosmic', 'Epic', 'Digital', 'Rogue', 'Swift',
        'True', 'Golden', 'Electric', 'Free', 'Magic', 'Flex', 'Virtual', 'Next', 'Smart', 'Top', 'Rush', 'Volt', 'Flick', 'Auto', 'Rapid', 'Ultra', 'Flash', 'Spin', 'Mystic', 'Legend',
        'Dream', 'Nova', 'Chill', 'Cyber', 'Bold', 'Frozen', 'Cloudy', 'Zen', 'Quantum', 'Core', 'AlphaX', 'Dash', 'Clean', 'SteelX', 'Orbit', 'SkyX', 'NextX', 'Byte', 'DarkX', 'Vortex', 'FireX',
        'Max', 'Blitz', 'Code', 'Logic', 'Node', 'AI', 'Xeno', 'Rhino', 'Prime', 'Meta', 'Holo', 'Mode', 'Beam', 'Grid', 'Hack', 'Pulse', 'Ghost', 'IronX', 'Skyline', 'Drift'
    ];

    $suffixes = [
        'Byte', 'Runner', 'Crush', 'Blast', 'Knight', 'Zone', 'Edge', 'Dash', 'Ghost', 'Jet', 'Boss', 'Spark', 'Trek', 'Wolf', 'Fire', 'Hero', 'Gear', 'Shift', 'Wave', 'Rider',
        'Storm', 'Drive', 'Vibe', 'Champ', 'Drop', 'Loop', 'EdgeX', 'Hunter', 'Breaker', 'Tune', 'Beat', 'Core', 'Stack', 'Ninja', 'Track', 'King', 'Flow', 'Flash', 'Rock', 'Tune',
        'Grid', 'Lock', 'Path', 'Rise', 'Sonic', 'BlastX', 'Power', 'Hack', 'FlowX', 'ZoneX', 'Hop', 'Jump', 'Boost', 'Tank', 'Forge', 'Glitch', 'Kick', 'Code', 'TuneX', 'ByteX',
        'Skill', 'Rush', 'Echo', 'Ping', 'Warp', 'Sync', 'Hype', 'Unit', 'Aim', 'Seek', 'Shot', 'DropX', 'Jolt', 'Zoom', 'Mode', 'Vault', 'Mind', 'Clash', 'Hit', 'Boom', 'LoopX',
        'Ace', 'Line', 'TuneZ', 'TrackX', 'Crash', 'ZoomX', 'Lift', 'Tide', 'Glide', 'Limit', 'Run', 'Craft', 'DriveX', 'SparkX', 'Raid', 'Beam', 'Node', 'CodeX', 'Trail', 'ZoneZ'
    ];

    do {
        $username = $prefixes[array_rand($prefixes)]
                  . $suffixes[array_rand($suffixes)]
                  . rand(100, 9999); // optional: use UUID instead of rand for scale
    } while (User::where('username', $username)->exists());

    return $username;
}

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

function countOffers($category, $status) {

    $offers = Item::where('seller_id', auth()->id())->with('categoryGame.attributes', 'categoryGame.game')->where('pause', $status)->whereHas('categoryGame', function ($query) use  ($category){
            return $query->where('category_id', $category->id);
        })->orderBy('created_at', 'desc');

    // $offers = $offers->where('pause', $status);
    
    return $offers->count();
}

function getBuyerRequest($id) {
    return BuyerRequest::with([
        'service.categoryGame.category',
        'service.categoryGame.game',
    ])->find($id);
}

function getGames() {
    return Game::all();
}

function getGame($id) {
    return Game::find($id);
}

function userCompletedOrders($userId) {
    $orders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) use ($userId) {
                    $query->where('order_status', 'completed')
                        ->where(function ($q) use ($userId) {
                            $q->where('seller_id', $userId);
                        });
                })
                ->orderBy('feedback_at', 'desc')
                ->get();

    return $orders;
}

function userPositiveFeebacks($userId) {
    $orders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) use ($userId) {
                    $query->where('feedback', 1)
                        ->where(function ($q) use ($userId) {
                            $q->where('buyer_id', $userId)
                                ->orWhere('seller_id', $userId);
                        });
                })
                ->orderBy('feedback_at', 'desc')
                ->get();

    return $orders;
}

function userNegativeFeebacks($userId) {
    $orders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) use ($userId) {
                    $query->where('feedback', 2)
                        ->where(function ($q) use ($userId) {
                            $q->where('buyer_id', $userId)
                                ->orWhere('seller_id', $userId);
                        });
                })
                ->orderBy('feedback_at', 'desc')
                ->get();

    return $orders;
}

function userFeedbackScore($userId) {
        $positiveOrders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) use ($userId) {
                    $query->where('feedback', 1)
                        ->where(function ($q) use ($userId) {
                            $q->where('buyer_id', $userId)
                                ->orWhere('seller_id', $userId);
                        });
                })
                ->orderBy('feedback_at', 'desc')
        ->get();

        $negativeOrders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) use ($userId) {
                    $query->where('feedback', 2)
                        ->where(function ($q) use ($userId) {
                            $q->where('buyer_id', $userId)
                                ->orWhere('seller_id', $userId);
                        });
                })
                ->orderBy('feedback_at', 'desc')
        ->get();

        $positive = count($positiveOrders);
        $negative = count($negativeOrders);

        $total = $positive + $negative;

        if ($total > 0) {
            $percentage = ($positive / $total) * 100;
            return round($percentage, 2); // Outputs: 90.91%
        } else {
            return 0;
        }
}

