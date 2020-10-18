<?php

namespace App\Http\Controllers;

use App\Models\MessageTopic;
use App\Models\User;
use Illuminate\Http\Request;

class MessageTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = array(
            'topics' => MessageTopic::all(),
            'users' => User::all()
        );
        return view("topics.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessageTopic  $messageTopic
     * @return \Illuminate\Http\Response
     */
    public function show(MessageTopic $messageTopic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessageTopic  $messageTopic
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageTopic $messageTopic)
    {
        //
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
