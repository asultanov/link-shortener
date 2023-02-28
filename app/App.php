<?php

namespace App;

use App\Core\Router\DispatchedRoute;
use App\Helpers\Common;

class App
{
    private $di;

    public $router;

    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    public function run()
    {

        require_once ROOT_DIR . '/app/routes/web.php';

        $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPatchUri());

        if (is_null($routerDispatch)) {
            $routerDispatch = new DispatchedRoute('ErrorController@page404');
        }

        list($class, $action) = explode('@', $routerDispatch->getController(), 2);
        $controller = '\\' . ENV . '\\Controllers\\' . $class;
        $parameters = $routerDispatch->getParameters();

        call_user_func_array([new $controller($this->di), $action], $parameters);
    }

}