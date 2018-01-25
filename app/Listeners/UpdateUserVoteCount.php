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
     * 这个监听器监听了投票事件 Ty666\LaravelVote\Events\Voted
     * @param  $event
     * @return void
     */
    public function handle(Voted $event)
    {
        // 赞(up_vote)的变化值，例如：赞同(up_vote)的话此值为正1，反对的话（down_vote）的话此值为负1，等等。
        $upVoteChange = $event->getChange()['up_vote'];
        if ($upVoteChange > 0) {
            $event->getTargetModel()->user()->increment('up_votes_count', $upVoteChange);
        } elseif ($upVoteChange < 0) {
            $event->getTargetModel()->user()->where('up_votes_count', '>', 0)->decrement('up_votes_count', abs($upVoteChange));
        }
    }
}
