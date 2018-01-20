<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Http\Controllers\Contracts\VoteController;
use App\Http\Controllers\Traits\Vote;
use App\Http\Requests\JokeRequest;
use App\Http\Resources\Joke;
use App\Models\Joke as JokeModel;

class JokesController extends APIController implements VoteController
{
    use Vote {
        voted as protected voted;
    }

    public function show(JokeModel $joke)
    {
        return new Joke($joke);
    }


    public function store(JokeRequest $request)
    {
        // JokeModel::create($request->validated());
    }

    public function retrieveModel($key)
    {
        return JokeModel::findOrFail($key);
    }
}
