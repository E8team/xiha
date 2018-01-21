<?php

namespace App\Http\Controllers\Traits;

use App\Events\Voted;

trait Vote
{
    public function upVote($key)
    {
        $votable = $this->retrieveModel($key);
        auth()->user()->upVote($votable);
        $this->voted($votable);
        return $this->voteResponse($votable);
    }

    public function downVote($key)
    {
        $votable = $this->retrieveModel($key);
        auth()->user()->downVote($votable);
        $this->voted($votable);
        return $this->voteResponse($votable);

    }

    public function cancelVote($key)
    {
        $votable = $this->retrieveModel($key);
        auth()->user()->cancelVote($votable);
        $this->voted($votable);
        return $this->voteResponse($votable);
    }

    /**
     * 此方法可以自行覆盖
     */
    public function voted($votable)
    {
        event(new Voted($votable, $this));
    }

    public function voteResponse($votable)
    {
        return response()->json([
            'up_count' => $votable->countUpVoters()
        ]);
    }
}
