<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
});
Route::get("gitpull","TestController@gitPull"); //自动上线
Route::get("test/pay","TestController@alipay"); //去支付
Route::get("test/alipay/return","Alpay\PayController@aliReturn"); //同步
Route::get("test/alipay/notify","Alpay\PayController@notify"); //异步

//验签
Route::get("sign/online","Admin\SignController@signOnline1"); //验签页面
Route::post("sign/signonlie","Admin\SignController@signOnline2"); //在线验签
Route::get('/sign/sign1','Admin\SignController@sign1');
Route::post('/sign/sign2','Admin\SignController@sign2');

//解密数据
Route::get("user/decrypt","Admin\UserPubKeyController@decrypt1"); //解密数据页面
Route::post("user/decrypt","Admin\UserPubKeyController@decrypt2"); //解密数据执行
//用户管理
Route::get("user/addkey","Admin\UserPubKeyController@addSSHKey1"); //添加公钥页面
Route::post("user/addkey","Admin\UserPubKeyController@addSSHKey2"); //添加公钥执行

Route::middleware(['token'])->group(function () {
	Auth::routes();
});
