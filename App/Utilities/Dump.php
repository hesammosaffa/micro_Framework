<?php

namespace App\Utilities;

class Dump
{

    public static function nice_dump($var)
    {
        echo "<pre style= 'z-index: 999; position: relative; background: #fff; padding: 10px; margin: 10px; border-radius: 6px;border: 2px solid #f7830b; border-left: 6px solid #f7830b'>";
        var_dump($var);
        echo "</pre>";
    }

    public static function nice_dd($var)
    {
       self::nice_dump($var);
       die();
    }
}
