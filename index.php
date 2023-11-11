<?php
#front controller

use App\Core\Routing\Router;
use App\Utilities\Dump;

include "bootstrap/init.php";

$router = new Router();
$router->run();



 
