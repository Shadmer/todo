<?php

namespace core;

class DB
{
    private static $instance;

    // Шоб один раз к БД подключаться
    public static function connect()
    {
        if (self::$instance === null) {
            self::$instance = self::getPDO();
        }

        return self::$instance;
    }

    private static function getPDO()
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