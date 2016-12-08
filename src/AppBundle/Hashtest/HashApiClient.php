<?php

namespace AppBundle\Hashtest;

class HashApiClient
{
    private $api_config;
    
    public function __construct($api_username, $api_password) {
        $this->api_config = [
            'api_username' => $api_username,
            'api_password' => $api_password,
            'api_version' => 1
        ];
    }
    
    public function getHash($data) {
        $hashApi = HashApiFactory::getHashApi($data, $this->api_config);
        return($hashApi->getHash());
    }
}