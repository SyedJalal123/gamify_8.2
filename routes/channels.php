<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-channel.{recieverId}', function ($user, $recieverId) {
    return (int) $user->id === (int) $recieverId;
});

Broadcast::channel('order-chat-channel.{conversationId}', function ($user, $conversationId) {
    return \App\Models\BuyerRequestConversation::where('id', $conversationId)->exists();
});

Broadcast::channel('chat-creation-channel.{recieverId}', function ($user, $recieverId) {
    return (int) $user->id === (int) $recieverId;
});

Broadcast::channel('message-seen.{recieverId}', function ($user, $recieverId) {
    return (int) $user->id === (int) $recieverId;
});

Broadcast::channel('order-page-update.{orderId}', function ($user, $orderId) {
    return \App\Models\Order::where('id', $orderId)->exists();
});

Broadcast::channel('group-service-sellers.{serviceId}', function ($user, $serviceId) {
    // Check if user belongs to the service
    return $user->services()->where('services.id', $serviceId)->exists();
});
