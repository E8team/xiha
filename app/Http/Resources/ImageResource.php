<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ImageResource extends Resource
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
            'hash' => $this->hash,
            'mime' => $this->mime,
            'width' => $this->width,
            'height' => $this->height,
            'url' => $this->getUrl(),
            'cover_url' => $this->getUrl('cover_url')
        ];
    }
}
