<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Http\Resources\UserResource;


class MeController extends APIController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return new UserResource(auth()->user()->load('avatar'));
    }
}
