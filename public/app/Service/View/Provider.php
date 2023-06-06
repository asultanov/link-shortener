<?php

namespace App\Service\View;


use App\Service\AbstractProvider;
use App\Core\Template\View;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'view';

    /**
     * @return void
     */
    public function init()
    {
        $view = new View();
        $this->di->set($this->serviceName, $view);
    }
}