<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * 在线验签
     */
    public function signOnline1()
    {
    	return view("sign.online");
    }
    /**
     * 在线验签
     */
    public function signOnline2()
    {
    	unset($_POST['_token']);
    	echo '<pre>';print_r($_POST);echo '</pre>';
    	//接受POST参数
    	$sgin=base64_decode($_POST['sign']);
    	unset($_POST['sign']);
    	$data=[];
    	foreach ($_POST['k'] as $key => $value) {
    		if(empty($value)){
    			continue; //跳过空字段
    		}
    		$data[$value]=$_POST["v"][$key];
    	}
    	echo '<pre>';print_r($data);echo '</pre>';
    	//拼接参数
    	$str='';
    	foreach ($data as $key => $value) {
    		$str.=$key."=".$value."&";
    	}
    	$str=rtrim($str,"&");
    	$uid=Auth::id();  //获取用户id
    	$info='';
    }
    /**
     * 验签测试
     */
    public function sign1()
    {
        $sign = base64_decode($_GET['sign']);
        //字典序排序
        unset($_GET['sign']);
        $params = $_GET;
        ksort($params);
        //拼接参数
        $str = "";
        foreach($params as $k=>$v){
            $str .= $k . '=' . $v . '&';
        }
        $str = trim($str,'&');
        //验签
        $uid = Auth::id();      //获取登录用户 uid
        $u = UserPubKeyModel::where(['uid'=>$uid])->first();
        $status = openssl_verify($str,$sign,$u->pubkey,OPENSSL_ALGO_SHA256);
        if($status){
            echo '验签成功!';
        }else{
            echo '验签失败!';
        }
    }
    /**
     * 验签测试
     */
    public function sign2()
    {
        //接收 POST参数
        $sign = base64_decode($_POST['sign']);
        unset($_POST['sign']);
        $params = $_POST;
        //拼接参数
        $str = "";
        foreach($params as $k=>$v){
            $str .= $k . '=' . $v . '&';
        }
        $str = trim($str,'&');
        //验签
        $uid = Auth::id();      //获取登录用户 uid
        $u = UserPubKeyModel::where(['uid'=>$uid])->first();
        $status = openssl_verify($str,$sign,$u->pubkey,OPENSSL_ALGO_SHA256);
        if($status){
            echo '验签成功!';
        }else{
            echo '验签失败!';
        }
    }
}
