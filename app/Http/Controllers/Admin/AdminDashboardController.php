<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use App\Models\FormsLog;
use Breadcrumbs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins;
use App\Helpers\Component;
use Route;
use View;

class AdminDashboardController extends Controller
{
	protected $config;

	public function __construct(MenuBlock $menu)
	{
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}

		Breadcrumbs::register('admin.dashboard.index', function($breadcrumbs){
			$breadcrumbs->push('CRM', route('admin.index'));
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['zakazTura'] = FormsLog::whereFormname('zakazTura')->orderBy('created_at', 'DESC')->take(5)->get();
		$data['count']['all']['zakazTura'] = FormsLog::whereFormname('zakazTura')->count();
		$data['count']['new']['zakazTura'] = FormsLog::whereFormname('zakazTura')->whereStatus('Новое')->count();

		$data['zakazHotel'] = FormsLog::whereFormname('zakazHotel')->orderBy('created_at', 'DESC')->take(5)->get();
		$data['count']['all']['zakazHotel'] = FormsLog::whereFormname('zakazHotel')->count();
		$data['count']['new']['zakazHotel'] = FormsLog::whereFormname('zakazHotel')->whereStatus('Новое')->count();

		$data['contact'] = FormsLog::whereFormname('contact')->orderBy('created_at', 'DESC')->take(5)->get();
		$data['count']['all']['contact'] = FormsLog::whereFormname('contact')->count();
		$data['count']['new']['contact'] = FormsLog::whereFormname('contact')->whereStatus('Новое')->count();

		$data['zakazSert'] = FormsLog::whereFormname('zakazSert')->orderBy('created_at', 'DESC')->take(5)->get();
		$data['count']['all']['zakazSert'] = FormsLog::whereFormname('zakazSert')->count();
		$data['count']['new']['zakazSert'] = FormsLog::whereFormname('zakazSert')->whereStatus('Новое')->count();

		$data['formPodbor'] = FormsLog::whereFormname('formPodbor')->orderBy('created_at', 'DESC')->take(5)->get();
		$data['count']['all']['formPodbor'] = FormsLog::whereFormname('formPodbor')->count();
		$data['count']['new']['formPodbor'] = FormsLog::whereFormname('formPodbor')->whereStatus('Новое')->count();

		$data['formsletatOrderShort'] = FormsLog::whereFormname('formsletatOrderShort')->orderBy('created_at', 'DESC')->take(5)->get();
		$data['count']['all']['formsletatOrderShort'] = FormsLog::whereFormname('formsletatOrderShort')->count();
		$data['count']['new']['formsletatOrderShort'] = FormsLog::whereFormname('formsletatOrderShort')->whereStatus('Новое')->count();

		$data['formsletatOrderFull'] = FormsLog::whereFormname('formsletatOrderFull')->orderBy('created_at', 'DESC')->take(5)->get();
		$data['count']['all']['formsletatOrderFull'] = FormsLog::whereFormname('formsletatOrderFull')->count();
		$data['count']['new']['formsletatOrderFull'] = FormsLog::whereFormname('formsletatOrderFull')->whereStatus('Новое')->count();

		return view('admin.dashboard.panels', $data);
	}
}
