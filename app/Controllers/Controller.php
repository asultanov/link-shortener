<?php

namespace App\Controllers;

use App\Di\Di;

abstract class Controller
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }


}