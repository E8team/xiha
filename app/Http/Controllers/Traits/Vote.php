<?php

namespace App\Http\Controllers\Traits;

use App\Events\Voted;

trait Vote
{
    public function upVote($key)
    {
        $model = $this->retrieveModel($key);
        auth()->user()->upVote($model);
        $this->voted($model);
        return $this->voteResponse($model);
    }

    public function downVote($key)
    {
        $model = $this->retrieveModel($key);
        auth()->user()->upVote($model);
        $this->voted($model);
        return $this->voteResponse($model);

    }

    public function cancelVote($key)
    {
        $model = $this->retrieveModel($key);
        auth()->user()->upVote($model);
        $this->voted($model);
        return $this->voteResponse($model);
    }

    /**
     * 此方法可以自行覆盖
     */
    public function voted($model)
    {
        event(new Voted($model, $this));
    }

    public function voteResponse($model)
    {
        return response()->json([
            'up_count' => $model->countUpVoters()
        ]);
    }
}
