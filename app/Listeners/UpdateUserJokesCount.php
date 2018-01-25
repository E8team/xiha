<?php

namespace App\Listeners;

use App\Events\CreatedJoke;

class UpdateUserJokesCount
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
     * 这个监听器监听了发送笑话事件 App\Events\CreatedJoke
     * @param  $event
     * @return void
     */
    public function handle(CreatedJoke $event)
    {
        // 将笑话作者的笑话数量字段+1
        $event->user->increment('jokes_count');
    }
}
