<?php

namespace App\Service\Router;


use App\Service\AbstractProvider;
use App\Core\Router\Router;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'router';

    /**
     * @return void
     */
    public function init()
    {

        $router = new Router(env('APP_HOST','http://localhost'));
        $this->di->set($this->serviceName, $router);

    }
}