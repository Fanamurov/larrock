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
            return $this->GetTours($cityFromId, $countryId, $addict_params);
        });

        if($data['GetTours']['hotelsCount'] < 1){
            Cache::forget('GetTours'. $key_cache);
        }

        /*Cache::forget('ActualizePrice');
        if($request->has('requestId')){
            $data['ActualizePrice'] = Cache::remember('ActualizePrice', 60, function() use ($data, $request) {
                $sourceId = $request->get('sourceId', '2110148712');
                $offerId = $request->get('offerId', '210038070');
                $countryId = $request->get('countryId', '113');
                $requestId = $request->get('requestId', '1658015561');
                return $this->ActualizePrice($sourceId, $offerId, $currencyAlias = 'RUB', $showcase = 0, $countryId, $requestId);
            });
        }*/

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
     * @param int	$townFromId*	 целочисленный идентификатор города вылета.
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
     * @param int	$countryId*		целочисленный идентификатор направления
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
            .'&cityFromId='. $cityFromId .'&s_hotelIsNotInStop=false&s_hasTickets=true&s_ticketsIncluded=true'
            .'&updateResult=0&includeDescriptions=1&includeOilTaxesAndVisa=0&pageSize='. $pageSize .'&pageNumber=1';
        foreach ($addict_params as $key => $item){
            $this->url .= '&'.$key .'='. $item;
        }
        //dd($this->url);
        $result = $this->sendRequest();
        return collect($result->GetToursResult->Data);
    }

	public function GetToursUpdated(Request $request, $requestId)
	{
		$cityFromId = $request->get('cityFromId');
		$countryId = $request->get('countryId');
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

		$this->url = 'http://module.sletat.ru/Main.svc/GetTours'. $this->login_params .'&countryId='. $countryId
			.'&cityFromId='. $cityFromId .'&s_hotelIsNotInStop=false&s_hasTickets=true&s_ticketsIncluded=true'
			.'&updateResult=1&includeDescriptions=1&includeOilTaxesAndVisa=0&pageSize='. $pageSize = 30 .'&pageNumber=1&requestId='. $requestId;
		foreach ($addict_params as $key => $item){
			$this->url .= '&'.$key .'='. $item;
		}
		$result = $this->sendRequest();
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
        dd(collect($result->ActualizePriceResult->Data));
        return collect($result->ActualizePriceResult->Data);
    }

    public function GetHotelInformation($hotelId)
    {
        $this->url = 'http://module.sletat.ru/Main.svc/GetHotelInformation'. $this->login_params .'&hotelId='. $hotelId;
        $result = $this->sendRequest();
        dd($result);
        return collect($result->HotelInformation->Data);
    }

}