<?php

namespace controllers;

//todo Или это не относится к контроллерам и запихать куда-нибудь в "хелперы"?
class ErrorController
{
    public function throwHttpError($code, $message)
    {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'code' => $code,
            'message' => $message
        ));
        exit;
    }
}