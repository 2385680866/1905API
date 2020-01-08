<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
class CheckToken
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
        //检查是否有TOKEN值
        if(isset($_SERVER["HTTP_TOKEN"])){
            //如果有TOKEN
            $redis_key="str:count:u:".$_SERVER['HTTP_TOKEN'].":url:".$_SERVER['REQUEST_URI'];
            $count=Redis::get($redis_key);
            var_dump($count);
            //判断是否超过5次
            if($count>=5){
                Redis::expire($redis_key,60);
                //如果超过则提示
                $response=[
                    "erron"=>40004,
                    "msg"=>"接口请求已达上限,请一分钟后再试"
                ];
                exit(json_encode($response,JSON_UNESCAPED_UNICODE));
            }
            //计算数量
            Redis::incr($redis_key);
        }else{
            //如果没有
            $response=[
                "erron"=>40003,
                "msg"=>"未授权"
            ];
            exit(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        return $next($request);
    }
}
