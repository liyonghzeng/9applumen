<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('index','UserapiController@index');

$router->post('private','ApiPrivateController@index');

$router->post('zc','ApiPrivateController@zc');


//签名
$router->post('qm','ApiPrivateController@qm');

$router->post('login','LoginController@login');

$router->post('loginadd','LoginController@loginadd');

$router->post('agepeople','LoginController@agePeople');