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

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('level:2');

Route::get('/page/{url}', [
	'as' => 'page', 'uses' => 'PageController@getItem'
]);

Route::get('/', [
	'as' => 'mainpage', 'uses' => 'MainpageController@index'
]);

Route::get('/otzyvy', [
	'as' => 'otzyvy', 'uses' => 'OpinionsController@index'
]);

Route::get('/blog', [
	'as' => 'blog.main', 'uses' => 'BlogController@index'
]);
Route::get('/blog/{item}', [
	'as' => 'blog.item', 'uses' => 'BlogController@getItem'
]);

Route::get('/feed/visovaya-podderjka', [
	'as' => 'visa.main', 'uses' => 'FeedController@index'
]);
Route::get('/feed/visovaya-podderjka/{item}', [
	'as' => 'visa.item', 'uses' => 'FeedController@getItem'
]);

Route::get('/news', [
    'as' => 'news.main', 'uses' => 'NewsController@index'
]);
Route::get('/news/{item}', [
    'as' => 'news.item', 'uses' => 'NewsController@getItem'
]);

//TOURS
Route::get('/tours/all', [
	'as' => 'tours.all', 'uses' => 'ToursController@getAllTours'
]);
Route::get('/tours/strany', [
	'as' => 'tours.strany', 'uses' => 'ToursController@getStrany'
]);
Route::get('/tours/strany/{category}', [
	'as' => 'tours.strany', 'uses' => 'ToursController@getCategory'
]);
Route::get('/tours/strany/{category}/{item}', [
	'as' => 'tours.resourt', 'uses' => 'ToursController@getResourt'
]);

Route::get('/tours/vidy-otdykha', [
	'as' => 'tours.vidy-otdykha', 'uses' => 'ToursController@getVidy'
]);
Route::get('/tours/vidy-otdykha/{category}', [
	'as' => 'tours.vidy-categories', 'uses' => 'ToursController@getCategory'
]);
Route::get('/tours/vidy-otdykha/{category}/{item}', [
	'as' => 'tours.vidy-item', 'uses' => 'ToursController@getResourt'
]);

/*Route::get('/tours/{category}/{child}', [
	'as' => 'tours.category.child', 'uses' => 'ToursController@getCountry'
]);*/

Route::get('/tours/{category}/{item}', [
	'as' => 'tours.category.item', 'uses' => 'ToursController@getItem'
]);

Route::get('/search/tours', [
	'as' => 'search.tours', 'uses' => 'ToursController@searchItem'
]);
//TOURS END

Route::any('/sletat', [
	'as' => 'sletat.form', 'uses' => 'SletatController@getFullSearchForm'
]);
Route::get('/sletat/GetLoadState/{requestId}', [
    'as' => 'sletat.GetLoadState', 'uses' => 'SletatController@getLoadState'
]);
Route::post('/sletat/GetToursUpdated/{requestId}', [
	'as' => 'sletat.GetToursUpdated', 'uses' => 'SletatController@GetToursUpdated'
]);
Route::get('/sletat/ActualizePrice', [
    'as' => 'sletat.ActualizePrice', 'uses' => 'SletatController@getActualizePrice'
]);

Route::get('/cart', [
	'as' => 'cart.index', 'uses' => 'CartController@getIndex'
]);

//Forms
Route::post('/forms/contact', [
	'as' => 'submit.contacts', 'uses' => 'Modules\Forms@send_form'
]);

// Authentication routes...
Route::auth();

Route::group(['prefix' => 'admin', 'middleware'=>'level:2'], function(){
	Route::resource('users', 'Admin\AdminUsersController');
	Route::resource('roles', 'Admin\AdminRolesController');
	Route::resource('page', 'Admin\AdminPageController');
	Route::resource('seo', 'Admin\AdminSeoController');
	Route::resource('menu', 'Admin\AdminMenuController');
	Route::resource('feed', 'Admin\AdminFeedController');
	//Route::resource('catalog', 'Admin\AdminCatalogController');
	Route::resource('tours', 'Admin\AdminToursController');
	Route::resource('slideshow', 'Admin\AdminSlideshowController');

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

	Route::get('/blocks/MenuBlock', 'Admin\AdminBlocks\MenuBlock@index');
});