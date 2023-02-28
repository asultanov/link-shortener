<?php

namespace App\Core\Template;

class Theme
{
    const RULES_FILE_NAME = [
        'header' => 'header-%s',
        'footer' => 'footer-%s',
        'sidebar' => 'sidebar-%s',
    ];

    public $url = '';
    protected $data = [];

    /**
     * @param $name
     * @return void
     * @throws \Exception
     */
    public function header($name = '')
    {
        $name = (string)$name;

        $file = 'header';
        if ($name !== '')
            $file = sprintf(self::RULES_FILE_NAME['header'], $name);

        $this->loadTemplateFile($file);
    }

    /**
     * @param $name
     * @return void
     * @throws \Exception
     */
    public function footer($name = '')
    {
        $name = (string)$name;

        $file = 'footer';
        if ($name !== '')
            $file = sprintf(self::RULES_FILE_NAME['footer'], $name);

        $this->loadTemplateFile($file);
    }

    /**
     * @param $name
     * @return void
     * @throws \Exception
     */
    public function sidebar($name = '')
    {
        $name = (string)$name;

        $file = 'sidebar';
        if ($name !== '')
            $file = sprintf(self::RULES_FILE_NAME['sidebar'], $name);

        $this->loadTemplateFile($file);
    }

    /**
     * @param $name
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function block($name = '', $data = [])
    {
        $name = (string)$name;

        if ($name !== '')
            $this->loadTemplateFile($name, $data);
    }

    /**
     * @param $fileName
     * @return void
     * @throws \Exception
     */
    public function loadTemplateFile($fileName, $data = [])
    {
        //$templateFile =
        $templateFile = $this->getTemplatePath($fileName, ENV);
        if (is_file($templateFile)) {
            extract($data);
            require_once $templateFile;
        } else
            throw new \Exception(sprintf('View file "%s" does not exist.', $templateFile));
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    protected function getTemplatePath($template, $env = null)
    {
        switch ($env) {
            case 'Admin':
                return ROOT_DIR . '/app/resources/views/admin/' . $template . '.php';
                break;
            case 'App':
                return ROOT_DIR . '/app/resources/views/guest/' . $template . '.php';
                break;
            default:
                return ROOT_DIR . '/app/resources/views/' . mb_strtolower($env) . '/' . $template . '.php';
        }
    }
}