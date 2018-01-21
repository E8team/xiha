<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class JokeResource extends Resource
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
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'image' => new ImageResource($this->whenLoaded('image')),
            'comments_count' => $this->comments_count,
            'votes_count' => $this->votes_count,
            $this->mergeWhen(auth()->check(), function () {
                return ['is_voted_by' => $this->isVotedBy(auth()->user())];
            }),
            'content' => $this->content,
            'updated_at' => toIso8601String($this->updated_at),
            'created_at' => toIso8601String($this->created_at),
        ];
    }
}
