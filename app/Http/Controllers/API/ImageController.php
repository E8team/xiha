<?php

namespace App\Http\Controllers\API;


use App\Exceptions\ResourceException;
use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageController extends APIController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        $config = config('images');
        $image = $request->file($config['upload_key']);
        if (!is_null($image) && $image->isValid()) {
            $image->hashName($image);
            $hashName = $this->hashName($image);
            $image->storeAs($config['source_path_prefix'], $hashName, ['disk' => $config['source_disk']]);

            $imageId = ltrim(strstr($hashName, DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR);
            return [
                'image' => $imageId,
                'image_url' => image_url($imageId)
            ];
        }
        $error = $image ? $image->getErrorMessage() : '图片上传失败';
        throw new ResourceException($error, [$config['upload_key'] => $error]);
    }

    protected function hashName(UploadedFile $image)
    {
        $name = md5_file($image->getRealPath());
        return substr($name, 0, 2) . DIRECTORY_SEPARATOR . $name . '.' . $image->guessExtension();
    }
}
