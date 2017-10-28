<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
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
Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/', 'Admin\IndexController@index')->name('admin.home');

        Route::resource('admin','Admin\AdminController');

        Route::get('permission/child/{permission}','Admin\PermissionController@childIndex')->name('permission.child');
        Route::resource('permission','Admin\PermissionController');

        Route::resource('role','Admin\RoleController');

        Route::get('test1', 'Admin\Auth\LoginController@showLoginForm')->name('test1.index');
    });
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.loginout');

    Route::get('/home', 'HomeController@index')->name('home');
});


