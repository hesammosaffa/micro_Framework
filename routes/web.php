<?php

use App\Core\Routing\Route;

//Route::get('/null');

Route::add(['POST','GET'],'/a', function () {
    echo "Welcome!";
});

Route::get('/b', function () {
    echo "save ok!";
});

Route::get('/', "HomeController@index");

Route::put('/c', "Controller@Method");

Route::get('/d', "Controller","Method");

