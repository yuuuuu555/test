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

Route::get('/User', function () {
    return view('user.welcome');
});
// Route::get('/admin', function () {
//     return view('admin.auth.login');
// });


Auth::routes();



// 用户
Route::group(['prefix' => 'user'], function () {

    Route::auth();
    // books
    Route::any('books', 'Auth\UserBooksController@indexU');
    Route::any('booksDetail/{id}', 'Auth\UserBooksController@detail');
    Route::any('booksSelectID', 'Auth\UserBooksController@selectID');
    Route::any('booksSelectName', 'Auth\UserBooksController@selectName');
    Route::any('booksSelectRetrieval', 'Auth\UserBooksController@selectRetrieval');
    Route::any('booksSelectStatus', 'Auth\UserBooksController@selectStatus');

    // appointment
    Route::any('booksAppointment/{idB}/{idU}', 'Auth\AppointmentController@appointment');
    // user
    Route::any('userdetail/{id}', 'Auth\UUsersController@detail');


});




// 管理员
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::any('/books', 'Admin\AdminBooksController@indexM');
        // admin's and books's message
        Route::any('booksUpdate/{id}', 'Admin\AdminBooksController@update');
        Route::any('booksDetail/{id}', 'Admin\AdminBooksController@detail');
        Route::any('booksDelete/{id}', 'Admin\AdminBooksController@delete');
        Route::any('booksSelectID', 'Admin\AdminBooksController@selectID');
        Route::any('booksSelectName', 'Admin\AdminBooksController@selectName');
        Route::any('booksSelectRetrieval', 'Admin\AdminBooksController@selectRetrieval');
        Route::any('booksSelectStatus', 'Admin\AdminBooksController@selectStatus');
        Route::any('booksCreate', 'Admin\AdminBooksController@create');
        // user's message
        Route::any('usersIndex', 'Admin\AUsersController@index');
        Route::any('usersDetail/{id}', 'Admin\AUsersController@detail');
        Route::any('usersDelete/{id}', 'Admin\AUsersController@delete');
        Route::any('usersUpdate/{id}', 'Admin\AUsersController@update');
        Route::any('usersSelectName', 'Admin\AUsersController@selectName');
        Route::any('usersSelectID', 'Admin\AUsersController@selectID');
    });
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login');
    Route::post('logout', 'Admin\Auth\LoginController@logout');
    // Route::get('/home', 'BooksController@indexM')->name('home');
});
