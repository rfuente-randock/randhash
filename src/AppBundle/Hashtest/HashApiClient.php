<?php

namespace AppBundle\Hashtest;

class HashApiClient
{
    public static function getHash($data) {
        $hashApi = HashApiFactory::getHashApi($data, 1);
        return($hashApi->getHash());
    }
}