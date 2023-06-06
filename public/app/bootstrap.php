<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\Di\Di;
use App\App;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

try {
    $di = new Di;

    $services = require(__DIR__ . '/Config/Service.php');

    foreach ($services as $service) {
        $provider = new $service($di);
        $provider->init();
    }

    $app = new App($di);
    $app->run();
} catch (\ErrorException $e) {
    dd($e->getMessage());
}

