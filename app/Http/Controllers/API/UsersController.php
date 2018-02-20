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

    /**
     * 获取指定用户的信息
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user->loadMissing('avatar'));
    }

    /**
     * 获取指定用户发布的笑话
     * @param User $user
     * @return JokeCollection
     */
    public function jokes(User $user)
    {
        $jokes = Joke::byUser($user)->latest()->with('image')->paginate($this->perPage());
        return new JokeCollection($jokes);
    }
}
