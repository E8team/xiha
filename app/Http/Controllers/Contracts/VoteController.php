<?php

namespace App\Http\Controllers\Contracts;

interface VoteController
{
    public function upVote($key);

    public function downVote($key);

    public function cancelVote($key);

    public function voted($model);

    public function retrieveModel($key);
}
