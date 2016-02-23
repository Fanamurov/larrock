<?php

namespace App\Http\Controllers;

use Breadcrumbs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Cache;
use Illuminate\Pagination\Paginator;
use View;

class Otapi extends Controller
{
	protected $instanceKey = 'instanceKey=531ed6b5-8ebb-4100-9f19-1077ad3b7ff2';
	protected $lang = 'language=ru';
	protected $service_url = 'http://otapi.net/OtapiWebService2.asmx/';

    public function __construct()
    {
        Breadcrumbs::register('otapi.index', function($breadcrumbs){
            $breadcrumbs->push('Каталог', route('otapi.index'));
        });
        View::share('menu', $this->getMenu());
    }

    public function test()
    {
        return view('tbkhv.tovarTest', []);
    }

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
        View::share('modulePopular', $this->ModulePopularTovars());
        View::share('moduleLast', $this->ModuleLastTovars());
        View::share('moduleVendorPopular', $this->GetVendorRatingList());
		$body = $this->create_request('GetRootCategoryInfoList');
		return view('otapi.frontpage', ['data' => $body->CategoryInfoList->Content]);
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
	public function get_tovarsCategory($categoryId = 'otc-3035', $framePosition = 0, $frameSize = 60)
	{
        $body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $categoryId]);
        $body['GetCategorySearchProperties'] = $this->create_request('GetCategorySearchProperties', ['categoryId' => $categoryId]);
		$body['data'] = $this->create_request('GetCategoryItemInfoListFrame', [
			'categoryId' => $categoryId,
			'framePosition' => $framePosition,
			'frameSize' => $frameSize]);
		if($body['data']->OtapiItemInfoSubList->TotalCount > 0){
            Breadcrumbs::register('otapi.category', function($breadcrumbs, $categoryId)
            {
                $breadcrumbs->parent('otapi.index');

                $GetCategoryRootPath = $this->create_request('GetCategoryRootPath', ['categoryId' => $categoryId]);
                foreach($GetCategoryRootPath->CategoryInfoList->Content->Item as $item){
                    $breadcrumbs->push((string)$item->Name,
                        route('otapi.category.tovars', [
                            'categoryId' => (string)$item->Id]));
                }
            });

			return view('otapi.categoryTovars', $body);
		}else{
			abort(404, 'Нет товаров в разделе');
		}
	}

	public function get_tovar($categoryId = 'otc-3035', $itemId = 45199342419)
	{
		$body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $categoryId]);
		$body['data'] = $this->create_request('GetItemFullInfo', ['itemId' => $itemId]);
        $body['GetItemDescription'] = $this->create_request('GetItemDescription', ['itemId' => $itemId]);
        $body['opinions'] = $this->create_request('GetTradeRateInfoListFrame', ['itemId' => $itemId, 'framePosition' => 0, 'frameSize' => 32]);
        $body['vendorTovars'] = $this->create_request('GetVendorItemInfoSortedListFrame',
            ['vendorId' => (string)$body['data']->OtapiItemFullInfo->VendorId, 'framePosition' => 0, 'frameSize' => 6, 'sortingParameters' => '']);
        $body['vendor'] = $this->create_request('GetVendorInfo', ['vendorId' => (string)$body['data']->OtapiItemFullInfo->VendorId]);
		if((string)$body['data']->ErrorCode === 'Ok'){

            Breadcrumbs::register('otapi.tovar', function($breadcrumbs, $categoryId)
            {
                $breadcrumbs->parent('otapi.index');

                $GetCategoryRootPath = $this->create_request('GetCategoryRootPath', ['categoryId' => $categoryId]);
                foreach($GetCategoryRootPath->CategoryInfoList->Content->Item as $item){
                    $breadcrumbs->push((string)$item->Name,
                        route('otapi.category.tovars', [
                            'categoryId' => (string)$item->Id]));
                }

                $breadcrumbs->push('Товар');
            });

			return view('otapi.tovarItem', $body);
		}else{
			abort('404', 'Товар не получен');
		}
	}

    public function get_vendor($vendorId)
    {
        $body['data'] = $this->create_request('GetVendorItemInfoSortedListFrame',
            ['vendorId' => $vendorId, 'framePosition' => 0, 'frameSize' => 60, 'sortingParameters' => '']);
        return view('otapi.vendorTovars', $body);
    }

    public function SearchItemsFrame(Request $request)
    {
        //http://docs.otapi.net/ru/Documentations/Type?name=OtapiSearchItemsParameters
        $body['data'] = $this->create_request('SearchItemsFrame', [
            'xmlParameters' => '',
            'framePosition' => $request->get('framePosition', 0),
            'frameSize' => $request->get('frameSize', 60)]);

        if((string)$body['data']->ErrorCode === 'Ok'){
            return view('otapi.categoryTovars', $body);
        }else{
            abort('404', 'Товар не получен');
        }
    }

    public function getMenu()
    {
        $body['data'] = $this->create_request('GetRootCategoryInfoList');
        return $body;
    }

    public function AddToCart(Request $request)
    {
        $options = [];
        \Cart::add($request->get('id'), $request->get('name'), 1, $request->get('price'), $options);
        return response(\Cart::total());
    }

    public function ModulePopularTovars()
    {
        $body['data'] = $this->create_request('GetItemRatingList', ['itemRatingTypeId' => 'Popular', 'numberItem' => 4, 'categoryId' => '']);
        return $body;
    }

    public function ModuleLastTovars()
    {
        $body['data'] = $this->create_request('GetItemRatingList', ['itemRatingTypeId' => 'Last', 'numberItem' => 4, 'categoryId' => '']);
        return $body;
    }

    /**
     * Получение подборки продавцов
     * @link http://docs.otapi.net/ru/Documentations/Method?name=GetVendorRatingList
     */
    public function GetVendorRatingList()
    {
        $body['data'] = $this->create_request('GetVendorRatingList', ['itemRatingTypeId' => 'Popular', 'numberItem' => 6, 'categoryId' => '']);
        return $body;
    }
}
