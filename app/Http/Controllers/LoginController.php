<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


class LoginController extends BaseController
{

    public  function login(Request $request)
    {
        $name=$request->input('username');
        $pwd=$request->input('pwd');
        if($name==''){
            $json=[
                'erron'=>50002,
                'mag'=>'密码必填'
            ];
            $dd=json_encode($json);
           die($dd);
        }
        if($pwd==''){
            $json=[
                'erron'=>50002,
                'mag'=>'密码必填'
            ];
            $dd=json_encode($json);
            die($dd);
        }
        $public_key=openssl_get_privatekey("file://".storage_path("key/private.pem"));
        openssl_private_encrypt($pwd,$i,$public_key);
        $base_i=base64_encode($i);
        $where = [
            'user_name'=>$name,
            'password'=>$base_i
        ];
        $res=DB::table('zcc')->insertGetId($where);

        if($res){
           $json=[
               'erron'=>0,
               'mag'=>'注册成功成功',
           ];
           $dd=json_encode($json);
           echo $dd;
        }else{
            $json=[
                'erron'=>50001,
                'mag'=>'出现异常'
            ];
            $dd=json_encode($json);
            echo $dd;
        }
    }

    public  function loginadd(Request $request)
    {
        $name=$request->input('username');
        $pwd=$request->input('pwd');
        if($name==''){
            $json=[
                'erron'=>50002,
                'mag'=>'用户必填'
            ];
            $dd=json_encode($json);
            return $dd;
        }
        if($pwd==''){
            $json=[
                'erron'=>50002,
                'mag'=>'密码必填'
            ];
            $dd=json_encode($json);
            return $dd;
        }
        $where =[
            'user_name'=>$name
        ];
        $res=DB::table('zcc')->where($where)->first();
        if($res){
            $new_data= base64_decode($res->password);
            $public_key=openssl_pkey_get_public("file://".storage_path("key/public.pem"));
             openssl_public_decrypt($new_data,$ii,$public_key);
             if($ii == $pwd){
                 $token=md5(Str::random(15).'lyz'.time());
                 $ksy_token='login_token:uid'.$res->u_id;
                 Redis::set($ksy_token,$token);
                 Redis::expire($ksy_token,259200);
                 $json=[
                     'erron'=>0,
                     'mag'=>'登录成功',
                     'token'=>$token,
                     'uid'=>$res->u_id
                 ];
                 $dd=json_encode($json);
               return $dd;
             }else{
                 $json=[
                     'erron'=>50002,
                     'mag'=>'密码或账号出现错误'
                 ];
                 $dd=json_encode($json);
                 return $dd;
             }
        }else{
            $json=[
                'erron'=>50002,
                'mag'=>'密码或账号出现错误'
            ];
            $dd=json_encode($json);
            return $dd;
        }
    }
    public function agePeople()
    {

        $token=$_GET['token'];
        die($token);
        $uid=$_GET['uid'];
        $ksy_token='login_token:uid'.$uid;
        $redis_token=Redis::get($ksy_token);
        $data_json = [
            'erron'=>0,
            'mag'=>'正在前往个人中心',
            'token'=>$redis_token,
        ];
        $sss=json_encode($data_json);
        die($sss);
        if($redis_token){
            if($token == $redis_token){
                $where =[
                    'u_id'=>$uid
                ];
                $res=DB::table('zcc')->where($where)->first();
                if($res){
                    $data_json = [
                        'erron'=>0,
                        'mag'=>'正在前往个人中心',
                        'u_id'=>$res->u_id,
                        'user_name'=>$res->user_name,
                    ];
                    $sss=json_encode($data_json);
                    die($sss);
                }
            }else{
                $json=[
                    'erron'=>50002,
                    'mag'=>'参数有误,请按照正确途径登录'
                ];
                $dd=json_encode($json);
                return $dd;
            }
        }else{
            $json=[
                'erron'=>50002,
                'mag'=>'参数有误,请按照正确途径登录'
            ];
            $dd=json_encode($json);
            return $dd;
        }
    }

//    public function index(Request $request)
//    {
////        echo 1111;
//        $data=file_get_contents("php://input");
//
//        $new_data=base64_decode($data);
//
//        $public_key=openssl_pkey_get_public("file://".storage_path("key/public.pem"));
//
//        openssl_public_decrypt($new_data,$ii,$public_key);
//
//    }
//
//
//
//
//
//    ///签名
//    public function qm()
//    {
////       echo  $_GET['sign'];
//        $cc=$_GET['sign'];
//        $ii=base64_decode($cc);
//        $data=file_get_contents("php://input");
//
//        $file_key=openssl_pkey_get_public("file://".storage_path('key/public.pem'));
//        $ss=openssl_verify($data,$ii,$file_key);
//        var_dump($ss);
//    }
//
//    public function zc()
//    {
//        $data=file_get_contents("php://input");
//
//        $res=json_decode($data);
//
//        $user_name=$res->u_name;
//        $u_email= $res->u_email;
//        $password= $res->password;
//
////                echo $name;die;
//        $datas=base64_decode($res->password);
//        $file_key=openssl_pkey_get_public("file://".storage_path('key/public.pem'));
//        $cc=openssl_public_decrypt($datas,$ii,$file_key);
//
//        $s= DB::table('zcc')->where(['u_email'=>$u_email])->first();
//        if($s){
//            header('refresh:2;url=http://cliet.lumen1.com/zc');
//            $ss = [
//                'erron'=>00001,
//                'msg'=>'用户已存在'
//            ];
//            $json=json_encode($ss,JSON_UNESCAPED_UNICODE);
//            echo $json;
//        }else{
//            $where=[
//                'user_name'=>$user_name,
//                'u_email'=>$u_email,
//                'password'=>$ii
//            ];
//            $ss=DB::table('zcc')->insertGetId($where);
//            $key='zcc:id:'.$ss;
//            $vvv = Str::random(16).time().'12';
//            $token_s=base64_encode($vvv);
////                echo $token_s;
//            $rcc=Redis::set($key,$token_s);
//            Redis::expire($key,604800);
//            $ss = [
//                'erron'=>0,
//                'msg'=>'添加成功'
//            ];
//            $json=json_encode($ss,JSON_UNESCAPED_UNICODE);
//            echo $json;
//        }
//
//    }

}