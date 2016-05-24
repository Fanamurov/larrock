<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Breadcrumbs;
use Illuminate\Http\Request;
use GuzzleHttp;
use App\Helpers\Sletat;

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
		$data['siteSearch'] = '';

		$countryId = $request->get('countryId');
		foreach($data['GetCountries'] as $value){
			if($value->Id == $countryId){
				$data['countryFind'] = $value->Name;
			}
		}

		if(array_key_exists('countryFind', $data)){
			$data['siteSearch']['categories'] = Category::search($data['countryFind'])->with(['get_toursActive', 'get_childActive.get_toursActive'])->get();
		}

		return view('santa.sletat.searchForm', $data);
	}

	public function getLoadState(Sletat $sletat, $requestId)
	{
		echo $sletat->GetLoadState($requestId);
	}

	public function GetToursUpdated(Request $request, Sletat $sletat, $requestId)
	{
		$data['GetTours'] = $sletat->GetToursUpdated($request, $requestId);
		$get_country = $sletat->country_list;
		foreach($get_country as $value){
			if($value->Id == $request->get('countryId')){
				$data['countryFind'] = $value->Name;
			}
		}
		$data['date_start'] = explode(' - ', $request->get('date-int'));
		$data['date_start'] = $data['date_start'][0];
		$data['full_load'] = 'TRUE';
		$data['paginator']['all'] = $data['GetTours']['iTotalDisplayRecords'];
		$data['paginator']['pages'] = ceil($data['GetTours']['iTotalDisplayRecords']/30);
		$data['paginator']['current'] = $request->get('pageNumber', 1);
		return view('santa.sletat.searchResult', $data);
	}

	public function GetToursUpdatedShort(Request $request, Sletat $sletat, $requestId)
	{
		$data['GetTours'] = $sletat->GetToursUpdated($request, $requestId, 4);
		$data['full_load'] = 'TRUE';
		$data['paginator']['all'] = $data['GetTours']['iTotalDisplayRecords'];
		return view('santa.sletat.searchResultShort', $data);
	}

	public function getActualizePrice(Request $request, Sletat $sletat)
	{
		$countryId = $request->get('countryId');
		$data['GetCountries'] = $sletat->GetCountries($townFromId = 1286);
		foreach($data['GetCountries'] as $value){
			if($value->Id == $countryId){
				$countryFind = $value->Name;
			}
		}

		if(isset($countryFind)){
			if($countryFind === 'Таиланд'){
				$countryFind = 'Тайланд';
			}
			$data['siteSearch']['categories'] = Category::search($countryFind)->with(['get_toursActive', 'get_childActive.get_toursActive'])->get();
		}

		$data['request'] = $request->all();
		$data['item'] = $sletat->ActualizePrice($request);
		return view('santa.sletat.loadTour', $data);
	}

	public function SaveTourOrder(Request $request, Sletat $sletat)
	{
		$data['item'] = $sletat->SaveTourOrder($request);
		return view('santa.sletat.loadTour', $data);
	}
}
