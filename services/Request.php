<?php

class Request
{
    public static function getUri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function wantsJson()
    {
        if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
            return true;
        }

        return false;
    }
}