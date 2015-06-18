<?php namespace App\Http\Controllers;

use App\Image;

class MainController
{

    public function index($hash)
    {
        $image = Image::getByHash($hash);

        return response($image->image, 200)->header('Content-Type', 'image/png');
    }
}
