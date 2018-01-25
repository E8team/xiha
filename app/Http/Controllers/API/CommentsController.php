<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\APIController;
use App\Models\Vote;
use Ty666\LaravelVote\Contracts\VoteController;
use Ty666\LaravelVote\Traits\VoteControllerHelper;

class CommentsController extends APIController implements VoteController
{
    use VoteControllerHelper;

    protected $resourceClass = Vote::class;


}
