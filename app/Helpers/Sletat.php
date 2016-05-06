<?php

namespace App\Helpers;

use Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use GuzzleHttp;
use Session;

class Sletat{

    protected $url = 'http://module.sletat.ru/Main.svc';
    protected $loginSletat = 'paltsev@santa-avia.ru';
    protected $passwordSletat = 'asdfg098';
    protected $timeout = 30;
    protected $login_params = '?login=paltsev@santa-avia.ru&password=asdfg098';

	public $country_list = [];

	public function __construct()
	{
		$this->country_list = $this->GetCountries(1286);
	}

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
        return $data;
    }

    public function getFullSearchForm(Request $request)
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
		$data['GetStars'] = Cache::remember('GetStars', 60, function() use ($data) {
			return $this->GetHotelStars(29, '372,1592,1642');
		});

		if($request->has('cityFromId')){
			$key_cache = '';
			foreach ($request->all() as $value){
				$key_cache .= $value;
			}
			$key_cache = sha1($key_cache);
			$data['GetTours'] = Cache::remember('GetTours'. $key_cache, 60, function() use ($data, $request) {
				$cityFromId = $request->get('cityFromId', $data['GetDepartCities']->first()->Id);
				$countryId = $request->get('countryId', $data['GetCountries']->first()->Id);
				$addict_params = [];
				$explode_date = explode(' - ', $request->get('date-int')); //04/11/2016 - 04/22/2016
				if(array_key_exists(1, $explode_date)){
					$addict_params['s_departFrom'] = trim($explode_date[0]);
					$addict_params['s_departTo'] = trim($explode_date[1]);
				}
				$addict_params['s_priceMin'] = $request->get('s_priceMin');
				$addict_params['s_priceMax'] = $request->get('s_priceMax');
				$addict_params['s_nightsMin'] = $request->get('s_nightsMin', 1);
				$addict_params['s_nightsMax'] = $request->get('s_nightsMax', 29);
				$addict_params['s_adults'] = $request->get('s_adults', 2);
				$addict_params['s_kids'] = $request->get('s_kids', 0);
				$addict_params['stars'] = $request->get('stars');
				return $this->GetTours($cityFromId, $countryId, $addict_params);
			});

			if($data['GetTours']['hotelsCount'] < 1){
				Cache::forget('GetTours'. $key_cache);
			}
		}

        return $data;
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
		$GetDepartCities= Cache::rememberForever('GetDepartCities', function() {
			$this->url = 'http://module.sletat.ru/Main.svc/GetDepartCities'. $this->login_params;
			$result = $this->sendRequest();
			return collect($result->GetDepartCitiesResult->Data);
		});
		if(count($GetDepartCities) < 1){
			Cache::forget('GetDepartCities');
		}
		return $GetDepartCities;
    }

    /**
     * Метод GetCountries возвращает список доступных направлений для любого
     * данного города вылета. В личном кабинете на сайте sletat.ru вы можете
     * поставить на этот список различные фильтры, чтобы в ответ возвращались
     * данные только о тех странах, с которыми вы работаете. Список городов
     * вылета получается методом GetDepartCities.
     *
     * @param int	$townFromId*	 целочисленный идентификатор города вылета.
     *
     * @return Collection
     */
    public function GetCountries($townFromId = 1286)
    {
		$GetCountries = Cache::rememberForever('GetCountries'. $townFromId, function() use ($townFromId) {
			$this->url = 'http://module.sletat.ru/Main.svc/GetCountries'. $this->login_params .'&townFromId='. $townFromId;
			$result = $this->sendRequest();
			return collect($result->GetCountriesResult->Data);
		});
		if(count($GetCountries) < 1){
			Cache::forget('GetCountries'. $townFromId);
		}
        return $GetCountries;
    }

    /**
     * Метод GetCities возвращает список курортов для выбранного направления.
     * Список направлений получается методом GetCountries.
     *
     * @param int	$countryId*		целочисленный идентификатор направления
     *
     * @return Collection
     */
    public function GetCities($countryId = 3)
    {
		$GetCities = Cache::rememberForever('GetCities'. $countryId, function() use ($countryId) {
			$this->url = 'http://module.sletat.ru/Main.svc/GetCities'. $this->login_params .'&countryId='. $countryId;
			$result = $this->sendRequest();
			return collect($result->GetCitiesResult->Data);
		});
		if(count($GetCities) < 1){
			Cache::forget('GetCities'. $countryId);
		}
		return $GetCities;
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
     * @param   int     $countryId*      Идентификатор страны
     * @param   string  $towns*          Идентификаторы курортов, разделённые запятой
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
     * @param   int     $dptCityId*      Идентификатор города вылета
     * @param   int     $countryId*      Идентификатор страны
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
	 * НЕТ ЛИЦЕНЗИИ
	 * Поиск горящих туров
     * Метод GetTours используется для создания поискового запроса, а также – если в запросе
     * передаётся параметр requestId и параметр updateResult=1 – для получения результатов
     * поиска по запросу.
     *
     * @param   int     $cityFromId *       Идентификатор города вылета
     * @param   int     $countryId *        Идентификатор направления перелета
     * @param   array   $addict_params      Дополнительные параметры для поиска
     * @param   int     $pageSize           Результатов на странице
     * @return
     */
    public function GetToursShowcase($cityFromId, $countryId, $addict_params = [], $pageSize = 30)
    {
        $this->url = 'http://module.sletat.ru/Main.svc/GetTours'. $this->login_params .'&countryId='. $countryId
            .'&cityFromId='. $cityFromId .'&s_hotelIsNotInStop=true&s_hasTickets=true&s_ticketsIncluded=true'
            .'&updateResult=0&includeDescriptions=1&includeOilTaxesAndVisa=0&pageSize='. $pageSize .'&pageNumber=1&s_showcase=true&groupBy=ht_minhotelprices';
        foreach ($addict_params as $key => $item){
            $this->url .= '&'.$key .'='. $item;
        }
        $result = $this->sendRequest();
		//dd($result);
        return collect($result->GetToursResult->Data);
    }

	/**
	 * НЕТ ЛИЦЕНЗИИ
	 * @return mixed
	 */
	public function GetTemplates()
	{
		$this->url = 'http://module.sletat.ru/Main.svc/GetTemplates'. $this->login_params .'&templatesList=all';
		$result = $this->sendRequest();
		//dd($result);
		return collect($result->GetTemplatesResult->Data);
	}

	/**
	 * Метод GetTours используется для создания поискового запроса, а также – если в запросе
	 * передаётся параметр requestId и параметр updateResult=1 – для получения результатов
	 * поиска по запросу.
	 *
	 * @param   int     $cityFromId *       Идентификатор города вылета
	 * @param   int     $countryId *        Идентификатор направления перелета
	 * @param   array   $addict_params      Дополнительные параметры для поиска
	 * @param   int     $pageSize           Результатов на странице
	 * @return
	 */
	public function GetTours($cityFromId, $countryId, $addict_params = [], $pageSize = 30)
	{
		$this->url = 'http://module.sletat.ru/Main.svc/GetTours'. $this->login_params .'&countryId='. $countryId
			.'&cityFromId='. $cityFromId .'&s_hotelIsNotInStop=true&s_hasTickets=true&s_ticketsIncluded=true'
			.'&updateResult=0&includeDescriptions=1&includeOilTaxesAndVisa=0&pageSize='. $pageSize .'&pageNumber=1&groupBy=ht_minhotelprices';
		foreach ($addict_params as $key => $item){
			$this->url .= '&'.$key .'='. $item;
		}
		//dd($this->url);
		$result = $this->sendRequest();
		//dd($result->GetToursResult->Data);
		return collect($result->GetToursResult->Data);
	}

	public function GetToursUpdated(Request $request, $requestId, $pageSize = 30)
	{
		$cityFromId = $request->get('cityFromId', 1286);
		$countryId = $request->get('countryId');
		$addict_params = [];
		$explode_date = explode(' - ', $request->get('date-int')); //04/11/2016 - 04/22/2016
		if(array_key_exists(1, $explode_date)){
			$addict_params['s_departFrom'] = trim($explode_date[0]);
			$addict_params['s_departTo'] = trim($explode_date[1]);
		}
		if( !array_key_exists('s_departFrom', $addict_params)){
			$addict_params['s_departFrom'] = date('d/m/Y');
			$addict_params['s_departTo'] = date('d/m/Y', mktime(0, 0, 0, date('m')+1, date('d'), date('Y')));
		}
		$addict_params['s_priceMin'] = $request->get('s_priceMin');
		$addict_params['s_priceMax'] = $request->get('s_priceMax');
		$addict_params['s_nightsMin'] = $request->get('s_nightsMin', 7);
		$addict_params['s_nightsMax'] = $request->get('s_nightsMax', 29);
		$addict_params['s_adults'] = $request->get('s_adults', 2);
		$addict_params['s_kids'] = $request->get('s_kids');
		$addict_params['stars'] = $request->get('stars');
		$pageNumber = $request->get('pageNumber', 1);

		$this->url = 'http://module.sletat.ru/Main.svc/GetTours'. $this->login_params .'&countryId='. $countryId
			.'&cityFromId='. $cityFromId .'&s_hotelIsNotInStop=true&s_hasTickets=true&s_ticketsIncluded=true'
			.'&updateResult=1&includeDescriptions=1&includeOilTaxesAndVisa=1&groupBy=hotel'
			.'&pageSize='. $pageSize .'&pageNumber='. $pageNumber .'&requestId='. $requestId;
		foreach ($addict_params as $key => $item){
			$this->url .= '&'.$key .'='. $item;
		}
		//dd($this->url);
		$result = $this->sendRequest();
		//dd($result);
		return collect($result->GetToursResult->Data);
	}

    /**
     * Метод GetLoadState возвращает статус обработки запроса для каждого туроператора.
     *
     * @param $requestId
     * @return mixed		Процент выполнения запроса
     */
    public function GetLoadState($requestId = '1658708531')
    {
        $this->url = 'http://module.sletat.ru/Main.svc/GetLoadState'. $this->login_params .'&requestId='. $requestId;
        $result = $this->sendRequest();
        $data = collect($result->GetLoadStateResult->Data);
		if($data[0]->IsError === true){
			abort('503', 'Некорректный запрос '. $data[0]->ErrorMessage);
		}
		$all = count($data); //Общее количество операторов поиска
		$load = 0; //Сколько загружено
		foreach($data as $value){
			if($value->IsProcessed === true){
				++$load;
			}
		}
		$result = ceil(($load*100)/$all);
        return $result;
    }

    /**
     * Метод ActualizePrice необходим для актуализации предложений туроператоров.
     * Он проверяет наличие билетов и мест в отеле, топливных и визовых сборов,
     * а также других обязательных доплат и, при наличии, прибавляет их к стоимости тура.
     *
     * @param   int $sourceId *          Шифрованный идентификатор туроператора
     * @param   int $offerId *           Идентификатор ценового предложения (тура)
     * @param   int $countryId *         Идентификатор направления
     * @param   int $requestId *         Идентификатор поискового запроса
     * @param   string $currencyAlias *     Валюта. Возможные значения: USD, EUR, RUB
     * @param   int $showcase *          Включение режима выдачи для горящих туров
     * @param   Request $request
     * @return mixed
     */
    public function ActualizePrice(Request $request, $sourceId = 0, $offerId = 0, $countryId = 0, $requestId = 0, $currencyAlias = 'RUB', $showcase = 0)
    {
        $sourceId = $request->get('sourceId', $sourceId);
        $offerId = $request->get('offerId', $offerId);
        $countryId = $request->get('countryId', $countryId);
        $requestId = $request->get('requestId', $requestId);

        $this->url = 'http://module.sletat.ru/Main.svc/ActualizePrice'. $this->login_params .'&requestId='. $requestId
            .'&sourceId='. $sourceId .'&offerId='. $offerId .'&currencyAlias='. $currencyAlias .'&showcase='. $showcase
            .'&countryId='. $countryId;
        $result = $this->sendRequest();
        return collect($result->ActualizePriceResult->Data);
    }

	/**
	 * Метод SaveTourOrder добавляет заказ тура в систему Слетать.ру. В вашем личном кабинете на сайте sletat.ru вы
	 * можете настроить SMS- и email-уведомления о новых заказах.
	 *
	 * @param Request $request
	 * @param int     $searchRequestId		Идентификатор поискового запроса
	 * @param int     $sourceId				Шифрованный идентификатор туроператора
	 * @param int     $offerId				Идентификатор ценового предложения (тура)
	 * @param string  $user					Имя заказчика
	 * @param string  $email				Электронная почта заказчика
	 * @param string  $phone				Телефон заказчика
	 * @param string  $info					Комментарий заказчика
	 * @param string  $countryName			Направление
	 * @param string  $cityFromName			Город вылета
	 * @param string  $currencyAlias		Валюта. Допустимые значения: USD, EUR, RUR, BYR.
	 */
	public function SaveTourOrder(Request $request, $searchRequestId = 0, $sourceId = 0, $offerId = 0, $user = '', $email = '',
								  $phone = '', $info = '', $countryName = '', $cityFromName = '', $currencyAlias = 'RUB')
	{
		$searchRequestId = $request->get('searchRequestId', $searchRequestId);
		$sourceId = $request->get('sourceId', $sourceId);
		$offerId = $request->get('offerId', $offerId);
		$user = $request->get('name', $user);
		$email = $request->get('email', $email);
		$phone = $request->get('tel', $phone);
		$info = $request->get('comment', $info);
		$countryName = $request->get('countryName', $countryName);
		$cityFromName = $request->get('cityFromName', $cityFromName);
		$currencyAlias = $request->get('currencyAlias', $currencyAlias);
		//и т.д. прописать

		$this->url = 'http://module.sletat.ru/Main.svc/SaveTourOrder'. $this->login_params .'&searchRequestId='. $searchRequestId
		.'&sourceId'. $sourceId .'&offerId'. $offerId .'&user'. $user .'&email'. $email .'&phone'. $phone .'&info'. $info
			.'&countryName'. $countryName .'&cityFromName'. $cityFromName .'&currencyAlias'. $currencyAlias;
		dd($this->url);
		$result = $this->sendRequest();
		dd($result);
		return collect($result->HotelInformation->Data);
	}

}