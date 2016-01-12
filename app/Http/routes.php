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


Route::group(['middleware'=>'AuthAdmin'], function(){
	Route::resource('admin/users', 'Admin\UsersController');
	Route::resource('admin/roles', 'Admin\RolesController');
	Route::resource('admin/page', 'Admin\PageController');
	Route::resource('admin/seo', 'Admin\SeoController');
	Route::resource('admin/menu', 'Admin\MenuController');
	Route::resource('admin/feed', 'Admin\FeedController');
	Route::resource('admin/catalog', 'Admin\CatalogController');
	Route::resource('admin/category', 'Admin\CategoryController');
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

	Route::get('admin', 'Admin\PageController@index'); //Роут главной страницы админки

	Route::get('/admin/settings/image', 'Admin\Settings\Image@index');
	Route::post('/admin/settings/image', 'Admin\Settings\Image@store');

	Route::get('/admin/blocks/MenuBlock', 'Admin\Blocks\MenuBlock@index');

	Route::get('/admin/wizard', [
		'as' => 'admin.wizard', 'uses' => 'Admin\WizardController@step1'
	]);
	Route::get('/admin/wizard/step2', [
		'as' => 'admin.wizard.step2', 'uses' => 'Admin\WizardController@step2'
	]);
	Route::get('/admin/wizard/step3', [
		'as' => 'admin.wizard.step3', 'uses' => 'Admin\WizardController@step3'
	]);
	Route::get('/admin/wizard/step4', [
		'as' => 'admin.wizard.step4', 'uses' => 'Admin\WizardController@step4'
	]);
});