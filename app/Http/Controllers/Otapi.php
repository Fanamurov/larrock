<?php

namespace App\Http\Controllers;

use Alert;
use Breadcrumbs;
use Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Cache;
use Mail;
use View;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

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

    public function create_request($method, $params = [])
    {
        $param_request = '';
        foreach($params as $param_key => $param_value){
            $param_request .= '&'. $param_key .'='. $param_value;
        }

        //echo $method .'_'.$param_request .'<br/>';
        $cacheKey = md5($method .'_'.$param_request);
        if($method === 'GetThreeLevelRootCategoryInfoList'){
            //Cache::forget($cacheKey);
        }
        //Cache::forget($cacheKey);

        $body = Cache::remember($cacheKey, 240, function() use ($method, $param_request)
        {
            $client = new Client();
            //dd($this->service_url . $method .'?'. $this->instanceKey .'&'. $this->lang . $param_request);
            $data = $client->request('GET', $this->service_url . $method .'?'. $this->instanceKey .'&'. $this->lang . $param_request);
            $body = simplexml_load_string($data->getBody());
            $body = json_encode($body);
            $body = json_decode($body);
            //dd($body->CategoryInfoList->Content->Item);
            return $body;
        });
        return $body;
    }

    public function get_index()
    {
        View::share('modulePopular', $this->ModulePopularTovars());
        View::share('moduleLast', $this->ModuleLastTovars());
        View::share('moduleVendorPopular', $this->GetVendorRatingList());
        return view('otapi.frontpage');
    }

    public function get_category($categoryId = 'otc-3035', Request $request)
    {
		if($request->has('filter')){
			return $this->get_tovarsCategoryFilter($request, $categoryId);
		}
        if($getSub = $this->get_subCategoryList($request, $categoryId)){
            return $getSub;
        }else{
            return $this->get_tovarsCategory($request, $categoryId);
        }
    }

    public function get_subCategoryList(Request $request, $parentCategoryId)
    {
        if ($request->exists('_token')){
            return $this->get_tovarsCategoryFilter($request, $parentCategoryId);
        }
        $body['data'] = $this->create_request('GetCategorySubcategoryInfoList', ['parentCategoryId' => $parentCategoryId]);
        $body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $parentCategoryId]);
        if(isset($body['data']->CategoryInfoList->Content->Item) && count($body['data']->CategoryInfoList->Content->Item) > 0){
            return view('otapi.categoryList', $body);
        }else{
            return abort(404, 'Товары не найдены');
        }
    }

    public function get_GetCategorySubcategoryInfoList(Request $request, $parentCategoryId)
    {
        $body = $this->create_request('GetCategorySubcategoryInfoList', ['parentCategoryId' => $parentCategoryId]);
        return view('tbkhv.modules.menu.catalog-left', $body);
    }

    public function get_GetThreeLevelRootCategoryInfoList(Request $request)
    {
        $body = $this->create_request('GetThreeLevelRootCategoryInfoList');
        return view('tbkhv.modules.menu.catalog-left', $body);
    }

    /**
     * Получение частичного списка товаров категории
     *
     * @param Request $request
     * @param string $categoryId
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_tovarsCategory(Request $request, $categoryId = 'otc-3035')
    {
        if ($request->exists('filter')){
            return $this->get_tovarsCategoryFilter($request, $categoryId);
        }
        //$framePosition = $request->get('framePosition', 0);
        $framePosition = ($request->get('page', 1)-1) * 60;
        $frameSize = 60;

        $body['selected_filters'] = ['0' => 'test'];
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
                $categorys = (array)$GetCategoryRootPath->CategoryInfoList->Content;
                $categorys = array_reverse($categorys['Item']);
                foreach($categorys as $item){
                    $breadcrumbs->push((string)$item->Name, route('otapi.category', ['categoryId' => (string)$item->Id]));
                }
            });

            $body['paginator'] = new Paginator(
                $body['data']->OtapiItemInfoSubList->Content->Item,
                $body['data']->OtapiItemInfoSubList->TotalCount,
                $limit = 60,
                $page = $request->get('page'), [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]);

            return view('otapi.categoryTovars', $body);
        }else{
            abort(404, 'Нет товаров в разделе');
        }
    }

    /**
     * Получение частичного списка товаров категории
     *
     * @param Request $request
     * @param string $categoryId
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_tovarsCategoryFilter(Request $request, $categoryId = 'otc-3035')
    {
        //$framePosition = $request->get('framePosition', 0);
        $framePosition = $request->get('page', 0) * 60;
        $frameSize = 60;

        //dd($request->all());

        $body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $categoryId]);
        $body['GetCategorySearchProperties'] = $this->create_request('GetCategorySearchProperties', ['categoryId' => $categoryId]);

        $search_params = '<SearchParameters><Configurators>';
        $body['selected_filters'] = ['0' => 'test'];
        foreach ($request->all() as $key => $filter){
			$key = str_replace('TTT', '', $key);
            if ($key !== '_token' && $key !== 'filter' && $key !== 'sort' && !empty($filter)){
                $search_params .= '<Configurator Pid="'. $key .'" Vid="'. $filter .'"/>';
                $body['selected_filters'][] = $filter;
            }
        }
        $search_params .= '</Configurators><OrderBy>'. $request->get('sort', 'Price:Asc') .'</OrderBy></SearchParameters>';

        $body['data'] = $this->create_request('FindCategoryItemInfoListFrame', [
            'categoryId' => $categoryId,
            'categoryItemFilter' => $search_params,
            'framePosition' => $framePosition,
            'frameSize' => $frameSize]);

        if($body['data']->OtapiItemInfoSubList->TotalCount > 0){
            Breadcrumbs::register('otapi.category', function($breadcrumbs, $categoryId)
            {
                $breadcrumbs->parent('otapi.index');

                $GetCategoryRootPath = $this->create_request('GetCategoryRootPath', ['categoryId' => $categoryId]);
                $categorys = (array)$GetCategoryRootPath->CategoryInfoList->Content;
                $categorys = array_reverse($categorys['Item']);
                foreach($categorys as $item){
                    $breadcrumbs->push((string)$item->Name, route('otapi.category', ['categoryId' => (string)$item->Id]));
                }
            });

			$body['paginator'] = new Paginator(
				$body['data']->OtapiItemInfoSubList->Content->Item,
                400*60,
				//$body['data']->OtapiItemInfoSubList->TotalCount,
				$limit = 60,
				$page = $request->get('page'), [
				'path'  => $request->url(),
				'query' => $request->query(),
			]);

            return view('otapi.categoryTovars', $body);
        }else{
            \Alert::add('error', 'Товаров по данным параметрам не найдено');
            return back();
        }
    }

    /**
     * @param string $categoryId
     * @param int $itemId
     * @return mixed
     */
    public function get_tovar($categoryId = 'otc-3035', $itemId = 45199342419)
    {
		//Cache::forget('catalog'.$categoryId.$itemId);
        $body = Cache::remember('catalog'.$categoryId.$itemId, 60, function() use($categoryId, $itemId){
            $body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $categoryId]);
            $body['data'] = $this->create_request('BatchGetItemFullInfo', ['itemId' => $itemId, 'blockList' => 'Promotions,RootPath', 'sessionId' => mt_rand(100000,99999999)]);
            $body['GetItemDescription'] = $this->create_request('GetItemDescription', ['itemId' => $itemId]);
            $body['opinions'] = $this->create_request('GetTradeRateInfoListFrame', ['itemId' => $itemId, 'framePosition' => 0, 'frameSize' => 32]);
            $body['vendorTovars'] = $this->create_request('GetVendorItemInfoSortedListFrame',
                ['vendorId' => (string)$body['data']->Result->Item->VendorId, 'framePosition' => 0, 'frameSize' => 6, 'sortingParameters' => '']);
            $body['vendor'] = $this->create_request('GetVendorInfo', ['vendorId' => (string)$body['data']->Result->Item->VendorId]);

            return json_encode($body);
        });

        $body = json_decode($body, TRUE);

		$attributes = $body['data']['Result']['Item']['Attributes']['ItemAttribute'];
		//Все конфигурируемые значения параметров товара
		$body['item']['attr'] = [];
		foreach($attributes as $item){
			if($item['IsConfigurator'] === 'true'){
				$body['item']['attr'][$item['PropertyName']][] = $item;
			}
		}

		//Собираем конфиги
		$body['item']['promo'] = $body['data']['Result']['Item']['Promotions']['OtapiItemPromotion']['ConfiguredItems'];
		$body['item']['configs'] = $body['data']['Result']['Item']['ConfiguredItems']['OtapiConfiguredItem'];


		if(isset($body['item']['configs']['Id'])){
			foreach($body['item']['promo'] as $promo_value){
				if($promo_value['Id'] === $body['item']['configs']['Id']){
					$body['item']['configs']['Price']['promoPrice'] = $promo_value['Price']['ConvertedPriceWithoutSign'];
				}
			}
		}else{
			foreach($body['item']['configs'] as $key => $config){
				foreach($body['item']['promo']['Item'] as $promo_value){
					if($promo_value['Id'] === $config['Id']){
						$body['item']['configs'][$key]['Price']['promoPrice'] = $promo_value['Price']['ConvertedPriceWithoutSign'];
					}
				}
			}
		}

		foreach($body['item']['configs'] as $key => $config){
            if(isset($config['Configurators']['ValuedConfigurator'])){
                foreach($config['Configurators']['ValuedConfigurator'] as $val_conf){
                    if(array_key_exists('@attributes', $val_conf)){
                        $body['item']['configs'][$key]['bucket'][$val_conf['@attributes']['Pid']] = $val_conf['@attributes']['Vid'];
                    }else{
                        $body['item']['configs'][$key]['bucket'][$val_conf['Pid']] = $val_conf['Vid'];
                    }
                }
                if($config['Quantity'] !== '0' AND !isset($body['item']['config_current'])){
                    $body['item']['config_current'] = $body['item']['configs'][$key];
                }
            }else{
                $body['item']['config_current'] = $body['item']['configs'];
                $Pid = $body['item']['configs']['Configurators']['ValuedConfigurator']['@attributes']['Pid'];
                $Vid = $body['item']['configs']['Configurators']['ValuedConfigurator']['@attributes']['Vid'];
                $body['item']['config_current']['bucket'][$Pid] = $Vid;
            }
		}

        if((string)$body['data']['ErrorCode'] === 'Ok'){
            Breadcrumbs::register('otapi.tovar', function($breadcrumbs, $categoryId)
            {
                $breadcrumbs->parent('otapi.index');

                $GetCategoryRootPath = $this->create_request('GetCategoryRootPath', ['categoryId' => $categoryId]);
                $categorys = (array)$GetCategoryRootPath->CategoryInfoList->Content;
                $categorys = array_reverse($categorys['Item']);
                foreach($categorys as $item){
                    $breadcrumbs->push((string)$item->Name, route('otapi.category', ['categoryId' => (string)$item->Id]));
                }

                $breadcrumbs->push('Товар');
            });
			View::share('moduleLast', $this->ModuleSoputkaTovars($body['data']['Result']['RootPath']['Content']['Item'][1]['Id']));
            return view('otapi.tovarItem', $body);
        }else{
            abort('404', 'Товар не получен');
        }
    }

	public function getConfigItem(Request $request)
	{
		$data['configs'] = json_decode($request->get('configs'));
		$data['config_current'] = json_decode($request->get('config_current'));
		$data['Pid'] = $request->get('Pid');
		$data['Vid'] = $request->get('Vid');
		$data['title'] = $request->get('title');

		$bucket = $data['config_current']->bucket;
		if(isset($bucket->$data['Pid'])){
			$bucket->$data['Pid'] = $data['Vid'];
		}

		foreach($data['configs'] as $config){
			if((array)$config->bucket === (array)$bucket){
				$output = [];
				$output['Id'] = $config->Id;
				$output['Quantity'] = $config->Quantity;
				if(isset($config->Price->promoPrice)){
					$output['promoPrice'] = $config->Price->promoPrice;
					$output['Price'] = $config->Price->ConvertedPriceWithoutSign;
				}else{
					$output['Price'] = $config->Price->ConvertedPriceWithoutSign;
				}
				$output['config_current'] = json_encode($data['config_current']);
				if($output['Quantity'] > 0){
					echo json_encode(['status' => 'Update', 'data' => $output]);
				}else{
					echo json_encode(['status' => 'QuantityZero']);
				}
				exit();
			}
		}

		echo json_encode(['status' => 'NotFound']);
	}

    public function get_vendor($vendorId)
    {
        $body['data'] = $this->create_request('GetVendorItemInfoSortedListFrame',
            ['vendorId' => $vendorId, 'framePosition' => 0, 'frameSize' => 60, 'sortingParameters' => '']);
        return view('otapi.vendorTovars', $body);
    }

    public function get_brand($brandId, Request $request)
    {
        $body['brand'] = $brandId;
        $body['data'] = $this->create_request('SearchItemsFrame', [
            'xmlParameters' => '<SearchItemsParameters><BrandId>'. $brandId .'</BrandId></SearchItemsParameters>',
            'framePosition' => $request->get('framePosition', 0),
            'frameSize' => $request->get('frameSize', 60)]);

        if((string)$body['data']->ErrorCode === 'Ok'){
            return view('otapi.brand', $body);
        }else{
            abort('404', 'Товар не получен');
        }
    }

    public function SearchItemsFrame(Request $request, $page = 1)
    {
        $search_params = '<SearchItemsParameters><ItemTitle>'. $request->get('search', 'iPhone') .'</ItemTitle><Configurators>';
        $body['selected_filters'] = ['0' => 'test'];
        foreach ($request->all() as $key => $filter){
            if ($key !== '_token' && $key !== 'search' && $key !== 'page' && $key !== 'sort' && !empty($filter)){
                $key = str_replace('TTT', '', $key);
                $search_params .= '<Configurator Pid="'. $key .'" Vid="'. $filter .'"/>';
                $body['selected_filters'][] = $filter;
            }
        }
        $search_params .= '</Configurators><OrderBy>'. $request->get('sort', 'Price:Asc') .'</OrderBy></SearchItemsParameters>';

        //http://docs.otapi.net/ru/Documentations/Type?name=OtapiSearchItemsParameters
        $framePosition = ($request->get('page', $page)-1)*60;
        if($framePosition >= 4000){
            $framePosition = 3999;
        }
        $body['data'] = $this->create_request('BatchSearchItemsFrame', [
            'xmlParameters' => $search_params,
            'framePosition' => $request->get('framePosition', $framePosition),
            'frameSize' => $request->get('frameSize', 60),
            'sessionId' => '242423',
            'blockList' => 'SearchProperties,AvailableSearchMethods']);

        //dd($body['data']);

        //dd($request->query());

        $body['paginator'] = new Paginator(
            $body['data']->Result->Items->Items->Content->Item,
            //$body['data']->Result->Items->Items->TotalCount,
            400*60,
            $limit = 60,
            $page = $request->get('page', $page), [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);

        if((string)$body['data']->ErrorCode === 'Ok'){
            return view('otapi.search', $body);
        }else{
            abort('404', 'Товар не получен');
        }
    }

    public function getMenu()
    {
        $body = $this->create_request('GetThreeLevelRootCategoryInfoList');
        $tree = array();
        $exists_ids = array();
        foreach ($body->CategoryInfoList->Content->Item as $key => $value){
            if( !isset($value->ParentId)){
                $tree[1][$value->Id] = $value;
            }else{
                if(in_array($value->ParentId, $exists_ids)){
                    $tree[3][$value->ParentId][] = $value;
                }else{
                    $tree[2][$value->ParentId][] = $value;
                    $exists_ids[] = $value->Id;

                }
            }
        }
        return $tree;
    }

    public function AddToCart(Request $request)
    {
        $options['config'] = $request->get('config');
        $options['img'] = $request->get('img');
        \Cart::add($request->get('id'), $request->get('name'), 1, $request->get('price'), $options);
        return response(\Cart::total());
    }

    public function get_cart()
    {
        $cart = Cart::content();
        if(count($cart) === 0){
            return redirect()->route('mainpage');
        }
        $tao_items = [];
        foreach($cart as $item){
            $tao_items[$item->id] = $this->create_request('GetItemFullInfo', ['itemId' => $item->id]);
        }
        $seo = ['title' => 'Cart page'];
        return view('tbkhv.cart.table', compact('cart', 'seo', 'tao_items', ['cart', 'seo', 'tao_items']));
    }

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function sendOrder(Request $request)
	{
		$cart = Cart::content();
		$tao_items = [];
		foreach($cart as $item){
			$tao_items[$item->id] = $this->create_request('GetItemFullInfo', ['itemId' => $item->id]);
		}

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.order',
			['name' => $request->get('name'),
				'tel' => $request->get('tel'),
				'address' => $request->get('address'),
				'method_pay' => $request->get('method_pay'),
				'method_delivery' => $request->get('method_delivery'),
				'cart' => $cart,
				'tao_items' => $tao_items,
				'comment' => $request->get('comment')],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки '. array_get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			Alert::add('success', 'Ваш заказ успешно принят нашими менеджерами. После проверки данных с Вами свяжется наш менеджер')->flash();
			Cart::destroy();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

    public function ModulePopularTovars()
    {
        $body['data'] = $this->create_request('GetItemRatingList', ['itemRatingTypeId' => 'Popular', 'numberItem' => 12, 'categoryId' => '']);
        return $body;
    }

    public function ModuleLastTovars()
    {
		$body['data'] = $this->create_request('GetItemRatingList', ['itemRatingTypeId' => 'Last', 'numberItem' => 12, 'categoryId' => '']);
		return $body;
    }

	public function ModuleSoputkaTovars($categoryId = '')
	{
		$body['data'] = $this->create_request('FindCategoryItemInfoListFrame',
			['framePosition' => 0, 'frameSize' => 16, 'categoryId' => $categoryId, 'categoryItemFilter' => '']);
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

    public function categorys()
    {
        $data = $this->create_request('GetThreeLevelRootCategoryInfoList', []);
        dd($data->CategoryInfoList->Content->Item);
    }
}
