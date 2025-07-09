<?php
use App\Models\Category;
use App\Models\Seller;
use App\Models\Item;
use App\Models\Game;
use App\Models\BuyerRequest;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;


function get_user($id) {
    $data = User::find($id);

    return $data;
}

function get_order($order_id) {
    $data = Order::where('order_id',$order_id)->first();

    return $data;
}

function parseDeliveryTime($str) {
    $str = strtolower(trim($str));

    if (str_contains($str, 'instant')) return 0;

    if (preg_match('/(\d+)\s*min/', $str, $m)) return (int)$m[1];
    if (preg_match('/(\d+)\s*h/', $str, $m)) return (int)$m[1] * 60;
    if (preg_match('/(\d+)\s*day/', $str, $m)) return (int)$m[1] * 1440;
    
    return null; // unknown format
}

function getAverageDeliveryTime($item_id) {
    $orders = Order::with('item') // load item for delivery_time
        ->where('item_id', $item_id)
        ->where('order_status', 'completed')
        ->whereNotNull('delivered_at')
        ->get();

    if ($orders->isEmpty()) return 0;

    $totalDelay = 0;
    $count = 0;

    foreach ($orders as $order) {
        $item = $order->item;
        $deliveryTimeStr = null;

        if ($order->item && $order->item->delivery_time) {
            $deliveryTimeStr = $order->item->delivery_time;
        } elseif ($order->offer && $order->offer->delivery_time) {
            $deliveryTimeStr = $order->offer->delivery_time;
        }

        if (!$deliveryTimeStr) continue;

        // Parse expected delivery time string like "1 h", "20 min", "1 day"    
        $expectedMinutes = parseDeliveryTime($deliveryTimeStr);
        if ($expectedMinutes === null) continue;

        // $actualMinutes = $order->created_at->diffInMinutes($order->delivered_at);
        $actualMinutes = Carbon::parse($order->created_at)->diffInMinutes(Carbon::parse($order->delivered_at));

        $delay = max(0, $actualMinutes - $expectedMinutes);
        

        $totalDelay += $delay;
        $count++;
    }

    return $count > 0 ? round($totalDelay / $count) : 0;
}



function computeTrustScore($stats)
{
    $feedback       = $stats['feedback'];
    $feedbackCount  = $stats['feedback_count'];
    $completed      = $stats['completed'];
    $delivery       = $stats['delivery']; // fallback high value

    $completedWeight = $completed >= 20 ? 15 : 10;

    return 
        ($feedback * 2) +            // Trust (max 200)
        ($completed * $completedWeight) -  // Reward experience more
        ($delivery * 0.4);           // Penalize slow delivery, but gently
}

function isBetter($current, $existing)
{
    // dd(computeTrustScore($existing));
    return computeTrustScore($current) > computeTrustScore($existing);
}


function seller_data($id) {
    $seller = Seller::with('user')->first();

    return $seller;
}

function pending_seller_requests() {
    $sellers = Seller::where('verified', 0)->get();
    return $sellers;
}

function pending_disputes() {
    $disputes = Order::where('dispute_won', null)->where('disputed', 1)->get();
    return $disputes;
}

function count_admin_unread_noti() {
    $nofications = auth()->user()->unreadnotifications()->where('type', 'App\Notifications\OrderDisputedNotification')->get();
    return count($nofications);
}

function count_user_unread_noti() {
    $nofications = auth()->user()->unreadNotifications()
        ->whereIn('type', [
            'App\Notifications\BoostingRequestNotification',
            'App\Notifications\BoostingOfferNotification',
            'App\Notifications\UserOrderDisputedNotification',
        ])
        ->get();
    return count($nofications);
}

function get_user_unread_noti() {
    $nofications = auth()->user()->unreadNotifications()
        ->whereIn('type', [
            'App\Notifications\BoostingRequestNotification',
            'App\Notifications\BoostingOfferNotification',
            'App\Notifications\UserOrderDisputedNotification',
        ])
        ->get();
    return $nofications;
}

function count_user_offer($category_id, $user) {
    $items = Item::where('seller_id', $user->id)
            ->whereHas('categoryGame', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
        ->get();

    return count($items);
}

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
        'disputed'         => ['disputed' => '1', 'order_status' => ['pending delivery', 'delivered']],
        'received'         => ['order_status' => 'received'],
        'completed'        => ['order_status' => 'completed'],
        'cancelled'        => ['order_status' => 'cancelled'],
    ];

    if (isset($conditions[$status])) {
        foreach ($conditions[$status] as $field => $value) {
            if (is_array($value)) {
                $statusOrders = $statusOrders->whereIn($field, $value);
            } else {
                $statusOrders = $statusOrders->where($field, $value);
            }
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

function getOrder($id) {
    return Order::where('order_id', $id)->with('categoryGame.category', 'categoryGame.game')->first();
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
                            $q->where('seller_id', $userId);
                                // ->orWhere('buyer_id', $userId);
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
                            $q->where('seller_id', $userId);
                                // ->orWhere('buyer_id', $userId);
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
                            $q->where('seller_id', $userId);
                                // ->orWhere('buyer_id', $userId);
                        });
                })
                ->orderBy('feedback_at', 'desc')
        ->get();

        $negativeOrders = Order::with('buyer','seller','categoryGame.category')
                ->where(function ($query) use ($userId) {
                    $query->where('feedback', 2)
                        ->where(function ($q) use ($userId) {
                            $q->where('seller_id', $userId);
                                // ->orWhere('buyer_id', $userId);
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

