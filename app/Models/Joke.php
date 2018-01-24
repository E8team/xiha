<?php

namespace App\Models;


use Ty666\LaravelVote\Contracts\CanCountUpVotesModel;
use Ty666\LaravelVote\Traits\CanBeVoted;
use Ty666\LaravelVote\Traits\CanCountUpVotes;

class Joke extends BaseModel implements CanCountUpVotesModel
{
    use CanBeVoted, CanCountUpVotes;

    protected $upVotesCountField = 'up_votes_count';

    protected $fillable = ['user_id', 'image_hash', 'content'];

    public function image()
    {
        return $this->hasOne(Image::class, 'hash', 'image_hash');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByUser($query, $user)
    {
        if ($user instanceof User)
            $user = $user->id;
        $query->where('user_id', $user);
    }
}
