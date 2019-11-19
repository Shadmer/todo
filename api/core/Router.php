<?php

namespace core;

class Router
{
    private $requestData;
    private $routes;
    private $helpers;

    public function __construct($routes, $helpers)
    {
        $this->requestData = $this->getRequestData();
        $this->routes = $routes;
        $this->helpers = $helpers;
    }

    private function getUri()
    {
        if (!empty($_SERVER["REQUEST_URI"])) {
            return trim($_SERVER["REQUEST_URI"], '/');
        }
    }

    private function getFormData($method) {
        switch ($method)
        {
            case 'GET':
                $data = $_GET;
                break;
            case 'POST':
                $data = $_POST;
                break;
            default:
                parse_str(file_get_contents('php://input'), $data);
        }
        return $data;
    }

    private function getRequestData()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $urlData = explode('/', $this->getUri());
        $router = array_shift($urlData);

        if ($router === 'api') {
            return [
                'method' => $method,
                'formData' => $this->getFormData($method),
                'controller' => array_shift($urlData),
                'action' => array_shift($urlData),
                'id' => array_shift($urlData),
            ];
        } else {
            return false;
        }
    }

    public function run()
    {
        if ($this->requestData) {

            if (in_array($this->requestData['controller'], $this->routes)) {
                $controllerName = ucfirst($this->requestData['controller']) . 'Controller';
                $controllerName = sprintf('controllers\%s', $controllerName);
                $actionName = 'action' . ucfirst($this->requestData['action']);
                $controller = new $controllerName(DB::connect());

                //todo можно сделать нормальную валидацию параметров, если не будет лениво
                if (method_exists($controller, $actionName)) {
                    call_user_func_array(
                        array($controller, $actionName),
                        array($this->requestData['id'], $this->requestData['formData'])
                    );
                } else {
                    $this->helpers->throwHttpError('invalid_parameters', 'invalid_parameters');
                }


            } else {
                $this->helpers->throwHttpError('bad_request', 'bad_request');
            }
        } else {
            require_once ROOT . '/dist/index.html';
        }


    }
}