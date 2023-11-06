<?php

namespace App\Utilities;

class Asset{

    public static function get(string $route){
        return $_ENV['HOST'] . 'assets/' . $route;
    }
}