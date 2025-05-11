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
    // echi is sending from main id but not receiving from other ids
});

Broadcast::channel('chat-creation-channel.{recieverId}', function ($user, $recieverId) {
    return (int) $user->id === (int) $recieverId;
    // echi is sending from main id but not receiving from other ids
});

Broadcast::channel('message-seen.{recieverId}', function ($user, $recieverId) {
    return (int) $user->id === (int) $recieverId;
    // echi is sending from main id but not receiving from other ids
});
