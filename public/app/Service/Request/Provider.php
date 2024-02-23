<?php

namespace App\Service\Request;


use App\Service\AbstractProvider;
use App\Core\Request\Request;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'request';

    /**
     * @return void
     */
    public function init()
    {
        $request = new Request();
        $this->di->set($this->serviceName, $request);
    }
}