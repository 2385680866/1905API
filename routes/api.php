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
// 接口
Route::post('/user/reg','Api\TestController@reg');          //用户注册
Route::post('user/login','Api\TestController@login');      //用户登录
Route::get('/user/list','Api\TestController@userList')->middleware('token');      //用户列表