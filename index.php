<?php

define('ROOT', __DIR__);
$config = include_once (__DIR__ . '/config.php');

if ($config['devMode']) {
    header('Access-Control-Allow-Origin: *');
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");
        exit(0);
    }

    ini_set('display_errors',1);
    error_reporting(E_ALL);
}

require_once __DIR__ . '/api/core/Autoload.php';

(new \core\Router())->run();