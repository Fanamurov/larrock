<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Page\PageController@getIndex');

Route::controller('page', 'Page\PageController');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('admin/auth', 'Admin\AuthController@getLogin');
Route::get('admin/auth/login', 'Admin\AuthController@getLogin');
Route::post('admin/auth/login', 'Admin\AuthController@postLogin');
Route::get('admin/auth/logout', 'Admin\AuthController@getLogout');

Route::resource('admin/users', 'Admin\UsersController');

Route::group(['prefix'=>'admin','middleware'=>'AuthAdmin'], function(){
	Route::get('/', 'Admin\PageController@getIndex');
});
