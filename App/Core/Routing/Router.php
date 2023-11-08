<?php

namespace App\Core\Routing;


use App\Core\Request;
use App\Utilities\Asset;

class Router
{
    private $request;
    private $routes;
    private $current_route;
    const BASE_CONTROLLER = '\App\Controllers\\';

    public function __construct()
    {
        $this->request = new Request();
        $this->routes = Route::getRoutes();
        $this->current_route = $this->findRoute($this->request) ?? null;
    }

    public function __destruct()
    {
    }

    private function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {

            if ($request->getUri() == $route['uri']) {
                //echo $route['uri'];
                if (in_array($request->getMethode(), $route['methods'])) {
                    return $route;
                } else {
                    return "405";
                }
            }
        }
        return null;
    }

    public function run()
    {
        # 405 : invalid request method
        if ($this->current_route == "405") {
            $this->dispatch405();
        }
        #404 : uri not exists
        if (is_null($this->current_route) || $this->current_route == "404") {
            $this->dispatch404();
        }
        $this->dispatch($this->current_route);
    }

    public function dispatch405()
    {
        header("HTTP/1.0 405 Method Not Allowed");
        Asset::view('errors.405');
        die();
    }

    public function dispatch404()
    {
        header("HTTP/1.0 404 Not Found!");
        Asset::view('errors.404');
        die();
    }

    private function dispatch($route)
    {
        $action = $route['action'];
        # action : null
        if (is_null($action) || empty($action)) {
            return;
        }
        # action : clousure 
        if (is_callable($action)) {
            $action();
            // call_user_func($action);
        }
        # action : Controller@methode
        if (is_string($action)) {
            $action = explode('@', $action);
        }
        # action : ['Controller','methode']
        if (is_array($action)) {
            $className = self::BASE_CONTROLLER . $action[0];
            $methodeName = $action[1];

            if (!class_exists($className)) {
                throw new \Exception("Class $className Not Exists!");
            }
            $coltroller = new $className();

            if (!method_exists($className, $methodeName)) {
                throw new \Exception("Methode $methodeName Not Exists in class $className!");
            }
            $coltroller->{$methodeName}();
        }
    }
}
