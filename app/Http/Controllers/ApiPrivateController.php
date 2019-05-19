<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis; 

class ApiPrivateController extends BaseController
{
    //
    public function index(Request $request)
    {
//        echo 1111;
        $data=file_get_contents("php://input");

        $new_data=base64_decode($data);

        $public_key=openssl_pkey_get_public("file://".storage_path("key/public.pem"));

        openssl_public_decrypt($new_data,$ii,$public_key);

    }





    ///签名
    public function qm()
    {
//       echo  $_GET['sign'];
        $cc=$_GET['sign'];
        $ii=base64_decode($cc);
        $data=file_get_contents("php://input");

        $file_key=openssl_pkey_get_public("file://".storage_path('key/public.pem'));
        $ss=openssl_verify($data,$ii,$file_key);
        var_dump($ss);
    }

    public function zc()
    {
        $data=file_get_contents("php://input");

        $res=json_decode($data);

                $user_name=$res->u_name;
                $u_email= $res->u_email;
                $password= $res->password;

//                echo $name;die;
        $datas=base64_decode($res->password);
        $file_key=openssl_pkey_get_public("file://".storage_path('key/public.pem'));
        $cc=openssl_public_decrypt($datas,$ii,$file_key);

       $s= DB::table('zcc')->where(['u_email'=>$u_email])->first();
        if($s){
            header('refresh:2;url=http://cliet.lumen1.com/zc');
                $ss = [
                    'erron'=>00001,
                    'msg'=>'用户已存在'
                ];
                $json=json_encode($ss,JSON_UNESCAPED_UNICODE);
               echo $json;
        }else{
            $where=[
                'user_name'=>$user_name,
                'u_email'=>$u_email,
                'password'=>$ii
            ];
                $ss=DB::table('zcc')->insertGetId($where);
                $key='zcc:id:'.$ss;
                $vvv = Str::random(16).time().'12';
                $token_s=base64_encode($vvv);
//                echo $token_s;
            $rcc=Redis::set($key,$token_s);
            Redis::expire($key,604800);
            $ss = [
                'erron'=>0,
                'msg'=>'添加成功'
            ];
            $json=json_encode($ss,JSON_UNESCAPED_UNICODE);
            echo $json;
        }

    }

}