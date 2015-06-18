<?php namespace App;

use App\Exceptions\MissingImageException;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = ['image', 'hash', 'mime'];

    public static function getByHash($hash)
    {
        $salt = env('SALT');
        $hashids = new Hashids($salt, 6);
        $id = $hashids->decode($hash)[0];

        $self = Image::find($id);
        if (!$self) {
            throw new MissingImageException('Cannot find this image sorry.');
        }

        return $self;
    }
}
