<?php

namespace App\Models\Traits;

trait CanBeVoted
{
    public $voteChanges = [
        'up_vote' => 0,
        'down_vote' => 0
    ];

    public function upVote($user)
    {
        $this->vote($user, 'up_vote');
    }

    public function downVote($user)
    {
        $this->vote($user, 'down_vote');
    }

    protected function vote($user, $type)
    {
        $this->cancelVote($user);
        $this->voters()->create(['user_id' => $user->id, 'type' => $type]);
        $this->voteChanges[$type]++;
    }

    public function cancelVote($item)
    {
        $vote = $this->voters()->select('id', 'type')->where('user_id', $this->id)->first();
        if (!is_null($vote)) {
            $item->voteChanges[$vote->type]--;
            $vote->delete();
        }
    }


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

        if (!is_null($type)) $voters->where('type', $type);

        return $voters->count();
    }

    /**
     * Return voters.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function voters()
    {
        return $this->morphMany(\App\Models\Vote::class, 'votable');
    }
}
