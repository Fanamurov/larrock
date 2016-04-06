<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use GuzzleHttp;

use App\Http\Requests;

/* DOCS: http://wiki.sletat.ru/w/Шлюз_поиска_туров_(json) */
class SletatController extends Controller
{
	protected $url = 'http://module.sletat.ru/Main.svc';
	protected $loginSletat = 'paltsev@santa-avia.ru';
	protected $passwordSletat = 'asdfg098';
	protected $timeout = 30;
	protected $login_params = '?login=paltsev@santa-avia.ru&password=asdfg098';

	/**
	 * Краткая форма поиска тура
	 * @return mixed
	 */
    public function getSearchForm()
	{
		//Cache::flush();
		$data['GetDepartCities'] = Cache::remember('GetDepartCities', 60, function() {
		    return $this->GetDepartCities();
		});
		$data['GetCountries'] = Cache::remember('GetCountries', 60, function() use ($data) {
		    return $this->GetCountries($data['GetDepartCities']->first()->Id);
		});
		return view('santa.modules.forms.sletatShort', $data);
	}

	public function getFullSearchForm()
	{
		//Cache::flush();
		$data['GetDepartCities'] = Cache::remember('GetDepartCities', 60, function() {
			return $this->GetDepartCities();
		});
		$data['GetCountries'] = Cache::remember('GetCountries', 60, function() use ($data){
			return $this->GetCountries($data['GetDepartCities']->first()->Id);
		});
		$data['GetCities'] = Cache::remember('GetCities', 60, function() {
			return $this->GetCities();
		});
		$data['GetHotels'] = Cache::remember('GetHotels', 60, function() use ($data) {
			return $this->GetHotels($data['GetDepartCities']->first()->Id);
		});
		return view('santa.sletat.searchForm', $data);
	}

	/**
	 * Формирование запроса к api sletat.ru
	 * @return mixed
	 */
	protected function sendRequest()
	{
		$client = new GuzzleHttp\Client();
		$res = $client->get($this->url, ['login' => $this->loginSletat, 'password' => $this->passwordSletat]);
		if($res->getStatusCode() === 200){
			$data = (string) $res->getBody();
			return json_decode($data);
		}else{
			abort('503', 'Модуль поиска не доступен');
		}
	}

	/**
	 * Метод GetDepartCities возвращает список всех городов вылета,
	 * который вы можете отредактировать в личном кабинете на сайте sletat.ru.
	 *
	 * @return Collection
	 */
	protected function GetDepartCities()
	{
		$this->url = 'http://module.sletat.ru/Main.svc/GetDepartCities'. $this->login_params;
		$result = $this->sendRequest();
		return collect($result->GetDepartCitiesResult->Data);
	}

	/**
	 * Метод GetCountries возвращает список доступных направлений для любого
	 * данного города вылета. В личном кабинете на сайте sletat.ru вы можете
	 * поставить на этот список различные фильтры, чтобы в ответ возвращались
	 * данные только о тех странах, с которыми вы работаете. Список городов
	 * вылета получается методом GetDepartCities.
	 *
	 * @param int	$townFromId	 целочисленный идентификатор города вылета.
	 *
	 * @return Collection
	 */
	public function GetCountries($townFromId = 1286)
	{
		$this->url = 'http://module.sletat.ru/Main.svc/GetCountries'. $this->login_params .'&townFromId='. $townFromId;
		$result = $this->sendRequest();
		return collect($result->GetCountriesResult->Data);
	}

	/**
	 * Метод GetCities возвращает список курортов для выбранного направления.
	 * Список направлений получается методом GetCountries.
	 *
	 * @param int	$countryId		целочисленный идентификатор направления
	 *
	 * @return Collection
	 */
	public function GetCities($countryId = 3)
	{
		$this->url = 'http://module.sletat.ru/Main.svc/GetCities'. $this->login_params .'&countryId='. $countryId;
		$result = $this->sendRequest();
		return collect($result->GetCitiesResult->Data);
	}

	/**
	 * Метод GetHotels возвращает список доступных отелей в выбранной стране. Список
	 * отелей может быть отфильтрован по массиву курортов и категорий отелей, а также
	 * по названию самого отеля.
	 *
	 * @param 	int		$countryId		Идентификатор направления
	 * @param 	string	$towns			Идентификаторы городов, разделённые запятыми
	 * @param	string	$stars			Идентификаторы категорий отелей, разделённые запятыми
	 * @param	string	$filter			Фильтрация по названию отеля.
	 * @param   string 	$all 			Количество отелей в выдаче. Возможные значения:
	 *                       			“-1” – в выдачу попадают все отели; любое положительное
	 *                       			целое число – точное количество отелей.
	 *
	 * @return Collection
	 */
	public function GetHotels($countryId, $towns = '', $stars = '', $filter = '', $all = '-1')
	{
		$this->url = 'http://module.sletat.ru/Main.svc/GetCities'. $this->login_params .'&countryId='. $countryId
			.'&towns'. $towns .'&stars'. $stars .'&filter'. $filter .'&all='. $all;
		$result = $this->sendRequest();
		return collect($result->GetCitiesResult->Data);
	}
}
