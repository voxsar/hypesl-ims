<?php

use App\Models\MessageTopic;
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

Broadcast::channel('topics.{messageTopic}.users', function ($user, MessageTopic $messageTopic) {
	//$messageTopic = MessageTopic::find($messageTopic);
	return $messageTopic->users->has($user->id);
});

Broadcast::channel('topics.{messageTopic}.contacts', function ($user, MessageTopic $messageTopic) {
	//$messageTopic = MessageTopic::find($messageTopic);
	return $messageTopic->contacts->has($user->id);
});

Broadcast::channel('topics.users.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('topics.contacts.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});