<?php

namespace App\Providers;

use App\Events\Commented;
use App\Events\CreatedJoke;
use App\Listeners\UpdateUserCommentsCount;
use App\Listeners\UpdateUserJokesCount;
use Ty666\LaravelVote\Events\Voted;
use App\Listeners\UpdateUserVoteCount;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Voted::class => [
            UpdateUserVoteCount::class
        ],
        Commented::class => [
            UpdateUserCommentsCount::class
        ],
        CreatedJoke::class => [
            UpdateUserJokesCount::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

    }
}
