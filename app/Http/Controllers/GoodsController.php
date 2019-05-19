<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


class GoodsController extends BaseController
{

    public  function index(Request $request)
    {

        $url = 'http://passports.998cv.com/goodslist';
        //初始化
        $ch = curl_init();
        //传参
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,'');
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $res= curl_exec($ch);
        echo $res;
        curl_close($ch);
    }
    public function partiGoods()
    {
        $goods_id=$_GET['goods_id'];
        $url = 'http://passports.998cv.com/partigoods?goods_id='.$goods_id;

        //初始化
        $ch = curl_init();
        //传参
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,'');
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $res= curl_exec($ch);
        echo $res;
        curl_close($ch);

    }
    public function addCart()
    {
        $goods_id=$_GET['goods_id'];
        $u_id = $_GET['uid']??"";

        $url = 'http://passports.998cv.com/addcart?goods_id='.$goods_id.'&uid='.$u_id;
       
        //初始化
        $ch = curl_init();
        //传参
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,'');
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $res= curl_exec($ch);
        echo $res;
        curl_close($ch);

    }


    public function carlist()
    {
        $goods_id=$_GET['goods_id']??"";
        $u_id = $_GET['uid']??"";
        $url = 'http://passports.998cv.com/cartlist?goods_id='.$goods_id.'&uid='.$u_id;
        //初始化
        $ch = curl_init();
        //传参
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,'');
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $res= curl_exec($ch);
        echo $res;
        curl_close($ch);

    }

    public function cartdd()
    {

        $cart_id=$_GET['cart_id']??"";
        $u_id = $_GET['uid']??"";

        $url = 'http://passports.998cv.com/cartdd?cart_id='.$cart_id.'&uid='.$u_id;
        //初始化
        $ch = curl_init();
        //传参
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,'');
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $res= curl_exec($ch);
        echo $res;
        curl_close($ch);

    }
    public function orderlist()
    {
        $cart_id=$_GET['cart_id']??"";
        $u_id = $_GET['uid']??"";

        $url = 'http://passports.998cv.com/orderlist?cart_id='.$cart_id.'&uid='.$u_id;
        //初始化
        $ch = curl_init();
        //传参
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,'');
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $res= curl_exec($ch);
        echo $res;
        curl_close($ch);

    }
    public function alipayss()
    {
        $order_id=$_GET['order_id']??"";
//        $u_id = $_GET['uid']??"";
        $url ='http://passports.998cv.com/pay?order_id='.$order_id;
        //初始化
        $ch = curl_init();
        //传参
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,'');
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $res= curl_exec($ch);
        echo $res;
        curl_close($ch);

    }
}