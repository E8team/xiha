<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class VoteResource extends Resource
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
            'type' => $this->type,
            'updated_at' => toIso8601String($this->updated_at),
            'created_at' => toIso8601String($this->created_at),
        ];
    }
}
