<?php

namespace App\Models;


class Image extends BaseModel
{
    protected $fillable = ['hash', 'mime', 'ext', 'title', 'width', 'height', 'creator_id'];

    protected $primaryKey = 'hash';

    protected $keyType = 'char';

    public $incrementing = false;

    /**
     * 获取图片的 url
     * @param null $style
     * @return string
     */
    public function getUrl($style = null)
    {
        return image_url($this->hash . '.' . $this->ext, $style);
    }
}
