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
        $this->middleware('auth')->only('store');
    }

    public function index()
    {
        $jokes = Joke::latest()->paginate($this->perPage());
        return new JokeCollection($jokes->load('image','user'));
    }

    public function show(Joke $joke)
    {
        return new JokeResource($joke);
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
