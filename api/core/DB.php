<?php

namespace core;

class DB
{
    public static function connect()
    {
        $paramsPath = ROOT . './config/db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['db']};charset={$params['charset']}";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return new \PDO($dsn, $params['user'], $params['pass'], $opt);
    }
}