<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class TokenMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uid=$_GET['uid'];
        $token=$_GET['token'];
        if($uid==''|| $token==''){
            $json=[
                'erron'=>50002,
                'mag'=>'参数有误,请按照正确途径登录'
            ];
            $dd=json_encode($json);
            return $dd;
        }else{
            $ksy_token='laravel_database_login_token:uid'.$uid;
            $redis_token=Redis::get($ksy_token);
            if($token != $redis_token){
                $json=[
                    'erron'=>50002,
                    'mag'=>'参数有误,请按照正确途径登录'
                ];
                $dd=json_encode($json);
                return $dd;
            }
        }
        return $next($request);
    }

}