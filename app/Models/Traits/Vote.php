<?php


namespace App\Models\Traits;

use App\Exceptions\NotVotable;

trait Vote
{
    public function upVote($votable)
    {
        $this->checkVotable($votable);
        return $votable->upVote($this);
    }

    public function downVote($votable)
    {
        $this->checkVotable($votable);
        return $votable->downVote($this);
    }

    protected function vote($votable, $type)
    {
        $this->checkVotable($votable);
        return $votable->vote($this, $type);
    }

    public function cancelVote($votable)
    {
        $this->checkVotable($votable);
        return $votable->cancelVote($this);
    }

    public function checkVotable($item)
    {
        if ($item instanceof \Illuminate\Database\Eloquent\Model && !method_exists($item, 'voters'))
            throw new NotVotable();
    }

    public function getVoteByVotable($votable)
    {
        // todo 这里需要改一下
        return \App\Models\Vote::where('user_id', $this->id)->where('votable_id', $votable->id)->first();
        // return $this->votable()->where('votable_id', $votable->id)->first();
    }

    public function votable()
    {
        return $this->belongsTo(\App\Models\Vote::class);
    }
}
