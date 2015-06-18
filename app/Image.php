<?php namespace App;

use App\Exceptions\MissingImageException;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class Image extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['image', 'hash', 'mime'];

    /**
     * Get an image by its hashid.
     *
     * @param $hash
     * @return mixed
     * @throws MissingImageException
     */
    public static function getByHash($hash)
    {
        if (!is_numeric($hash)) {
            $salt = env('APP_KEY');
            $hashids = new Hashids($salt, 6);
            $id = $hashids->decode($hash)[0];
        } else {
            throw new AccessDeniedException('You should not be accessing an image directly by its ID.');
        }

        $self = Image::find($id);
        if (!$self) {
            throw new MissingImageException('Cannot find this image sorry.');
        }

        return $self;
    }
}
