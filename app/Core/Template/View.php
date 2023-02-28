<?php

namespace App\Core\Template;

class View extends Theme
{
    /**
     * @param $template
     * @param $vars
     * @return void
     */
    public function render($template, $vars = [])
    {
        $templatePatch = $this->getTemplatePath($template, ENV);

        if (!is_file($templatePatch))
            throw new \InvalidArgumentException(sprintf('Template "%s" not found in "%s"', $template, $templatePatch));

        $this->setData($vars);
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