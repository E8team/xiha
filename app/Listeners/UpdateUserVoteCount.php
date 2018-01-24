<?php

namespace App\Listeners;

use Ty666\LaravelVote\Events\Voted;

class UpdateUserVoteCount
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
        $upVoteChange = $event->getChange()['up_vote'];
        if ($upVoteChange > 0) {
            $event->getUser()->increment('votes_count', $upVoteChange);
        } elseif ($upVoteChange < 0) {
            $event->getUser()->decrement('votes_count', abs($upVoteChange));
        }
    }
}
