<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\Joke;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreatedJoke
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $joke;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Joke $joke, User $user)
    {
        $this->joke = $joke;
        $this->user = $user;
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
