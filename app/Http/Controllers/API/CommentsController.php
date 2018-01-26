<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\APIController;
use App\Models\Comment;
use Ty666\LaravelVote\Contracts\VoteController;
use Ty666\LaravelVote\Traits\VoteControllerHelper;

class CommentsController extends APIController implements VoteController
{
    use VoteControllerHelper;

    protected $resourceClass = Comment::class;

    public function __construct()
    {
        $this->middleware('auth');
    }

}
