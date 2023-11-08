<?php

namespace App\Core\Routing;

class Route
{
    private static $routes = [];
     
    public static function add($methodes,$uri,$action = null)
    {
        $methodes = is_array($methodes)? $methodes : [$methodes];
        self::$routes[] = ['methods' => $methodes , 'uri' => $uri , 'action' => $action];
    }

    public static function get($uri,$action = null)
    {
        self::add('GET',$uri,$action);
    }

    public static function post($uri,$action = null)
    {
        self::add('POST',$uri,$action);
    }

    public static function put($uri,$action = null)
    {
        self::add('PUT',$uri,$action);
    }

    public static function patch($uri,$action = null)
    {
        self::add('PATCH',$uri,$action);
    }

    public static function delete($uri,$action = null)
    {
        self::add('DELETE',$uri,$action);
    }

    public static function options($uri,$action = null)
    {
        self::add('OPTIONS',$uri,$action);
    }

    public static function getRoutes()
    {
        return self::$routes;
    }
}