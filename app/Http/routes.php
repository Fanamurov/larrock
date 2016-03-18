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

/*Route::get('/', [
	'as' => 'mainpage', 'uses' => 'CatalogController@getMainCategory'
]);*/

//Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/page/{url}', [
	'as' => 'page', 'uses' => 'PageController@getItem'
]);

Route::get('/', [
	'as' => 'catalog.index', 'uses' => 'CatalogController@getMainCategory'
]);
Route::get('/catalog', function()
{
	return Redirect::to('/');
});

Route::get('/catalog/all', [
	'as' => 'catalog.all', 'uses' => 'CatalogController@getAllTovars'
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
	'as' => 'catalog.category.grandson.item', 'uses' => 'CatalogController@getItem'
]);

Route::get('/search/catalog', [
	'as' => 'search.catalog', 'uses' => 'CatalogController@searchItem'
]);

Route::post('/ajax/editPerPage', [
	'as' => 'ajax.editPerPage', 'uses' => 'Ajax@editPerPage'
]);
Route::post('/ajax/sort', [
	'as' => 'ajax.sort', 'uses' => 'Ajax@sort'
]);
Route::post('/ajax/vid', [
	'as' => 'ajax.vid', 'uses' => 'Ajax@vid'
]);
Route::post('/ajax/cartAdd', [
	'as' => 'ajax.cartAdd', 'uses' => 'Ajax@cartAdd'
]);
Route::post('/ajax/cartRemove', [
	'as' => 'ajax.cartRemove', 'uses' => 'Ajax@cartRemove'
]);
Route::post('/ajax/cartQty', [
	'as' => 'ajax.cartQty', 'uses' => 'Ajax@cartQty'
]);
Route::post('/ajax/getTovar', [
	'as' => 'ajax.getTovar', 'uses' => 'Ajax@getTovar'
]);

Route::get('/modules/ListCatalog', [
	'as' => 'modules.listCatalog', 'uses' => 'Modules\ListCatalog@categories'
]);

Route::get('/cart', [
	'as' => 'cart.index', 'uses' => 'CartController@getIndex'
]);

//Forms
Route::post('/forms/contact', [
	'as' => 'submit.contacts', 'uses' => 'Modules\Forms@send_form'
]);


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['prefix' => 'admin', 'middleware'=>'level:2'], function(){
	Route::resource('users', 'Admin\AdminUsersController');
	Route::resource('roles', 'Admin\AdminRolesController');
	Route::resource('page', 'Admin\AdminPageController');
	Route::resource('seo', 'Admin\AdminSeoController');
	Route::resource('menu', 'Admin\AdminMenuController');
	Route::resource('feed', 'Admin\AdminFeedController');
	Route::resource('catalog', 'Admin\AdminCatalogController');
	Route::resource('category', 'Admin\AdminCategoryController');
	Route::resource('blocks', 'Admin\AdminBlocksController');
	Route::post('/category/storeEasy', 'Admin\AdminCategoryController@storeEasy');

	Route::post('ajax/EditRow', 'Admin\AdminAjax@EditRow');
	Route::post('ajax/ClearCache', 'Admin\AdminAjax@ClearCache');

    Route::post('ajax/UploadImage', 'Admin\AdminAjax@UploadImage');
    Route::post('ajax/getLoadedImages', 'Admin\AdminAjax@getLoadedImages');
    Route::post('ajax/getImageParams', 'Admin\AdminAjax@getImageParams');
    Route::post('ajax/destroyImage', 'Admin\AdminAjax@destroyImage');

	Route::post('ajax/UploadTempImage', 'Admin\AdminAjax@UploadImage');
	Route::post('ajax/GetUploadedImage', 'Admin\AdminAjax@GetUploadedImage');
	Route::post('ajax/DeleteUploadedImage', 'Admin\AdminAjax@DeleteUploadedImage');
	Route::post('ajax/CustomProperties', 'Admin\AdminAjax@CustomProperties');


	Route::post('ajax/UploadFile', 'Admin\AdminAjax@UploadFile');
	Route::post('ajax/GetUploadedFile', 'Admin\AdminAjax@GetUploadedFile');
	Route::post('ajax/getFileParams', 'Admin\AdminAjax@getFileParams');
	Route::post('ajax/DeleteUploadedFile', 'Admin\AdminAjax@DeleteUploadedFile');

    Route::post('ajax/Typograph', 'Admin\AdminAjax@Typograph');
    Route::post('ajax/TypographLight', 'Admin\AdminAjax@TypographLight');
    Route::post('ajax/Translit', 'Admin\AdminAjax@Translit');

	Route::post('ajax/UploadFile', 'Admin\AdminAjax@UploadFile');

	Route::get('/', [
		'as' => 'admin.home', 'uses' => 'Admin\AdminPageController@index'
	]); //Роут главной страницы админки

	Route::get('cart', 'Admin\AdminCartController@index');

	Route::get('/settings/image', 'Admin\AdminSettings\Image@index');
	Route::post('/settings/image', 'Admin\AdminSettings\Image@store');
	Route::post('/settings/image/generate', [
		'as' => 'admin.image.generate', 'uses' => 'Admin\AdminSettings\Image@generate'
	]);

	Route::get('/blocks/MenuBlock', 'Admin\AdminBlocks\MenuBlock@index');

	Route::get('/wizard', [
		'as' => 'admin.wizard', 'uses' => 'Admin\AdminWizardController@aliases'
	]);
	Route::get('/wizard/check', [
		'as' => 'admin.wizard.check', 'uses' => 'Admin\AdminWizardController@check'
	]);
	Route::get('/wizard/import', [
		'as' => 'admin.wizard.import', 'uses' => 'Admin\AdminWizardController@import'
	]);

	Route::post('/wizard', 'Admin\AdminWizardController@storeConfig');
});