<?php

namespace App\Utilities;

class Url
{

    public static function curent()
    {
        return (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function curent_route()
    {
        return strtok($_SERVER['REQUEST_URI'],'?'); // without quarry params
    }
}
