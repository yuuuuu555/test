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
    // users
    Route::get('usersIndex','UsersController@index');
    Route::any('usersCreate','UsersController@create');
    Route::any('usersSave','UsersController@save');
    Route::any('usersUpdate/{id}','UsersController@update');
    Route::any('usersDetail/{id}','UsersController@detail');
    Route::any('usersDelete/{id}','UsersController@delete');
    Route::any('usersSelectName','UsersController@selectName');
    Route::any('usersSelectID','UsersController@selectID');
    //books
    Route::get('booksIndex','BooksController@index');
    Route::any('booksCreate','BooksController@create');
    Route::any('booksSave','BooksController@save');
    Route::any('booksUpdate/{id}','BooksController@update');
    Route::any('booksDetail/{id}','BooksController@detail');
    Route::any('booksDelete/{id}','BooksController@delete');
    Route::any('booksSelectID','BooksController@selectID');
});