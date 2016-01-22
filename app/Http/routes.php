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

Route::get('/', [
	'as' => 'mainpage', 'uses' => 'PageController@getItem'
]);

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

Route::get('/page/{url}', 'PageController@getItem');

Route::get('/catalog', 'CatalogController@getCategory');


Route::group(['middleware'=>'AuthAdmin'], function(){
	Route::resource('admin/users', 'Admin\UsersController');
	Route::resource('admin/roles', 'Admin\RolesController');
	Route::resource('admin/page', 'Admin\AdminPageController');
	Route::resource('admin/seo', 'Admin\SeoController');
	Route::resource('admin/menu', 'Admin\MenuController');
	Route::resource('admin/feed', 'Admin\FeedController');
	Route::resource('admin/catalog', 'Admin\AdminCatalogController');
	Route::resource('admin/category', 'Admin\CategoryController');
	Route::resource('admin/blocks', 'Admin\AdminBlocksController');
	Route::post('/admin/category/storeEasy', 'Admin\CategoryController@storeEasy');

	Route::post('admin/ajax/EditRow', 'Admin\Ajax@EditRow');
	Route::post('admin/ajax/ClearCache', 'Admin\Ajax@ClearCache');

    Route::post('admin/ajax/UploadImage', 'Admin\Ajax@UploadImage');
    Route::post('admin/ajax/getLoadedImages', 'Admin\Ajax@getLoadedImages');
    Route::post('admin/ajax/getImageParams', 'Admin\Ajax@getImageParams');
    Route::post('admin/ajax/destroyImage', 'Admin\Ajax@destroyImage');

	Route::post('admin/ajax/UploadFile', 'Admin\Ajax@UploadFile');
	Route::post('admin/ajax/getLoadedFiles', 'Admin\Ajax@getLoadedFiles');
	Route::post('admin/ajax/getFileParams', 'Admin\Ajax@getFileParams');
	Route::post('admin/ajax/destroyFile', 'Admin\Ajax@destroyFile');

    Route::post('admin/ajax/Typograph', 'Admin\Ajax@Typograph');
    Route::post('admin/ajax/TypographLight', 'Admin\Ajax@TypographLight');
    Route::post('admin/ajax/Translit', 'Admin\Ajax@Translit');

	Route::post('admin/ajax/UploadFile', 'Admin\Ajax@UploadFile');

	Route::get('admin', 'Admin\AdminPageController@index'); //Роут главной страницы админки

	Route::get('admin/cart', 'Admin\CartController@index');

	Route::get('/admin/settings/image', 'Admin\Settings\Image@index');
	Route::post('/admin/settings/image', 'Admin\Settings\Image@store');

	Route::get('/admin/blocks/MenuBlock', 'Admin\Blocks\MenuBlock@index');

	Route::get('/admin/wizard', [
		'as' => 'admin.wizard', 'uses' => 'Admin\WizardController@aliases'
	]);
	Route::get('/admin/wizard/check', [
		'as' => 'admin.wizard.check', 'uses' => 'Admin\WizardController@check'
	]);
	Route::get('/admin/wizard/import', [
		'as' => 'admin.wizard.import', 'uses' => 'Admin\WizardController@import'
	]);

	Route::post('/admin/wizard', 'Admin\WizardController@storeConfig');
});