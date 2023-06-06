<?php

namespace App\Service\Database;


use App\Core\Database\Connection;
use App\Service\AbstractProvider;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'db';

    /**
     * @return void
     */
    public function init()
    {
        $db = new Connection;
        $this->di->set($this->serviceName, $db);
    }
}