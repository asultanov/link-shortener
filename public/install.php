<?php
require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


new \App\Core\Database\Connection;
try {
    Capsule::schema()->create('links', function ($table) {
        //$table->increments('id');
        $table->id();
        $table->string('argument')->unique();
        $table->text('url');
        $table->text('callback_url')->nullable();
        $table->integer('chat_id')->nullable();
        $table->integer('message_id')->nullable();
        $table->timestamp('created_at')->nullable();
    });
    echo('Установка прошла успешно');
} catch (PDOException $exception) {
    echo($exception->getMessage());
}



