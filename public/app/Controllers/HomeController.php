<?php

namespace App\Controllers;

class HomeController extends MainController
{
    public function index()
    {
        $this->view->render('index');
    }



}