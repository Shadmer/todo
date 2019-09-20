<?php

header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");
    exit(0);
}

ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
require_once ROOT . '/core/Autoload.php';

$routesPath = ROOT . '/config/routes.php';
$router = new \core\Router($routesPath);
// todo проверка роутера на валидность?
$router->run();