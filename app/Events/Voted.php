<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Voted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $votable;
    public $user;
    public $change;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($votable, $user, $change)
    {
        $this->votable = $votable;
        $this->user = $user;
        $this->change = $change;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
