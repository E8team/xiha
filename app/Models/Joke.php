<?php

namespace App\Models;


use App\Models\Traits\CanBeVoted;

class Joke extends BaseModel
{
    use CanBeVoted;

    protected $fillable = ['user_id', 'image', 'content'];

    public function image()
    {
        return $this->hasOne(Image::class, 'hash', 'image');
    }
}
