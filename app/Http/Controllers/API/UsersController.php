<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Http\Resources\JokeCollection;
use App\Http\Resources\JokeResource;
use App\Http\Resources\UserResource;
use App\Models\Joke;
use App\Models\User;


class UsersController extends APIController
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function show(User $user)
    {
        return new UserResource($user->load('avatar'));
    }

    public function jokes(User $user)
    {
        $jokes = Joke::byUser($user)->latest()->paginate($this->perPage());
        return new JokeCollection($jokes->load('image'));
    }
}
