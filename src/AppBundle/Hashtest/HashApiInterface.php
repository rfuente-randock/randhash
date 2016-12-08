<?php

namespace AppBundle\Hashtest;

interface HashApiInterface
{
    public function create($data, $api_config);
    public function getHash();
}