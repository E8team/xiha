<?php

namespace App\Listeners;


use App\Events\Voted;

class UpdateVoteCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle(Voted $event)
    {
        $upVoteChange = $event->change['up_vote'];
        if ($upVoteChange > 0) {
            $event->votable->increment('votes_count', $upVoteChange);
            $event->votable->user->increment('votes_count', $upVoteChange);
        } elseif ($upVoteChange < 0) {
            $event->votable->decrement('votes_count', abs($upVoteChange));
            $event->votable->user->decrement('votes_count', abs($upVoteChange));
        }
    }
}
