<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\Resource;

class NotificationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => snake_case(class_basename($this->type)),
            // 'user' => new UserResource(User::find($this->notifiable_id)),
            'data' => $this->data,
            'read_at' => toIso8601String($this->read_at),
            'created_at' => toIso8601String($this->created_at),
        ];
    }
}
