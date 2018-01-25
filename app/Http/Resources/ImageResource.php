<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ImageResource extends Resource
{
    private $imageStyles = [];

    public function __construct($resource, $imageStyles = [])
    {
        parent::__construct($resource);
        $this->imageStyles = $imageStyles;
    }

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
            $this->mergeWhen(!empty($this->imageStyles), function () {
                $urls = [];
                foreach ($this->imageStyles as $style) {
                    $urls[$style] = $this->getUrl($style);
                }
                return $urls;
            }),
            // 'cover_url' => $this->getUrl('joke_cover'),
            'is_gif' => str_contains($this->mime, 'gif'),
            // 高宽比大于等于 3 认为是长图
            'is_high' => $this->height / $this->width >= 3
        ];
    }
}
