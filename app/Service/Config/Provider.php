<?php

namespace App\Service\Config;


use App\Service\AbstractProvider;
use App\Core\Config\Config;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'config';

    /**
     * @return void
     */
    public function init()
    {

        $config['app'] = Config::file('app');
        $this->di->set($this->serviceName, $config);

    }
}