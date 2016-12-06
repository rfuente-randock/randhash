<?php

namespace AppBundle\Hashtest;

interface HashApiInterface
{
    public function create($data);
    public function getHash();
}