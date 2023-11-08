<?php

use App\Core\Routing\Route;
use App\Middleware\BlockFirefox;
use App\Middleware\BlockIE;

//Route::get('/null');
Route::get('/todo/list',"TodoController@list",[BlockFirefox::class , BlockIE::class]);

Route::get('/archive',"ArchiveController@index");
Route::get('/archive/articles',"ArchiveController@articles");
Route::get('/archive/products',"ArchiveController@products");


Route::add(['POST','GET'],'/a', function () {
    echo "Welcome!";
});

Route::get('/b', function () {
    echo "save ok!";
});

Route::get('/', "HomeController@index");

Route::put('/c', "Controller@Method");

Route::get('/d', "Controller","Method");

