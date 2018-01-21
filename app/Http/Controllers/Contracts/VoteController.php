<?php

namespace App\Http\Controllers\Contracts;

interface VoteController
{
    public function upVote($key);

    public function downVote($key);

    public function cancelVote($key);

    public function voted($votable, $change);

    public function retrieveModel($key);
}
