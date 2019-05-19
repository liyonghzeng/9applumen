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
//商品展示
$router->post('goodslist','GoodsController@index');

$router->post('partigoods','GoodsController@partiGoods');


$router->post('cartdd','GoodsController@cartdd');

$router->post('orderlist','GoodsController@orderlist');


//路由中间组
$router->get('alipayss','GoodsController@alipayss');

$router->group(['middleware' => 'checkToken'], function () use ($router){
    $router->post('agepeople','LoginController@agePeople');
    $router->post('addcart','GoodsController@addCart');
    $router->post('carlist','GoodsController@carlist');

});