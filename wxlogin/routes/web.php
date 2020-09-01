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

Route::group(['middlewqre' => 'web'], function () {
    Route::any('wxLogin', 'WxLoginController@wxLogin');
    Route::any('wxRegister', 'WxLoginController@wxRegister');
    Route::any('login', 'WxLoginController@yemian');
});