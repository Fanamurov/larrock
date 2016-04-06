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
	 * @param	string	$filter			Фильтрация по названию отеля
	 *
	 * @return Collection
	 */
	public function GetHotels($countryId, $towns = '', $stars = '', $filter = '')
	{
		$this->url = 'http://module.sletat.ru/Main.svc/GetCities'. $this->login_params .'&countryId='. $countryId
			.'&towns'. $towns .'&stars'. $stars .'&filter'. $filter .'&all=-1';
		$result = $this->sendRequest();
		return collect($result->GetCitiesResult->Data);
	}

    /**
     * Метод GetHotelStars возвращает список доступных категорий отелей в выбранных курортах.
     * @param   int     $countryId      Идентификатор страны
     * @param   string  $towns          Идентификаторы курортов, разделённые запятой
     *
     * @return Collection
     */
    public function GetHotelStars($countryId, $towns)
    {
        $this->url = 'http://module.sletat.ru/Main.svc/GetHotelStars'. $this->login_params .'&countryId='. $countryId
        .'&towns'. $towns;
		$result = $this->sendRequest();
		return collect($result->GetHotelStarsResult->Data);
    }

    /**
     * Метод GetMeals возвращает список типов питания
     *
     * @return mixed
     */
    public function GetMeals()
    {
        $this->url = 'http://module.sletat.ru/Main.svc/GetMeals'. $this->login_params;
        $result = $this->sendRequest();
        return collect($result->GetMealsResult->Data);
    }

    /**
     * Метод GetTourDates возвращает список доступных дат вылета для выбранных города
     * вылета, страны и курорта, используя внутреннюю статистику, собранную по ранее найденным турам.
     *
     * @param   int     $dptCityId      Идентификатор города вылета
     * @param   int     $countryId      Идентификатор страны
     * @param   string  $resorts        Список идентификаторов курортов, разделённых запятой
     * @param   string  $sources        Список идентификаторов туроператоро, разделенных запятой
     */
    public function GetTourDates($dptCityId, $countryId, $resorts = '', $sources = '')
    {
        $this->url = 'http://module.sletat.ru/Main.svc/GetTourDates'. $this->login_params .'&countryId='. $countryId
            .'&dptCityId'. $dptCityId .'&resorts='. $resorts .'&sources='. $sources;
        $result = $this->sendRequest();
        return collect($result->GetTourDatesResult->Data);
    }


    /** ----  Методы загрузки туров  ----- */

    /**
     * Метод GetTours используется для создания поискового запроса, а также – если в запросе
     * передаётся параметр requestId и параметр updateResult=1 – для получения результатов
     * поиска по запросу.
     *
     * @param   int     $cityFromId     Идентификатор города вылета
     * @param   int     $countryId      Идентификатор направления перелета
     * @param   array   $addict_params  Дополнительные параметры для поиска
     */
    public function GetTours($cityFromId, $countryId, $addict_params = array(''))
    {
        $this->url = 'http://module.sletat.ru/Main.svc/GetTourDates'. $this->login_params .'&countryId='. $countryId
            .'&cityFromId'. $cityFromId;
        foreach ($addict_params as $key => $item){
            $this->url .= '&'.$key .'='. $item;
        }
        $result = $this->sendRequest();
        return collect($result->GetTourDatesResult->Data);
    }
}
