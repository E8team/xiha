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
     *
     * @param  $event
     * @return void
     */
    public function handle(CreatedJoke $event)
    {
        $event->user->increment('jokes_count');
    }
}
