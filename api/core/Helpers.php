<?php

namespace core;

class Helpers
{
    public function throwHttpError($code, $message)
    {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode([
            'code' => $code,
            'message' => $message,
        ]);
    }
}