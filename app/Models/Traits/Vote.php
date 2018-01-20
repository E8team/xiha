<?php


namespace App\Models\Traits;

use App\Exceptions\NotVotable;

trait Vote
{
    public function upVote($item)
    {
        $this->vote($item, 'up_vote');
    }

    public function downVote($item)
    {
        $this->vote($item, 'down_vote');
    }

    protected function vote($item, $type)
    {
        $this->checkVoteItem($item);
        $this->cancelVote($item);
        $item->voters()->create(['user_id' => $this->id, 'type' => $type]);
    }

    public function cancelVote($item)
    {
        $queryBuilder = $item->voters()->where('user_id', $this->id);
        if ($queryBuilder->count() > 0) {
            $queryBuilder->delete();
        }
    }

    public function checkVoteItem($item)
    {
        if ($item instanceof \Illuminate\Database\Eloquent\Model && method_exists($item, 'voters'))
            throw new NotVotable();
    }
}
