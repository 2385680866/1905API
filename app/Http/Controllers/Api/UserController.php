<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommonModel;

class UserController extends Controller
{
    /**
     * 用户注册
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function reg()
    {
        //请求地址
        $url="http://1905passport.com/api/reg";
        //发送请求
        $response=CommonModel::curlPost($url,$_POST);
        dd($response);
    }
    /**
     * 用户登录接口
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        //请求地址
        $url="http://1905passport.com/api/login";
        //发送请求
        $response=CommonModel::curlPost($url,$_POST);
        dd($response);
    }
    /**
     * 用户列表
     * @return [type] [description]
     */
    public function userList()
    {
        //接收数据
        $uid=$_SERVER['HTTP_UID'];
        $token=$_SERVER['HTTP_TOKEN'];
        $header=[
            "uid:".$uid,
            "token:".$token
        ];
        //请求地址
        $url="http://1905passport.com/api/list";
        //发送请求
        CommonModel::curlGet($url,$header);
    }
    /**
     * 鉴权
     * @return [type] [description]
     */
    public function auth()
    {
        $uid=$_SERVER['HTTP_UID'];
        $token=$_SERVER['HTTP_TOKEN'];
        //请求地址
        $url="http://1905passport.com/api/auth";
        //发送请求
        $response=CommonModel::curlPost($url,['uid'=>$uid,"token"=>$token]);
        dd($response);
    }
}