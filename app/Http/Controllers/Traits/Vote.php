<?php

namespace App\Models\Traits;

trait Vote
{
    public function upVote($key)
    {
        $model = $this->retrieveModel($key);
        auth()->user()->upVote($model);
        return $this->voteResponse($model);
    }

    public function downVote($key)
    {
        $model = $this->retrieveModel($key);
        auth()->user()->upVote($model);
        return $this->voteResponse($model);

    }

    public function cancelVote($key)
    {
        $model = $this->retrieveModel($key);
        auth()->user()->upVote($model);
        return $this->voteResponse($model);
    }

    /**
     * 此方法可以自行覆盖
     */
    public function voteResponse($model)
    {
        return response()->json([
            'up_count' => $model->countUpVoters()
        ]);
    }
}
