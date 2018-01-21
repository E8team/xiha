<?php


namespace App\Models\Traits;

use App\Exceptions\NotVotable;

trait Vote
{
    public function upVote($item)
    {
        $this->checkVoteItem($item);
        $item->upVote($this);
    }

    public function downVote($item)
    {
        $this->checkVoteItem($item);
        $item->downVote($this);
    }

    protected function vote($item, $type)
    {
        $this->checkVoteItem($item);
        $item->vote($this, $type);
    }

    public function cancelVote($item)
    {
        $this->checkVoteItem($item);
        $item->cancelVote($this);
    }

    public function checkVoteItem($item)
    {
        if ($item instanceof \Illuminate\Database\Eloquent\Model && !method_exists($item, 'voters'))
            throw new NotVotable();
    }
}
