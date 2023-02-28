<?php

namespace App\Core\Router;

class UrlDispatcher
{
    private $method = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'HEAD'
    ];
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
        'PATCH' => [],
        'HEAD' => [],
    ];
    private $patterns = [
        'num' => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+',
    ];

    public function addPattern($name, $pattern)
    {
        $this->patterns[$name] = $pattern;
    }

    public function routes($method)
    {
        return isset($this->routes[$method]) ? $this->routes[$method] : [];
    }

    public function register($method, $pattern, $controller)
    {
        $convert = $this->convertPattern($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    private function convertPattern($pattern)
    {

        if (false === strpos($pattern, '(')) {
            return $pattern;
        }

        if (preg_match('#^/\((\w+):(\w+):\?\)$#', $pattern)) {
            throw new \InvalidArgumentException(sprintf('Prefix required when use optional placeholder in route "%s"', $pattern));
        }

        $parse = preg_replace_callback('#/\((\w+):(\w+):\?\)$#', [$this, 'replaceOptionalRoute'], $pattern);

        return preg_replace_callback('#\((\w+):(\w+)\)#', [$this, 'replacePattern'], $parse);
    }

    private function replaceOptionalRoute($matches)
    {
        $name = $matches[1];
        $pattern = $matches[2];

        return '(?:/(?<' . $name . '>' . strtr($pattern, $this->patterns) . '))?';
    }

    private function replacePattern($matches)
    {
        return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
    }

    private function processParam($parameters)
    {
        foreach ($parameters as $key => $value) {
            if (is_int($key)) {
                unset($parameters[$key]);
            }
        }
        return $parameters;
    }


    public function dispatch($method, $uri)
    {
        $routes = $this->routes(strtoupper($method));
        if (array_key_exists($uri, $routes)) {
            return new DispatchedRoute($routes[$uri]);
        }
        return $this->doDispatch($method, $uri);
    }

    private function doDispatch($method, $uri)
    {

        foreach ($this->routes[$method] as $route => $controller) {
            $pattern = '#^' . $route . '$#s';
            if (preg_match($pattern, $uri, $parameters)) {
                return new DispatchedRoute($controller, $this->processParam($parameters));
            }
        }
    }


}