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
	'as' => 'mainpage', 'uses' => 'CatalogController@getMainCategory'
]);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/page/{url}', 'PageController@getItem');

Route::get('/catalog', [
	'as' => 'catalog.index', 'uses' => 'CatalogController@getMainCategory'
]);
Route::get('/catalog/{category}', [
	'as' => 'catalog.category', 'uses' => 'CatalogController@getCategory'
]);
Route::get('/catalog/{category}/{child}', [
	'as' => 'catalog.category.child', 'uses' => 'CatalogController@getCategory'
]);
Route::get('/catalog/{category}/{child}/{grandson}', [
	'as' => 'catalog.category.grandson', 'uses' => 'CatalogController@getCategory'
]);
Route::get('/catalog/{category}/{child}/{grandson}/{item}', [
	'as' => 'catalog.category.grandson', 'uses' => 'CatalogController@getItem'
]);

Route::get('/search/catalog', [
	'as' => 'search.catalog', 'uses' => 'CatalogController@searchItem'
]);

Route::post('/ajax/editPerPage', [
	'as' => 'ajax.editPerPage', 'uses' => 'Ajax@editPerPage'
]);

Route::get('/modules/ListCatalog', [
	'as' => 'modules.listCatalog', 'uses' => 'Modules\ListCatalog@categories'
]);


Route::get('admin/auth', 'Admin\AdminAuthController@getLogin');
Route::get('admin/auth/login', 'Admin\AdminAuthController@getLogin');
Route::post('admin/auth/login', 'Admin\AdminAuthController@postLogin');
Route::get('admin/auth/logout', 'Admin\AdminAuthController@getLogout');

Route::group(['middleware'=>'AuthAdmin'], function(){
	Route::resource('admin/users', 'Admin\AdminUsersController');
	Route::resource('admin/roles', 'Admin\AdminRolesController');
	Route::resource('admin/page', 'Admin\AdminPageController');
	Route::resource('admin/seo', 'Admin\AdminSeoController');
	Route::resource('admin/menu', 'Admin\AdminMenuController');
	Route::resource('admin/feed', 'Admin\AdminFeedController');
	Route::resource('admin/catalog', 'Admin\AdminCatalogController');
	Route::resource('admin/category', 'Admin\AdminCategoryController');
	Route::resource('admin/blocks', 'Admin\AdminBlocksController');
	Route::post('/admin/category/storeEasy', 'Admin\AdminCategoryController@storeEasy');

	Route::post('admin/ajax/EditRow', 'Admin\AdminAjax@EditRow');
	Route::post('admin/ajax/ClearCache', 'Admin\AdminAjax@ClearCache');

    Route::post('admin/ajax/UploadImage', 'Admin\AdminAjax@UploadImage');
    Route::post('admin/ajax/getLoadedImages', 'Admin\AdminAjax@getLoadedImages');
    Route::post('admin/ajax/getImageParams', 'Admin\AdminAjax@getImageParams');
    Route::post('admin/ajax/destroyImage', 'Admin\AdminAjax@destroyImage');

	Route::post('admin/ajax/UploadFile', 'Admin\AdminAjax@UploadFile');
	Route::post('admin/ajax/getLoadedFiles', 'Admin\AdminAjax@getLoadedFiles');
	Route::post('admin/ajax/getFileParams', 'Admin\AdminAjax@getFileParams');
	Route::post('admin/ajax/destroyFile', 'Admin\AdminAjax@destroyFile');

    Route::post('admin/ajax/Typograph', 'Admin\AdminAjax@Typograph');
    Route::post('admin/ajax/TypographLight', 'Admin\AdminAjax@TypographLight');
    Route::post('admin/ajax/Translit', 'Admin\AdminAjax@Translit');

	Route::post('admin/ajax/UploadFile', 'Admin\AdminAjax@UploadFile');

	Route::get('admin', 'Admin\AdminPageController@index'); //Роут главной страницы админки

	Route::get('admin/cart', 'Admin\AdminCartController@index');

	Route::get('/admin/settings/image', 'Admin\AdminSettings\Image@index');
	Route::post('/admin/settings/image', 'Admin\AdminSettings\Image@store');

	Route::get('/admin/blocks/MenuBlock', 'Admin\AdminBlocks\MenuBlock@index');

	Route::get('/admin/wizard', [
		'as' => 'admin.wizard', 'uses' => 'Admin\AdminWizardController@aliases'
	]);
	Route::get('/admin/wizard/check', [
		'as' => 'admin.wizard.check', 'uses' => 'Admin\AdminWizardController@check'
	]);
	Route::get('/admin/wizard/import', [
		'as' => 'admin.wizard.import', 'uses' => 'Admin\AdminWizardController@import'
	]);

	Route::post('/admin/wizard', 'Admin\AdminWizardController@storeConfig');
});