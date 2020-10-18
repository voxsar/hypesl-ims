<?php

namespace App\Events;

use App\Models\MessageTopic;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TopicCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Message details
     *
     * @var Message
     */
    public $messagetopic;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MessageTopic $messagetopic)
    {
        $this->messagetopic = $messagetopic;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];

        foreach ($this->messagetopic->users as $user) {
            array_push($channels, new PrivateChannel('topics.users.' . $user->id));
        }

        foreach ($this->messagetopic->contacts as $contact) {
            array_push($channels, new PrivateChannel('topics.contacts.' . $contact->id));
        }

        return $channels;
    }
}
