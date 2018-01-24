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
            // 'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'introduce' => $this->introduce,
            // 'email' => $this->email,
            /*$this->mergeWhen($this->resource->relationLoaded('avatar'), [
                'avatar_url' => $this->avatar->url
            ]),*/
            'avatar' => new ImageResource($this->whenLoaded('avatar')),
            'github_url' => $this->github_url,
            'jokes_count' => $this->jokes_count,
            'votes_count' => $this->votes_count,
            'views_count' => $this->views_count,
            'last_active_at' => toIso8601String($this->last_active_at),
            'updated_at' => toIso8601String($this->updated_at),
            'created_at' => toIso8601String($this->created_at)
        ];
    }
}
