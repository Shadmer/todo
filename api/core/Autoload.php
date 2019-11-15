<?php

spl_autoload_register(function ($class) {
    $path = ROOT . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR
        . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});