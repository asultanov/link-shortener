<?php

namespace App\Helpers;

class Common
{

    /**
     * @return bool
     */
    public static function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            return true;
        return false;
    }

    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getPatchUri()
    {
        $patch_url = $_SERVER['REQUEST_URI'];
        if ($posotion = strpos($patch_url, '?')) {
            substr($patch_url, 0, $posotion);
        }
        return $patch_url;
    }

}