<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Http\Requests\MeRequest;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;


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

    public function update(MeRequest $request)
    {
        $data = array_filter($request->validated(), function ($item) {
            return !empty($item);
        });
        if (isset($data['name']))
            $data['name'] = e($data['name']);
        if (isset($data['introduce']))
            $data['introduce'] = e($data['introduce']);

        auth()->user()->update($data);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
