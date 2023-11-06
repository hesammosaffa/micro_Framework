<?php

use App\Core\Routing\Route;

Route::get('/null');

Route::get('/', function () {
    echo "Welcome!";
});

Route::post('/saveForm', function () {
    echo "save ok!";
});

Route::put('/pururi', "Controller@Method");

Route::get('/pururi', "Controller","Method");

var_dump(Route::getRoutes());