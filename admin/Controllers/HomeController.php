<?php

namespace Admin\Controllers;

class HomeController extends MainController
{
    public function index()
    {
        $data = [
            'name' =>'this is ',
            'config'=> $this->config
        ];

        //dump($this->request);
        $this->view->render('index', $data);
    }
}