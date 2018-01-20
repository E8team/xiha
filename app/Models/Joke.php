<?php

namespace App\Models;



use App\Models\Traits\CanBeVoted;

class Joke extends BaseModel
{
    use CanBeVoted;
}
