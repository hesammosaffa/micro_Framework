<?php

namespace App\Core\Routing;

class Route
{
    private static $routes = [];
     
    public static function add($methodes,$uri,$action = null,$middleware = [])
    {
        $methodes = is_array($methodes)? $methodes : [$methodes];
        self::$routes[] = ['methods' => $methodes , 'uri' => $uri , 'action' => $action , 'middleware' => $middleware];
    }

    public static function get($uri,$action = null,$middleware = [])
    {
        self::add('GET',$uri,$action,$middleware);
    }

    public static function post($uri,$action = null,$middleware = [])
    {
        self::add('POST',$uri,$action,$middleware);
    }

    public static function put($uri,$action = null,$middleware = [])
    {
        self::add('PUT',$uri,$action,$middleware);
    }

    public static function patch($uri,$action = null,$middleware = [])
    {
        self::add('PATCH',$uri,$action,$middleware);
    }

    public static function delete($uri,$action = null,$middleware = [])
    {
        self::add('DELETE',$uri,$action,$middleware);
    }

    public static function options($uri,$action = null,$middleware = [])
    {
        self::add('OPTIONS',$uri,$action,$middleware);
    }

    public static function getRoutes()
    {
        return self::$routes;
    }
}