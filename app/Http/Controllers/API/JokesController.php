<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Http\Controllers\Contracts\VoteController;
use App\Http\Controllers\Traits\Vote;
use App\Http\Requests\JokeRequest;
use App\Http\Resources\JokeCollection;
use App\Http\Resources\JokeResource;
use App\Models\Joke;

class JokesController extends APIController implements VoteController
{
    use Vote;

    public function __construct()
    {
        $this->middleware('auth')->only('store', 'upVote', 'downVote', 'cancelVote');
    }

    public function index()
    {
        $jokes = Joke::latest()->with('image', 'user', 'user.avatar')->paginate($this->perPage());
        return new JokeCollection($jokes);
    }

    public function show(Joke $joke)
    {
        return new JokeResource($joke->load('user', 'user.avatar'));
    }

    public function store(JokeRequest $request)
    {
        $data = $request->validated();
        $data['content'] = isset($data['content']) ? e($data['content']) : '';
        $data['user_id'] = auth()->id();
        return new JokeResource(Joke::create($data)->load('image'));
    }


    public function retrieveModel($key)
    {
        return Joke::findOrFail($key);
    }
}
