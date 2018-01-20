<?php

namespace App\Models\Traits;

trait CanBeVoted
{
    /**
     * Check if user is voted by given user.
     *
     * @param $user
     *
     * @return bool
     */
    public function isVotedBy($user)
    {
        //todo 这里貌似把所有的投票者都要查询出来
        return $this->voters->contains($user);
    }

    /**
     * Count the number of up votes.
     *
     * @return int
     */
    public function countUpVoters()
    {
        return $this->countVoters('up_vote');
    }

    /**
     * Count the number of down votes.
     *
     * @return int
     */
    public function countDownVoters()
    {
        return $this->countVoters('down_vote');
    }

    /**
     * Count the number of voters.
     *
     * @param  string $type
     *
     * @return int
     */
    public function countVoters($type = null)
    {
        $voters = $this->voters();

        if(!is_null($type)) $voters->where('type', $type);

        return $voters->count();
    }

    /**
     * Return voters.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function voters()
    {
        $property = property_exists($this, 'vote') ? $this->vote : __CLASS__;

        return $this->morphMany($property, 'votable', 'votes');
    }
}
