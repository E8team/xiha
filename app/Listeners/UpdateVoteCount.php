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
        $upVoteChange = $event->votable->voteChanges['up_vote'];
        if ($upVoteChange > 0) {
            $event->votable->increment('votes', $upVoteChange);
            $event->votable->user->increment('votes', $upVoteChange);
        } elseif ($upVoteChange < 0) {
            $event->votable->decrement('votes', abs($upVoteChange));
            $event->votable->user->decrement('votes', abs($upVoteChange));
        }
    }
}
