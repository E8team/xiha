<?php

namespace App\Http\Controllers\Contracts;

interface VoteController
{
    public function upVote($key);
    public function downVote($key);
    public function retrieveModel($key);
}
