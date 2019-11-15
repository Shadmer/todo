<?php

namespace core;

class Router
{
//    private $routes;

    public function __construct()
    {
//        $this->routes = include($routesPath);
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

        return [
            'method' => $method,
            'formData' => $this->getFormData($method),
            'urlData' => $urlData,
            'router' => $router
        ];
    }

    private function isValidRouter($router)
    {
        return in_array($router, [
            'category',
            'task'
        ]);
    }

    public function run()
    {
//        echo '<pre>';
//        print_r($this->getRequestData());
        require_once ROOT . '/dist/index.html';
        die;
    }
}