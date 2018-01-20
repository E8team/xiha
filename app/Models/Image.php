<?php

namespace App\Models;


class Image extends BaseModel
{
    protected $fillable = ['hash', 'mime', 'ext', 'title', 'width', 'height', 'creator_id'];

    public function getUrlAttribute()
    {
        return image_url($this->hash . '.' . $this->ext);
    }
}
