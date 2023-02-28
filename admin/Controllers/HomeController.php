<?php

namespace Admin\Controllers;

class HomeController extends MainController
{
    public function index()
    {
        $data = [
            'name' => 'my name is admin '
        ];
        $this->view->render('index', $data);
    }
}