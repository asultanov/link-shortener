<?php

namespace App\Service;

abstract class AbstractProvider
{

    protected $di;

    public function __construct(\App\Di\Di $di)
    {
        $this->di = $di;
    }

    abstract function init();
}