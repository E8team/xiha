<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CommentResource extends Resource
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
            'up_votes_count' => $this->up_votes_count,
            $this->mergeWhen(auth()->check(), function () {
                // todo 如何优化?
                return ['me_vote' => new VoteResource($this->getVoteInfoByUser(auth()->user()))];
            }),
            'content' => $this->content,
            'created_at' => toIso8601String($this->created_at),
            'updated_at' => toIso8601String($this->updated_at)
        ];
    }
}
