<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Http\Requests\MeRequest;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
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

    public function getNotifications()
    {
        return new NotificationCollection(auth()->user()->notifications);
    }

    public function markAsRead($id = null)
    {
        // 如果 id 为 null，表示将全部消息标记为已读
        $notifications = auth()->user()->unreadNotifications();

        if ($id)
            $notifications->where('id', $id);

        $notifications->update(['read_at' => Carbon::now()]);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
