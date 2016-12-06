<?php

namespace AppBundle\Hashtest;

class HashApiFactory
{
    public static function getHashApi($data, $hashApiVersion) {
        switch ($hashApiVersion) {
            case 1:
                return new HashApi1($data);
            case 2:
                // other...
        }
        throw new \Exception("API version not found!");
    }
}