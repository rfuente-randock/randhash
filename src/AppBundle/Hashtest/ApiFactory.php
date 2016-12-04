<?php

namespace AppBundle\Hashtest;

use AppBundle\Hashtest\Api;

class ApiFactory
{
    protected $api;

    public function __construct($data)
    {
        $this->api = new Api($data);
    }
    
    public function getApi() {
        return $this->api;
    }
}