<?php

namespace App\Utilities;

class Asset
{

    public static function get(string $route)
    {
        return $_ENV['HOST'] . 'assets/' . $route;
    }

    public static function view(string $path,$data = [])
    {
        extract($data);
        include_once BASE_PATH."/views/" .str_replace(".", "/", $path) . ".php";
    }
}
