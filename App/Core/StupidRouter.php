<?php

namespace App\Core;

use App\Utilities\Url;

class StupidRouter
{
    private $routers;
    private $basepath;
    public function __construct($_basepath)
    {
        $this->routers = [
            '/' => '/views/home/index.php',
            '/color/blue' => '/views/colors/blue.php',
            '/color/red' => '/views/colors/red.php',
            '/color/green' => '/views/colors/green.php'
        ];
        $this->basepath = $_basepath;
    }

    public function run()
    {
        $curent_route = Url::curent_route();

        foreach ($this->routers as $route => $view) {
            if ($curent_route == $route) {
                $this->includeAndDie($view);
            }
        }
        header("HTTP/1.1 404 Not Found");
        $this->includeAndDie("views/errors/404.php");

    }

    private function includeAndDie($viewPath)
    {
        include $this->basepath . $viewPath;
        die();
    }
}
