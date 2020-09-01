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

Route::get('/', function () {
    return view('welcome');
});

Route::get('basic1', function(){
    return 'HELLO WORLD！';
});

Route::get('member/info','Controller2@info');

Route::any('test1', ['uses' => 'StuController@test1']);


//查询构造器
//查询构造器新增数据
Route::any('tableInsertDB', 'stuController@tableInsertDB');
//查询构造器修改数据
Route::any('tableUpdateDB', 'stuController@tableUpdateDB');
Route::any('tableDeleteDB', 'stuController@tableDeleteDB');
Route::any('tableSelectDB', 'stuController@tableSelectDB');


//ORM
Route::any('tableSelectORM', 'stuController@tableSelectORM');
Route::any('tableInsertORM', 'stuController@tableInsertORM');
Route::any('tableUpdateORM', 'stuController@tableUpdateORM');
Route::any('tabledeleteORM', 'stuController@tabledeleteORM');

//两种形式都可以，后者的urll是别名 别名和url一样
Route::any('section1', 'stuController@section1');
Route::any('url', ['as'=>'urll','uses'=>'stuController@url']);
Route::any('request1', 'stuController@request1');


//宣传
Route::any('activity0', 'stuController@activity0');
// 活动
Route::group(['middleware'=> ['Activity']],function(){
    Route::any('activity1', 'stuController@activity1');
});




//在App/Http/Kernel文件下 有个web的下面有个StarSession相当于php里的SessionStart
Route::group(['middlewqre' => 'web'], function () {
    Route::any('session1', 'stuController@session1');
    Route::any('session2', 'stuController@session2');   
    Route::any('response2', 'stuController@response2');
});
Route::any('response', 'stuController@response');
// Route::any('response', 'stuController@response');
// Route::any('response', 'stuController@response');


Route::group(['middlewqre' => 'web'], function () {
    Route::any('wxLogin', 'WxLoginController@wxLogin');
    Route::any('wxRegister', 'WxLoginController@wxRegister');
});



