<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPubKeyModel;

class UserPubKeyController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * [addSSHKey description]
	 */
    public function addSSHKey1()
    {
    	$data=[];
    	return view("user.addkey");
    }
    /**
     * 用户添加公钥
     */
    public function addSSHKey2()
    {
    	$key=trim($_POST['sshkey']);
    	dd($_POST);
    	$uid=Auth::id();
    	$user_name=Auth::user()->name;
    	$data=[
    		"uid"=>$uid,
    		"user_name"=>$user_name,
    		"pubkey"=>trim($key)
    	];
    	//如果有记录则删除
    	UserPubKeyModel::where(["uid"=>$uid])->delete();
    	//添加新纪录
    	$kid=UserPubKeyModel::insertGetId($data);
    	if($kid){
    		//页面跳转
    		header("Refresh:3;url=".env('APP_url')."/home");
    		echo "添加成功 公钥内容: >>></br>".$key;
    		echo "</br>";
    		echo "页面跳转中";
    	}
    }
    /**
     * 解密页面
     */
    public function decrypt1()
    {
    	return view("user.decrypt");
    }
    /**
     * 解密
     */
    public function decrypt2()
    {
    	$enc_data=trim($_POST['enc_data']);
    	echo "加密数据:".$enc_data;echo "</br>";
    	//解密
    	$uid=1;//Auth::id();
    	$info=UserPubKeyModel::where(["uid"=>$uid])->first();
    	$pub_key=$info->pubkey;
    	openssl_public_decrypt(base64_decode($enc_data),$decrypted,$pub_key);
    	echo "<hr>";
    	echo "解密数据:".$decrypted;
    }
}
