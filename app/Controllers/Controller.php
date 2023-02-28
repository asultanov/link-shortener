<?php

namespace App\Controllers;

use App\Di\Di;

abstract class Controller
{
    protected $di;
    protected $view;
    protected $config;

    public function __construct(Di $di)
    {
        $this->di = $di;
        $this->view = $this->di->get('view');
        $this->config = $this->di->get('config');
    }


}