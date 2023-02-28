<?php
require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


new \App\Core\Database\Connection;
try {
    Capsule::schema()->create('links', function ($table) {
        $table->increments('id');
        $table->timestamps();
    });
    echo('Установка прошла успешно');
} catch (PDOException $exception) {
    echo($exception->getMessage());
}



