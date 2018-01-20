<?php

namespace App\Http\Controllers\API;


use App\Exceptions\ImageUploadException;
use App\Http\Controllers\APIController;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends APIController
{
    protected $imageService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->imageService = app(ImageService::class);
    }

    public function upload(Request $request)
    {
        $image = $request->file($this->imageService->uploadKey());

        if (is_null($image) || $image->isValid()) {
            $error = $image ? $image->getErrorMessage() : '图片上传失败';
            throw new ImageUploadException($error);
        }

        $hash = $this->imageService->store($image, auth()->id());
        return ['hash' => $hash];
    }
}
