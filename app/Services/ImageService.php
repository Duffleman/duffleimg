<?php

namespace App\Services;

use App\Image;
use App\Exceptions;
use Hashids\Hashids;
use Symfony\Component\HttpFoundation\File\File;

class ImageService
{

    /**
     * @var Hashids
     */
    private $hash;

    /**
     * @var array
     */
    private $acceptedMimeTypes = [
        'image/png',
        'image/jpeg',
    ];

    /**
     * Constructor
     */
    public function __construct(HashService $hash)
    {
        $this->hash = $hash;
    }

    /**
     * Save a file to the database.
     *
     * @param File $file
     * @return string
     */
    public function save(File $file)
    {
        if (!in_array($file->getMimeType(), $this->acceptedMimeTypes)) {
            throw new Exceptions\BadFormatException('unacceptable_mimetype');
        }

        $image = file_get_contents($file);
        $hash = sha1($image);

        $model = Image::where('hash', $hash)->first();

        if (!$model) {
            $model = Image::create(['hash' => $hash, 'image' => $image]);
        }

        unset($image);
        unset($file);

        return $this->url($model->id);
    }

    /**
     * Grab a fullpath URL to an image.
     *
     * @param $id
     * @return string
     */
    private function url($id)
    {
        $id = $this->encode($id);

        return env('URL') . '/' . $id;
    }

    /**
     * Encode an ID to a HASH.
     *
     * @param $id
     * @return string
     */
    private function encode($id)
    {
        return $this->hash->encode($id);
    }
}
