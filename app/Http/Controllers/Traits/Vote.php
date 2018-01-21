<?php

namespace App\Http\Controllers\Traits;

use App\Events\Voted;

trait Vote
{
    public function upVote($key)
    {
        $votable = $this->retrieveModel($key);
        $change = auth()->user()->upVote($votable);
        $this->voted($votable, $change);
        return $this->voteResponse($votable, $change);
    }

    public function downVote($key)
    {
        $votable = $this->retrieveModel($key);
        $change = auth()->user()->downVote($votable);
        $this->voted($votable, $change);
        return $this->voteResponse($votable, $change);

    }

    public function cancelVote($key)
    {
        $votable = $this->retrieveModel($key);
        $change = auth()->user()->cancelVote($votable);
        $this->voted($votable, $change);
        return $this->voteResponse($votable, $change);
    }

    /**
     * 此方法可以自行覆盖
     */
    public function voted($votable, $change)
    {
        event(new Voted($votable, $this, $change));
    }

    public function voteResponse($votable, $change)
    {
        return response()->json([
            // todo 这里可以搞一个接口
            'up_count' => $votable->votes_count,
            'up_change' => $change['up_vote']
        ]);
    }
}
