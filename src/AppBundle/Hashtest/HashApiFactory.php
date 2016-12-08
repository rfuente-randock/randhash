<?php

namespace AppBundle\Hashtest;

class HashApiFactory
{
    public static function getHashApi($data, $api_config) {
        switch ($api_config['api_version']) {
            case 1:
                return new HashApi1($data, $api_config);
            case 2:
                // other...
        }
        throw new \Exception("API version not found!");
    }
}