<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'name' => $this->name,
            'username' => $this->username,
            // 'email' => $this->email,
            /*$this->mergeWhen($this->resource->relationLoaded('avatarImage'), [
                'avatar_url' => $this->avatarImage->url
            ]),*/
            'avatar_url' => $this->avatarImage->url,
            'github_url' => $this->github_url,
            'jokes_count' => $this->jokes_count,
            'votes_count' => $this->votes_count,
            'views_count' => $this->views_count,
            'last_active_at' => toIso8601String($this->last_active_at)
        ];
    }
}
