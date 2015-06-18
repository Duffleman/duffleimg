<?php namespace App\Http\Controllers;

use App\Image;

class MainController
{

    /**
     * Handles displaying an image on a request.
     *
     * @param $hash
     * @return mixed
     * @throws \App\Exceptions\MissingImageException
     */
    public function index($hash)
    {
        $hash = $this->stripExtension($hash);

        $image = Image::getByHash($hash);

        return response($image->image, 200)->header('Content-Type', 'image/png');
    }

    private function stripExtension($hash)
    {
        if (ends_with($hash, '.png')) {
            return substr($hash, 0, -4);
        }
    }
}
