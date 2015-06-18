<?php namespace App\Http\Controllers;

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
            throw new AccessDeniedException('You should not access an image by it\'s ID.');
        }

        $hash = $this->stripExtension($hash);
        $id = $this->hash->decode($hash);

        $image = Image::find($id);

        return response($image->image, 200)->header('Content-Type', 'image/png');
    }

    private function stripExtension($hash)
    {
        if (ends_with($hash, '.png')) {
            return substr($hash, 0, -4);
        }

        return $hash;
    }
}
