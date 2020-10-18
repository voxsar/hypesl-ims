<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\MessageTopic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\MessageTopic  $topic
     * @return \Illuminate\Http\Response
     */
    public function index(MessageTopic $topic)
    {
        //
        $ids = $topic->messages->sortByDesc('created_at')->take(20)->pluck('id');
        return Message::whereIn('id', $ids)->orderBy('created_at')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessageTopic  $topic
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MessageTopic $topic)
    {
        //
        $message = new Message();
        $message->message = $request->message_data;
        $message->messageable_id = $request->messageable_id;
        $message->messageable_type = $request->messageable_type;
        $message->message_topic_id = $topic->id;
        $message->save();
        $user = Auth::user();
        broadcast(new MessageSent($user, $message))->toOthers();
        return $message;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessageTopic  $topic
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(MessageTopic $topic, Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessageTopic  $topic
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageTopic $topic, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessageTopic  $topic
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageTopic $topic, Message $message)
    {
        //
    }
}
