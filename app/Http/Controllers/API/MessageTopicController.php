<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Http\Controllers\Controller;
use App\Events\TopicCreated;
use App\Models\MessageTopic;
use App\Models\MessageTopicable;
use Illuminate\Http\Request;
use App\Http\Requests\RequestMessageTopic;

class MessageTopicController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->has("keyword") || $request->keyword != ""){
            $ids = MessageTopic::search($request->keyword)->get()->pluck('id');
            return MessageTopic::whereIn('id', $ids)->orderBy('created_at')->get();
        }else{
            return MessageTopic::orderBy('created_at')->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestMessageTopic $request)
    {
        //
        $messageTopic = new MessageTopic();
        $messageTopic->name = $request->topic;
        $messageTopic->type = $request->type;
        $messageTopic->is_confidential = $request->is_confidential;
        $messageTopic->status = $request->status;
        if($messageTopic->save()){
            $messageTopicUser = new MessageTopicable();
            $messageTopicUser->messagetopicable_id = Auth::id();
            $messageTopicUser->messagetopicable_type = 'App\Models\User';
            $messageTopicUser->message_topic_id = $messageTopic->id;
            $messageTopicUser->save();
            if($request->has('participants') && is_array($request->participants)){
                foreach ($request->participants as $participant) {
                    # code...
                    $messageTopicUser = new MessageTopicable();
                    $messageTopicUser->messagetopicable_id = $participant;
                    $messageTopicUser->messagetopicable_type = 'App\Models\User';
                    $messageTopicUser->message_topic_id = $messageTopic->id;
                    $messageTopicUser->save();
                }
            }
        }
        broadcast(new TopicCreated($messageTopic))->toOthers();
        return $messageTopic;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessageTopic  $message
     * @return \Illuminate\Http\Response
     */
    public function show(MessageTopic $topic)
    {
        //
        return $topic->load('users');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessageTopic  $messageTopic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageTopic $messageTopic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessageTopic  $messageTopic
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageTopic $messageTopic)
    {
        //
    }
}
