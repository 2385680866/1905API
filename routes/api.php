<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// 用户接口
Route::post('/reg','Api\UserController@reg');     //用户注册
Route::post('/login','Api\UserController@login'); //用户登录
Route::get('/list','Api\UserController@userList')->middleware("token");//用户列表
Route::post('/auth','Api\UserController@auth')->middleware("token","check.auth");    //鉴权




