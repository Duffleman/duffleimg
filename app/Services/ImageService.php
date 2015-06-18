<?php namespace App\Services;

use App\Image;
use Hashids\Hashids;
use Symfony\Component\HttpFoundation\File\File;

class ImageService
{

    private $hash;

    public function __construct()
    {
        $salt = env('APP_KEY');
        $this->hash = new Hashids($salt, 6);
    }

    public function save(File $file)
    {
        $image = file_get_contents($file);
        $hash = sha1($image);

        $model = Image::where('hash', $hash)->first();

        if (!$model) {
            $model = Image::create(['hash' => $hash, 'image' => $image]);
        }

        unset($image);
        unset($file);

        if ($model) {
            return $this->url($model->id);
        }
    }

    private function url($id)
    {
        $id = $this->encode($id);

        return env('URL') . '/' . $id;
    }

    private function encode($id)
    {
        return $this->hash->encode($id);
    }

    private function decode($id)
    {
        if (is_numeric($id)) {
            return $id;
        }

        return $this->hash->decode($id);
    }
}
