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
        if ($event->votable->voteChanges['up_vote'] != 0) {

        }
    }
}
