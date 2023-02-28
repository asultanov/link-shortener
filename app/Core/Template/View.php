<?php

namespace App\Core\Template;

class View
{
    public function __construct()
    {
        //code
    }

    public function render($template, $vars = [])
    {
        $templatePatch = ROOT_DIR . '/app/resources/views/default/' . $template . '.php';

        if (!is_file($templatePatch))
            throw new \InvalidArgumentException(sprintf('Template "%s" not found in "%s"', $template, $templatePatch));

        extract($vars);
        ob_start();
        ob_implicit_flush(0);
        try {
            require $templatePatch;
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
        echo ob_get_clean();
    }

}