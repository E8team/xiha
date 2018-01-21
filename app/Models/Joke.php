<?php

namespace App\Models;


use App\Models\Traits\CanBeVoted;

class Joke extends BaseModel
{
    use CanBeVoted;

    /**
     * 这个暂且放到这里
     * @var array
     */
    public $voteChanges = [
        'up_vote' => 0,
        'down_vote' => 0
    ];

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
