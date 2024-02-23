<?php

namespace Admin\Controllers;

use App\Controllers\Controller;
use App\Di\Di;

class MainController extends Controller
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
    }
}