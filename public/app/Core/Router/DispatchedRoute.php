<?php

namespace App\Core\Router;

class DispatchedRoute
{
    private $controller;
    private $parameters;

    /**
     * @param $controller
     * @param $parameters
     */
    public function __construct($controller, $parameters = [])
    {
        $this->controller = $controller;
        $this->parameters = $parameters;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

}