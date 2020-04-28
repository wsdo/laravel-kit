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
//Route::post('login', 'V1\AuthController@login')->name('login');

//登录不使用中间件
// Route::namespace('V1')->middleware('no.auth')->group(function(){
//     Route::post('login', 'AuthController@login');
// });

// Route::namespace('V1')->middleware('refresh.token')->group(function () {
//     Route::get('ding', 'UserController@ding');
// });
// //权限验证
// Route::namespace('V1')->middleware('role.control')->group(function(){

// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::get('login', 'V1\AuthController@login')->name('login');

Route::get('hehe', function () {
    return response()->json([
        "message"=>'hehe',
    ]);
});

// 不需要token验证
Route::namespace('V1')->middleware('next')->group(function () {
    Route::get('stark', 'StarkController@stark');
});

// 需要token验证
Route::namespace('V1')->middleware('interceptor')->group(function () {
    Route::get('shudong', 'StarkController@shudong');
});
