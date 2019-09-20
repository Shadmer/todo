<?php

namespace core;

class Router
{
    private $routes;

    public function __construct($routesPath)
    {
        $this->routes = include($routesPath);
    }

    private function getUri()
    {
        if (!empty($_SERVER["REQUEST_URI"])) {
            return trim($_SERVER["REQUEST_URI"], '/');
        }
//        if (!empty($_GET['q'])) {
//            return trim($_GET['q'], '/');
//        }
    }

    private function getSegments($uriPattern, $path, $uri)
    {
        $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
        $segments = explode('/', $internalRoute);
        unset($segments[0]);
        $segments = array_values($segments);
        return $segments;
    }


    public function run()
    {
        $uri = $this->getUri();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {

                $segments = $this->getSegments($uriPattern, $path, $uri);
                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                $controllerName = sprintf('controllers\%s', $controllerName);
                $controller = new $controllerName;
                $controller = call_user_func_array(array($controller, $actionName), $parameters);

                if ($controller != null) {
                    break;
                }

            }
        }
    }
}