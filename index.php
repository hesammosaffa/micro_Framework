<?php
#front controller

use App\Core\Routing\Router;


include "bootstrap/init.php";

$router = new Router();
$router->run();

// $res = file_get_contents('https://www.iplocate.io/api/lookup/'.$_SERVER['REMOTE_ADDR']);

// $res = json_decode($res);
// if($res->country != "Iran"){
//     echo "لطفا ابتدا فیلتر شکن خود را خاموش کرده و مجددا صفحه را رفرش کنید."."<br>";
//     echo " ================================="."<br>";
//     echo "شما از کشور : " . $res->country . "وارد وب سایت شده اید."."<br>";
// }

