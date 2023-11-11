<?php

namespace App\Core\Routing;


use App\Core\Request;
use App\Middleware\BlockIp;
use App\Utilities\Asset;
use App\Utilities\Dump;

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
        # run middleware here
       // $this->global_middleware();
      //  $this->run_route_middleware();
    }

    public function __destruct()
    {
    }

    private function global_middleware()
    {
        $globalMiddalewareObj = new BlockIp();
        $globalMiddalewareObj->handle();
    }

    private function run_route_middleware()
    {
        $middlewares = $this->current_route['middleware'];

        if (!is_null($middlewares)) {
            foreach ($middlewares as $key => $middleware_class) {
                if (class_exists($middleware_class)) {
                    $middleware_obj = new $middleware_class();
                    $middleware_obj->handle();
                }
            }
        }
    }

    private function findRoute(Request $request)
    { //in_array($request->getMethode(), $route['methods']) && $this->regex_matched($route)
        foreach ($this->routes as $route) {
                if ( $this->regex_matched($route)  ) {
                    if($this->invalid_request($request ,$route)){
                        return $route;
                    } else{
                        return "405";
                    }
                }
        }
        return null;
    }

private function invalid_request($request , $route)
{
    if($request->getMethode() == $route['methods'][0] ){
        return true;
    }
    return false;
}

public function regex_matched($route)
{
    global $request;
    $pattern = "/^". str_replace(['/','{','}'],['\/','(?<','>[-%\w]+)'],$route['uri']) . '$/'; 
    $result = preg_match($pattern,$this->request->getUri(),$matchs);
    if(!$result){
        return false;
        echo "false";
    }

    foreach ($matchs as $key => $value) {
        if(!is_int($key)){
            $request->add_route_param($key,$value);
        }
    }  
    return true;

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
