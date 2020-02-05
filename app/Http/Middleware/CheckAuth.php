<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // echo "鉴权中间件";die;
        //获取用户id,token
        $uid=$_SERVER['HTTP_UID'];
        $token=$_SERVER['HTTP_TOKEN'];
        //请求passport实现鉴权
        $client= new Client();
        $response=$client->request("POST",'http://1905passport.com/api/auth',[
            'form_params'=>[
            'uid'=>$uid,
            'token'=>$token
            ]
        ]);

        //接收请求响应
        $response_data=$response->getBody();
        $arr=json_decode($response_data,true);
        if($arr['code']>40000){ //鉴权失败
            echo "鉴权失败";die;
        }
        return $next($request);
    }
}
