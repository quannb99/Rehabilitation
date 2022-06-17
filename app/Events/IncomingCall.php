<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IncomingCall implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $user;
    public $otherUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, User $otherUser)
    {
        $this->user = $user;
        $this->otherUser = $otherUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('call');
    }
}
