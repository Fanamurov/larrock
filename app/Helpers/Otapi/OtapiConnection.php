<?php

namespace App\Helpers\Otapi;

use Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Psr7\Stream;

class OtapiConnection
{
	protected $instanceKey;
	protected $lang ;
	protected $service_url;

	/** Что делать в случае обнаружения ошибки доступа или API @var mixed  */
	protected $if_error;
	protected $cacheTime;
	/** Включать ли безопасный режим работы сайта. При ограниченном режиме работы API(нет оплаты) @var bool  */
	protected $saveMode;
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode;

	protected $method;
	protected $params;
	protected $url;

	public function __construct()
	{
		$this->instanceKey = 'instanceKey='. env('OTAPI_KEY');
		$this->lang = 'language='. env('OTAPI_LANG', 'ru');
		$this->service_url = env('OTAPI_URL', 'http://otapi.net/OtapiWebService2.asmx/');
		$this->if_error = env('OTAPI_IF_ERROR', 'exception');
		$this->cacheTime = env('OTAPI_CACHE_TIME', 1440);
		$this->saveMode = env('OTAPI_SAVE_MODE', TRUE);
	}

	public function create_request($method, array $params, $allow_safe_mode = FALSE)
	{
		$this->method = $method;
		$this->params = $params;
		$this->url = \URL::current();
		$this->allow_safe_mode = $allow_safe_mode;

		$param_request = '';
		foreach($params as $param_key => $param_value){
			$param_request .= '&'. $param_key .'='. $param_value;
		}

		//echo $method .'_'.$param_request .'<br/>';
		$cacheKey = sha1($method .'_'.$param_request);
		if($method === 'FindCategoryItemInfoListFrame'){
			//dd($this->service_url . $method .'?'. $this->instanceKey .'&'. $this->lang . $param_request);
			//Cache::forget($cacheKey);
		}
		//Cache::forget($cacheKey);

		$body = Cache::remember($cacheKey, $this->cacheTime, function() use ($method, $param_request)
		{
			echo $method .' not cached<br/>';
			$client = new Client();
			//dd($this->service_url . $method .'?'. $this->instanceKey .'&'. $this->lang . $param_request);
			$data = $client->request('GET', $this->service_url . $method .'?'. $this->instanceKey .'&'. $this->lang . $param_request);
			if($this->checkErrorConnection($data)){
				return $this->checkErrorOtapi($this->encodeResult($data->getBody()));
			}
			return FALSE;
		});
		return $body;
	}

	/**
	 * Преобразование результата запроса из xml
	 * @param $data
	 *
	 * @return mixed
	 */
	protected function encodeResult(Stream $data)
	{
		$body = simplexml_load_string($data);
		$body = json_encode($body);
		return json_decode($body);
	}

	/**
	 * Проверка на ошибки соединения с api
	 * Записываем ошибки в лог
	 * @param GuzzleResponse $data
	 *
	 * @return bool
	 */
	protected function checkErrorConnection(GuzzleResponse $data)
	{
		if($this->method === 'GetTradeRateInfoListFrame'){
			//dd($data);
		}

		if($data->getStatusCode() === 200){
			return TRUE;
		}else{
			$context = collect();
			$context->put('reasonPhrase', $data->getReasonPhrase());
			$context->put('statusCode', $data->getStatusCode());
			$context->put('method', $this->method);
			$context->put('params', $this->params);
			$context->put('url', $this->url);
			\Log::error('Не удалось соединиться с api', $context->toArray());
			return FALSE;
		}
	}

	/**
	 * Проверяем на ошибки от Otapi
	 * Записываем ошибки в лог
	 * @param $data
	 *
	 * @return bool
	 */
	protected function checkErrorOtapi($data)
	{
		if($data->ErrorCode !== 'Ok'){
			$context = collect($data);
			$context->put('method', $this->method);
			$context->put('params', $this->params);
			$context->put('url', $this->url);
			\Log::error($data->ErrorDescription, $context->toArray());

			if($this->saveMode === TRUE && $this->allow_safe_mode === TRUE){
				return collect();
			}else{
				if($this->if_error === 'exception'){
					return abort(500, 'Ошибка API метода '. $this->method, $context->toArray());
				}else{
					return FALSE;
				}
			}
		}
		return $data;
	}
}