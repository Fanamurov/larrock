<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Cache;
use Illuminate\Pagination\Paginator;

class Otapi extends Controller
{
	protected $instanceKey = 'instanceKey=531ed6b5-8ebb-4100-9f19-1077ad3b7ff2';
	protected $lang = 'language=ru';
	protected $service_url = 'http://otapi.net/OtapiWebService2.asmx/';

	public function create_request($method, $params = [])
	{
		$param_request = '';
		foreach($params as $param_key => $param_value){
			$param_request .= '&'. $param_key .'='. $param_value;
		}

		$cacheKey = md5($method .'_'.$param_request);
		//Cache::forget($cacheKey);
		if(Cache::has($cacheKey)){
			$body = Cache::get($cacheKey, 'NONE');
		}else{
			$client = new Client();
			$data = $client->request('GET', $this->service_url . $method .'?'. $this->instanceKey .'&'. $this->lang . $param_request);
			$body = $data->getBody();
			//Cache::add($cacheKey, $body, 60);
		}

		return simplexml_load_string($body);
	}

    public function get_index()
	{
		$body = $this->create_request('GetRootCategoryInfoList');
		return view('otapi.categoryList', ['data' => $body->CategoryInfoList->Content]);
	}

	public function get_category($categoryId = 'otc-3035')
	{
		if($getSub = $this->get_subCategoryList($categoryId)){
			return $getSub;
		}else{
			return $this->get_tovarsCategory($categoryId);
		}
	}

	public function get_subCategoryList($parentCategoryId)
	{
		$body = $this->create_request('GetCategorySubcategoryInfoList', ['parentCategoryId' => $parentCategoryId]);
		if(count($body->CategoryInfoList->Content->Item) > 0){
			return view('otapi.categoryList', ['data' => $body->CategoryInfoList->Content]);
		}else{
			return NULL;
		}
	}

	/**
	 * Получение частичного списка товаров категории
	 *
	 * @param string $categoryId
	 * @param int    $framePosition
	 * @param int    $frameSize
	 *
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function get_tovarsCategory($categoryId = 'otc-3035', $framePosition = 0, $frameSize = 10)
	{
		$body['data'] = $this->create_request('GetCategoryItemInfoListFrame', [
			'categoryId' => $categoryId,
			'framePosition' => $framePosition,
			'frameSize' => $frameSize]);
		if($body['data']->OtapiItemInfoSubList->TotalCount > 0){
			return view('otapi.categoryTovars', $body);
		}else{
			abort(404, 'Нет товаров в разделе');
		}
	}

	public function get_tovar($categoryId = 'otc-3035', $itemId = 45199342419)
	{
		$body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $categoryId]);
		$body['data'] = $this->create_request('GetItemFullInfo', ['itemId' => $itemId]);
		if((string)$body['data']->ErrorCode === 'Ok'){
			return view('otapi.tovarItem', $body);
		}else{
			abort('404', 'Товар не получен');
		}
	}
}
