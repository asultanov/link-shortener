<?php

namespace Admin\Controllers;

class ErrorController extends MainController
{
    public function page404()
    {
        echo "admin-404-page";
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' 400 Bad file format');
    }
}