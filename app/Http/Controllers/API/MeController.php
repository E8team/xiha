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

    /**
     * 获取当前登录者的信息
     * @return UserResource
     */
    public function show()
    {
        return new UserResource(auth()->user()->load('avatar'));
    }

    /**
     * 修改个人资料
     * @param MeRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
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

    /**
     * 获取未读消息的数量
     * @return array
     */
    public function showUnreadNotificationsCount()
    {
        return [
            'unread' => auth()->user()->unreadNotifications()->count()
        ];
    }

    /**
     * 获取消息通知
     * @return array
     */
    public function getNotifications()
    {
        return new NotificationCollection(auth()->user()->notifications);
    }

    /**
     * 将消息通知标记为已读
     * @return array
     */
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
