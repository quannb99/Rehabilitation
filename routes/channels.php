<?php

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

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

use Illuminate\Support\Facades\Auth;

Broadcast::channel('chat', function ($user) {
    return Auth::check();
});

Broadcast::channel('call', function ($user) {
    return true;
});

Broadcast::channel('call-response', function ($user) {
    return true;
});

Broadcast::channel('App.Models.User.{user}', function ($user) {
    return true;
});
