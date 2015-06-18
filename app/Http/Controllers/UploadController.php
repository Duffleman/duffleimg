<?php

namespace App\Http\Controllers;

use App\Exceptions\CorruptImageException;
use App\Exceptions\MissingImageException;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    /**
     * Handles an incoming upload request.
     *
     * @param Request $request
     * @return mixed
     * @throws CorruptImageException
     * @throws MissingImageException
     */
    public function handle(Request $request)
    {
        if (!$request->hasFile('image')) {
            throw new MissingImageException('You need to post `image` to this endpoint.');
        }

        $image = $request->file('image');

        if (!$image->isValid()) {
            throw new CorruptImageException('This image is corrupt, try again.');
        }

        $service = app('App\Services\ImageService');
        $url = $service->save($image);

        $params = $request->all();
        if (isset($params['sharex'])) {
            return $url;
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Image uploaded successfully.',
            'url'     => $url
        ]);
    }
}
