<?php

namespace App\Controllers;

use App\Di\Di;

class MainController extends Controller
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
    }
}