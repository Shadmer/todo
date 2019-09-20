<?php

namespace controllers;

class ErrorController
{
    public function actionIndex()
    {
        echo 'Ошибка 404 - такой страницы не существует';
        return true;
    }
}