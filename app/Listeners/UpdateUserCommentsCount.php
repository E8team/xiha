<?php

namespace App\Listeners;

use App\Events\Commented;

class UpdateUserCommentsCount
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
     * 这个监听器监听了评论事件，App\Events\Commented
     * @param  $event
     * @return void
     */
    public function handle(Commented $event)
    {
        // 将被评论的笑话的 comments_count 字段 + 1
        $event->joke->increment('comments_count');
    }
}
