<?php


namespace App\Models\Traits;

use App\Exceptions\NotVotable;

trait Vote
{
    public function upVote($votable)
    {
        $this->checkVotable($votable);
        $votable->upVote($this);
    }

    public function downVote($votable)
    {
        $this->checkVotable($votable);
        $votable->downVote($this);
    }

    protected function vote($votable, $type)
    {
        $this->checkVotable($votable);
        $votable->vote($this, $type);
    }

    public function cancelVote($votable)
    {
        $this->checkVotable($votable);
        $votable->cancelVote($this);
    }

    public function checkVotable($item)
    {
        if ($item instanceof \Illuminate\Database\Eloquent\Model && !method_exists($item, 'voters'))
            throw new NotVotable();
    }

    public function getVoteByVotable($votable)
    {
        if ($votable instanceof \App\Models\Vote) {
            $votable = $votable->id;
        }
        return $this->votable()->where('votable_id', $votable)->first();
    }

    public function votable()
    {
        return $this->belongsTo(\App\Models\Vote::class);
    }
}
