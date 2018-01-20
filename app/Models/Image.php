<?php

namespace App\Models;


class Image extends BaseModel
{
    protected $fillable = ['hash', 'mime', 'ext', 'title', 'width', 'height', 'creator_id'];
}
