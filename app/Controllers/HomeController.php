<?php

namespace App\Controllers;

class HomeController extends MainController
{
    public function index()
    {
        dump('hello');
    }

    public function test($id, $str)
    {
        dump($id, $str);
    }


    public function testPost($id, $str)
    {
        dump($id, $str);
    }

}