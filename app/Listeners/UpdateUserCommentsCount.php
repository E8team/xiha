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
     *
     * @param  $event
     * @return void
     */
    public function handle(Commented $event)
    {
        $event->joke->increment('comments_count');
    }
}
