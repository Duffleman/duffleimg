<?php

namespace App\Services;

use App\Exceptions\UndecodableHashException;
use Exception;
use Hashids\Hashids;

class HashService
{

    public function __construct()
    {
        $salt = env('APP_KEY');
        $this->hash = new Hashids($salt, 6);
    }

    public function encode($id)
    {
        return $this->hash->encode($id);
    }

    public function decode($hash)
    {
        $value = $this->hash->decode($hash);

        if (is_array($value)) {
            if (isset($value[0])) {
                return $value[0];
            } else {
                throw new UndecodableHashException('Cannot decode that hash sorry.');
            }
        } else {
            throw new Exception('Unknown error occured while decoding that hash.');
        }
    }
}
