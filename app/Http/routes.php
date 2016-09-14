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

//REDIRECTS OLD SITE
Route::get('/vidy-otdykha/{item}', [
	'as' => 'redirect.vidy', 'uses' => 'OldSiteController@redirectVidy'
]);
Route::get('/strany/{item}', [
	'as' => 'redirect.strany', 'uses' => 'OldSiteController@redirectStrany'
]);
Route::get('/resort/{item?}', [
	'as' => 'redirect.resort', 'uses' => 'OldSiteController@redirectResort'
]);
Route::get('/articles', [
	'as' => 'redirect.article', 'uses' => 'OldSiteController@redirectArticles'
]);
Route::get('/news/news/{item}', [
	'as' => 'redirect.article', 'uses' => 'OldSiteController@redirectNewsnews'
]);
Route::get('/articles/{item}', [
	'as' => 'redirect.article.item', 'uses' => 'OldSiteController@redirectArticle'
]);
Route::get('/goryashchie-tury', [
	'as' => 'redirect.sletat', 'uses' => 'OldSiteController@redirectSletat'
]);
Route::get('/o-kompanii/novosti', [
	'as' => 'redirect.news', 'uses' => 'OldSiteController@redirectNews'
]);
Route::get('/hot_tours', [
	'as' => 'redirect.hot.tours', 'uses' => 'OldSiteController@redirectHotTours'
]);
//END REDIRECTS OLD SITE

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
Route::get('/blog/{category}', [
	'as' => 'blog.category', 'uses' => 'BlogController@show'
]);
Route::get('/blog/{category}/{item}', [
	'as' => 'blog.item', 'uses' => 'BlogController@getItem'
]);

Route::get('/visovaya-podderjka', [
	'as' => 'visa.main', 'uses' => 'VisaController@index'
]);
Route::get('/visovaya-podderjka/{item}', [
	'as' => 'visa.item', 'uses' => 'VisaController@getItem'
]);

Route::get('/news', [
    'as' => 'news.main', 'uses' => 'NewsController@index'
]);
Route::get('/news/{item}', [
    'as' => 'news.item', 'uses' => 'NewsController@getItem'
]);

//TOURS
Route::post('/tours/search', [
	'as' => 'tours.search', 'uses' => 'ToursController@search'
]);
Route::get('/tours/strany', [
	'as' => 'tours.strany', 'uses' => 'ToursController@getStrany'
]);
Route::get('/tours/strany/{category}', [
	'as' => 'tours.strany', 'uses' => 'ToursController@getCountry'
]);
Route::get('/tours/strany/{category}/{item}', [
	'as' => 'tours.resourt', 'uses' => 'ToursController@getResourt'
]);
Route::get('/tours/strany/{category}/{resourt}/{tour}', [
	'as' => 'tours.tour', 'uses' => 'ToursController@getItem'
]);


Route::get('/tours/vidy-otdykha', [
	'as' => 'tours.vidy-otdykha', 'uses' => 'ToursController@getVidy'
]);

Route::get('/tours/vidy-otdykha/{category}/{country?}/{resort?}', [
	'as' => 'tours.vidy-item', 'uses' => 'ToursController@getVidy'
]);

Route::get('/tours/{category}/{item}', [
	'as' => 'tours.category.item', 'uses' => 'ToursController@getItem'
]);

Route::get('/search/tours', [
	'as' => 'search.tours', 'uses' => 'ToursController@searchItem'
]);
//TOURS END

//HOTELS
Route::get('/hotels', [
    'as' => 'hotels.all', 'uses' => 'HotelsController@getHotels'
]);
Route::get('/hotels/{item}', [
    'as' => 'hotels.item', 'uses' => 'HotelsController@getItem'
]);
//HOTELS_END

Route::any('/sletat', [
	'as' => 'sletat.form', 'uses' => 'SletatController@getFullSearchForm'
]);
Route::get('/sletat/GetLoadState/{requestId}', [
    'as' => 'sletat.GetLoadState', 'uses' => 'SletatController@getLoadState'
]);
Route::post('/sletat/GetToursUpdated/{requestId}/{count?}', [
	'as' => 'sletat.GetToursUpdated', 'uses' => 'SletatController@GetToursUpdated'
]);
Route::post('/sletat/GetToursUpdatedShort/{requestId}/{count?}', [
	'as' => 'sletat.GetToursUpdatedShort', 'uses' => 'SletatController@GetToursUpdatedShort'
]);
Route::get('/sletat/ActualizePrice', [
    'as' => 'sletat.ActualizePrice', 'uses' => 'SletatController@getActualizePrice'
]);

Route::get('/flight', [
	'as' => 'flight.index', 'uses' => 'Flightstatus@index'
]);


//Forms
Route::post('/forms/contact', [
	'as' => 'submit.contacts', 'uses' => 'Modules\Forms@send_form'
]);
Route::post('/forms/corporate', [
	'as' => 'submit.corporate', 'uses' => 'Modules\Forms@send_corporate'
]);
Route::post('/forms/zakazTura', [
	'as' => 'submit.zakazTura', 'uses' => 'Modules\Forms@send_formZakazTura'
]);
Route::post('/forms/zakazHotel', [
	'as' => 'submit.zakazHotel', 'uses' => 'Modules\Forms@send_formZakazHotel'
]);
Route::post('/forms/zakazSert', [
	'as' => 'submit.zakazSert', 'uses' => 'Modules\Forms@send_formZakazSert'
]);
Route::get('/forms/podbor', [
    'as' => 'submit.podbor', 'uses' => 'Modules\Forms@formPodbor'
]);
Route::post('/forms/podbor', [
	'as' => 'submit.podbor', 'uses' => 'Modules\Forms@send_formPodbor'
]);
Route::post('/forms/sletatOrderShort', [
	'as' => 'submit.sletatOrderShort', 'uses' => 'Modules\Forms@send_formsletatOrderShort'
]);
Route::post('/forms/sletatOrderFull', [
	'as' => 'submit.sletatOrderFull', 'uses' => 'Modules\Forms@send_formsletatOrderFull'
]);

//Ajax
Route::post('/ajax/sharingCounter', [
	'as' => 'ajax.sharingCounter', 'uses' => 'Ajax@sharingCounter'
]);
Route::post('/ajax/getResortsByCountry', [
	'as' => 'ajax.getResortsByCountry', 'uses' => 'Ajax@getResortsByCountry'
]);

Route::get('/strahovki/success', [
	'as' => 'strahovki.success', 'uses' => 'StrahovkiController@success'
]);
Route::get('/strahovki/fail', [
	'as' => 'strahovki.fail', 'uses' => 'StrahovkiController@fail'
]);

// Authentication routes...
Route::auth();

Route::get('/sitemap_generate', [
    'as' => 'generate.sitemap', 'uses' => 'SitemapController@index'
]);
Route::get('feed.rss', [
	'as' => 'generate.ress', 'uses' => 'SitemapController@rss'
]);

Route::group(['prefix' => 'admin', 'middleware'=>'level:2'], function(){
	Route::resource('users', 'Admin\AdminUsersController');
	Route::resource('roles', 'Admin\AdminRolesController');
	Route::resource('page', 'Admin\AdminPageController');
	Route::resource('seo', 'Admin\AdminSeoController');
	Route::resource('menu', 'Admin\AdminMenuController');
	Route::resource('feed', 'Admin\AdminFeedController');
	Route::resource('blog', 'Admin\AdminBlogController');
	Route::resource('news', 'Admin\AdminNewsController');
	Route::resource('visa', 'Admin\AdminVisaController');
	Route::get('tours/all', [
		'as' => 'all.tours.admin', 'uses' => 'Admin\AdminToursController@showTours'
	]);
	Route::get('users/author/{userId?}', [
		'as' => 'admin.users.author', 'uses' => 'Admin\AdminUsersController@getAuthor'
	]);
	Route::resource('tours', 'Admin\AdminToursController');
	Route::post('/tours/search', [
		'as' => 'admin.tours.search', 'uses' => 'Admin\AdminToursController@search'
	]);

    Route::post('/hotels/search', [
        'as' => 'admin.hotels.search', 'uses' => 'Admin\AdminHotelsController@search'
    ]);
    Route::get('hotels/all', [
        'as' => 'all.hotels.admin', 'uses' => 'Admin\AdminHotelsController@showHotels'
    ]);
    Route::resource('hotels', 'Admin\AdminHotelsController');

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
		'as' => 'admin.index', 'uses' => 'Admin\AdminUsersController@getAuthor'
	]); //Роут главной страницы админки

	Route::get('/mails', [
		'as' => 'admin.mails', 'uses' => 'Admin\AdminDashboardController@index'
	]);

	Route::get('/blocks/MenuBlock', 'Admin\AdminBlocks\MenuBlock@index');
});