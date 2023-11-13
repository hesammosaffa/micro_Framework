<?php
#front controller

use App\Core\Routing\Router;
use App\Models\User;
use App\Utilities\Dump;

include "bootstrap/init.php";

// $user_data = [
//     'id' => rand(1,100),
//     'name' => 'Hesam Mosaffa'.rand(100,999),
//     'age' => rand(30,80)
// ];

// $userModel = new User();
//  $userModel->create($user_data);
 
//$record = $userModel->find(63);
//$record_val = $userModel->get(['name','age'],['id'=>59,'age'=>35]);
//$recordNew = $userModel->delete(['id'=>45]);
//Dump::nice_dump($record_val);


// $router = new Router();
// $router->run();
