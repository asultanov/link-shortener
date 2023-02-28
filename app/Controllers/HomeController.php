<?php

namespace App\Controllers;

class HomeController extends MainController
{
    public function index()
    {
        $data = [
            'name' =>'my name is ',
            'config'=> $this->config
        ];

        $this->view->render('index', $data);
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