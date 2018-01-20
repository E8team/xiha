<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Container\Container;
use Illuminate\Http\File;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;

class ImageService
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function uploadKey()
    {
        return $this->config['upload_key'];
    }

    public function store($image, $creatorId = null)
    {
        if ($this->isUrl($image)) {
            $image = new File($this->createTempFileFromUrl($image));
        }

        $hash = $this->hash($image);
        if ($this->isNotExist($hash)) {
            $this->storeToDisk($hash, $image);
            $this->storeToDatabase($hash, $image, $creatorId);
        }
        @unlink($image->getRealPath());
        return $hash;
    }

    protected function isUrl($url)
    {
        return (bool)filter_var($url, FILTER_VALIDATE_URL);
    }

    protected function createTempFileFromUrl($url)
    {
        $options = [
            'http' => [
                'method' => "GET",
                'header' => "Accept-language: en\r\n" .
                    "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2\r\n"
            ]
        ];

        $context = stream_context_create($options);

        $tempName = tempnam(sys_get_temp_dir(), 'xiha');

        if ($data = @file_get_contents($url, false, $context)) {
            @file_put_contents($tempName, $data);
        }
        return $tempName;
    }

    protected function storeToDatabase($hash, File $image, $creatorId = null)
    {

        list($width, $height) = getimagesize($image->getRealPath());
        Image::create([
            'hash' => $hash,
            'mime' => $image->getMimeType(),
            'ext' => $image->guessExtension(),
            'title' => $image->getFilename(),
            'width' => $width,
            'height' => $height,
            'creator_id' => $creatorId
        ]);
    }

    protected function storeToDisk($hash, File $image)
    {
        $path = $this->path($hash, $image->guessExtension());
        return Container::getInstance()->make(FilesystemFactory::class)->disk($this->config['source_disk'])->putFileAs(
            $this->config['source_path_prefix'], $image, $path
        );
    }

    protected function isNotExist($hash)
    {
        return !$this->isExist($hash);
    }

    protected function isExist($hash)
    {
        return Image::where('hash', $hash)->count() > 0;
    }

    protected function hash(File $image)
    {
        return md5_file($image->getRealPath());
    }

    protected function path($hash, $ext)
    {
        return substr($hash, 0, 2) . DIRECTORY_SEPARATOR . $hash . '.' . $ext;
    }
}