<?php

namespace App\Core\Template;

use App\Core\Template\Theme;

class View
{
    /**
     * @var \App\Core\Template\Theme
     */
    protected $theme;

    public function __construct()
    {
        $this->theme = new Theme();
    }

    /**
     * @param $template
     * @param $vars
     * @return void
     */
    public function render($template, $vars = [])
    {
        $templatePatch = ROOT_DIR . '/app/resources/views/default/' . $template . '.php';

        if (!is_file($templatePatch))
            throw new \InvalidArgumentException(sprintf('Template "%s" not found in "%s"', $template, $templatePatch));

        $this->theme->setData($vars);
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