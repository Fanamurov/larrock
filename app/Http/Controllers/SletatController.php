<?php

namespace App\Http\Controllers;

use Breadcrumbs;
use Illuminate\Http\Request;
use GuzzleHttp;
use App\Helpers\Sletat;

/* DOCS: http://wiki.sletat.ru/w/Шлюз_поиска_туров_(json) */
class SletatController extends Controller
{
	protected $url = 'http://module.sletat.ru/Main.svc';
	protected $loginSletat = 'paltsev@santa-avia.ru';
	protected $passwordSletat = 'asdfg098';
	protected $timeout = 30;
	protected $login_params = '?login=paltsev@santa-avia.ru&password=asdfg098';

    public function __construct(Sletat $sletat)
    {
        Breadcrumbs::register('sletat.main', function($breadcrumbs)
        {
            $breadcrumbs->push('Каталог туров');
        });
		$this->middleware('loaderModules');
    }

    /**
     * @param Request $request
     * @param Sletat $sletat
     * @return mixed
     */
    public function getFullSearchForm(Request $request, Sletat $sletat)
	{
        $data = $sletat->getFullSearchForm($request);
		$data['paginator']['all'] = $data['GetTours']['iTotalDisplayRecords'];
		$data['paginator']['pages'] = ceil($data['GetTours']['iTotalDisplayRecords']/30);
		$data['paginator']['current'] = $request->get('pageNumber', 1);
		return view('santa.sletat.searchForm', $data);
	}

	public function getLoadState(Sletat $sletat, $requestId)
	{
		echo $sletat->GetLoadState($requestId);
	}

	public function GetToursUpdated(Request $request, Sletat $sletat, $requestId)
	{
		$data['GetTours'] = $sletat->GetToursUpdated($request, $requestId);
		$data['full_load'] = 'TRUE';
		$data['paginator']['all'] = $data['GetTours']['iTotalDisplayRecords'];
		$data['paginator']['pages'] = ceil($data['GetTours']['iTotalDisplayRecords']/30);
		$data['paginator']['current'] = $request->get('pageNumber', 1);
		return view('santa.sletat.searchResult', $data);
	}

	public function getActualizePrice(Request $request, Sletat $sletat)
	{
		return view('santa.sletat.loadTour');
		//$data['ActualizePrice'] = $sletat->ActualizePrice($request);
		//dd($data);
	}
}
