<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserapiController extends BaseController
{
    //
    public function index(Request $request)
    {
        $result=$request->input('pwd');
        $res=base64_decode($result);
        $method = 'AES-256-CBC';//加密方法
        $passwd = '896431841241048411488343488';//加密密钥
        $options=OPENSSL_RAW_DATA;
        $iv='52487sdfghrtydvb';
        return $result.'||'.openssl_decrypt($res, $method, $passwd,$options,$iv);
    }
}
