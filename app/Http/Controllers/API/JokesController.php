<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Http\Controllers\Contracts\VoteController;
use App\Http\Resources\Joke;
use App\Models\Joke as JokeModel;
use App\Models\Traits\Vote;

class JokesController extends APIController implements VoteController
{
    use Vote;

    public function show(JokeModel $joke)
    {
        return new Joke($joke);
    }

    public function retrieveModel($key)
    {
        return Joke::findOrFail($key);
    }

}
