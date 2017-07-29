<?php

namespace App\Http\Controllers;

use App\Image;
use App\Services\HashService;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MainController
{

    /**
     * @var HashService
     */
    private $hash;

    /**
     * @param HashService $hash
     */
    public function __construct(HashService $hash)
    {
        $this->hash = $hash;
    }

    /**
     * Handles displaying an image on a request.
     *
     * @param $hash
     * @return mixed
     * @throws \App\Exceptions\MissingImageException
     */
    public function index($hash)
    {
        if (is_numeric($hash)) {
            throw new AccessDeniedException('numeric_hash_found');
        }

        $hash = $this->stripExtension($hash);

        $image = Image::where('label', $hash)->first();

        if (!$image) {
            $id = $this->hash->decode($hash);

            $image = Image::find($id);
        }

        return response($image->image, 200)->header('Content-Type', $image->mime);
    }

    private function stripExtension($hash)
    {
        $m = preg_match('/^(\S+)\.+(png|jpg|jpeg)$/', $hash, $out);

        if ($m === 0) {
            return $hash;
        }

        return $out[1];
    }
}
