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
//测试
Route::get("test/md5SignGet","TestController@md5SignGet"); //签名测试 
Route::get("test/md5SignPost","TestController@md5SignPost"); //签名测试
Route::get("test/md5","TestController@MD5"); //测试


Route::get("postman","TestController@postman")->middleware("check.auth"); //防刷
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
//商品管理
Route::get("admin/goods/create","Goods\GoodsController@create"); //商品添加
Route::get("admin/goods/index","Goods\GoodsController@index"); //商品列表
Route::get("admin/goods/edit","Goods\GoodsController@edit"); //商品修改
//订单管理
Route::get("admin/order/index","Admin\OrderController@index"); //订单管理


$router->resource('goods', GoodsController::class);


