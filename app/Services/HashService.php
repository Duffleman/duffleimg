<?php

namespace App\Services;

use Hashids\Hashids;

class HashService
{

    public function __construct(Hashids $hash)
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
        return $this->hash->decode($hash)[0];
    }
}