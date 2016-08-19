<?php

namespace App\Http\Controllers;

use Alert;
use App\Helpers\Otapi\OtapiCategory;
use App\Helpers\Otapi\OtapiItem;
use App\Helpers\Otapi\OtapiReview;
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
use App\Helpers\Otapi\OtapiVendor;

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
        if($method === 'FindCategoryItemInfoListFrame'){
			//dd($this->service_url . $method .'?'. $this->instanceKey .'&'. $this->lang . $param_request);
            //Cache::forget($cacheKey);
        }
        //Cache::forget($cacheKey);

        $body = Cache::remember($cacheKey, 1440, function() use ($method, $param_request)
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
        if($getSub = $this->get_subCategoryList($request, $categoryId)){
            return $getSub;
        }else{
			return $this->get_tovarsCategoryFilter($request, $categoryId);
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
            return $this->get_tovarsCategoryFilter($request, $parentCategoryId);
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
    public function get_tovarsCategoryFilter(Request $request, $categoryId = 'otc-3035')
    {
        //$framePosition = $request->get('framePosition', 0);
        $framePosition = $request->get('page', 0) * 60;
        $frameSize = 60;

		$body['sorters'] = [
			'Default' => ['name' => 'Лучшие предложения'],
			'Price:Asc' => ['name' => 'Цена: по возрастанию'],
			'Price:Desc' => ['name' => 'Цена: по убываю'],
			'VendorRating:Desc' => ['name' => 'Лучшие продавцы'],
			'Volume:Desc' => ['name' => 'Продаваемые'],
			'Popularity:Desc' => ['name' => 'Популярные']
		];

		$body['sort_active'] = 'Price:Asc';
		foreach($body['sorters'] as $sort_key => $sort){
			if($request->get('sort', 'Default') === $sort_key){
				$body['sorters'][$sort_key]['active'] = 1;
				$body['sort_active'] = $sort_key;
			}
		}

        //dd($request->all());

        $body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $categoryId]);
        $body['GetCategorySearchProperties'] = $this->create_request('GetCategorySearchProperties', ['categoryId' => $categoryId]);

        $search_params = '<SearchParameters><Configurators>';
        $body['selected_filters'] = ['0' => 'test'];
        foreach ($request->all() as $key => $filter){
			$key = str_replace('TTT', '', $key);
            if ($key !== '_token' && $key !== 'filter' && $key !== 'sort' && $key !== 'page' && $key !== 'MinPrice' && $key !== 'MaxPrice' && !empty($filter)){
                $search_params .= '<Configurator Pid="'. $key .'" Vid="'. $filter .'"/>';
                $body['selected_filters'][] = $filter;
            }
        }
        $search_params .= '</Configurators><OrderBy>'. $request->get('sort', 'Default') .'</OrderBy>';

        foreach ($request->all() as $key => $filter){
            if($key === 'MinPrice'){
                $search_params .= '<MinPrice>100</MinPrice>';
            }
            if($key === 'MaxPrice'){
                $search_params .= '<MaxPrice>100</MaxPrice>';
            }
        }

        $search_params .= '</SearchParameters>';

        //dd($search_params);


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

			$total = $body['data']->OtapiItemInfoSubList->TotalCount;
			if($total > 400*60){
				$total = 400*60;
			}

            if(isset($body['data']->OtapiItemInfoSubList->Content->Item)){
                $body['paginator'] = new Paginator(
                $body['data']->OtapiItemInfoSubList->Content->Item,
                $total,
                $limit = 60,
                $page = $request->get('page'), [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]);
            }

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
    public function get_tovar($categoryId = 'otc-3035', $itemId = 45199342419, OtapiVendor $otapiVendor, OtapiCategory $otapiCategory, OtapiItem $otapiItem, OtapiReview $otapiReview)
    {
		//Cache::forget('catalog'.$categoryId.$itemId);
        $body = Cache::remember('catalog'.$categoryId.$itemId, 1440, function() use($categoryId, $itemId, $otapiVendor, $otapiCategory, $otapiItem, $otapiReview){
            $body['category'] = $otapiCategory->get($categoryId);
            $body['data'] = $otapiItem->get($itemId, TRUE);
            //$body['opinions'] = $otapiReview->get($itemId, 0, 10); //Бажно
			$body['opinions'] = collect();
            $body['vendorTovars'] = $otapiVendor->tovars($body['data']->VendorId);
			$body['vendor'] = $otapiVendor->get($body['data']->VendorId);
            return $body;
        });

        if(isset($body['data']->Attributes->ItemAttribute)){
            $attributes = $body['data']->Attributes->ItemAttribute;
        }else{
            $attributes = [];
        }

		//Все конфигурируемые значения параметров товара
		$body['item']['attr'] = [];
		foreach($attributes as $item){
			if(isset($item->IsConfigurator) && $item->IsConfigurator === 'true'){
				$body['item']['attr'][$item->PropertyName][] = $item;
			}
		}

		//Собираем конфиги
		$body['item']['promo'] = [];
		if(isset($body['data']->Promotions->ConfiguredItems)){
			$body['item']['promo'] = $body['data']->Promotions->ConfiguredItems;
		}

		$body['item']['configs'] = [];
		if(isset($body['data']->ConfiguredItems)){
			$body['item']['configs'] = $body['data']->ConfiguredItems;
		}else{
			//Нет конфигуратора
			//dd($body['data']['Result']['Item']);
			$body['item']['config_current']['Price']['ConvertedPriceWithoutSign'] = $body['data']->Price->ConvertedPriceWithoutSign;
			$body['item']['config_current']['Price']['CurrencySign'] = $body['data']->Price->CurrencySign;
			$body['item']['config_current']['Quantity'] = $body['data']->MasterQuantity;
		}

		if(isset($body['item']['configs']['Id'])){
			foreach($body['item']['promo'] as $promo_value){
				if($promo_value->Id === $body['item']['configs']->Id){
					$body['item']['configs']->Price->promoPrice = $promo_value->Price->ConvertedPriceWithoutSign;
				}
			}
		}else{
			foreach($body['item']['configs'] as $key => $config){
				if(isset($body['item']['promo']->Item)){
					foreach($body['item']['promo']->Item as $promo_value){
						if($promo_value->Id === $config->Id){
							$body['item']['configs'][$key]->Price->promoPrice = $promo_value->Price->ConvertedPriceWithoutSign;
						}
					}
				}
			}
		}

		foreach($body['item']['configs'] as $key => $config){
			$attribute = '@attributes';
            if(isset($config->Configurators->ValuedConfigurator)){
                foreach($config->Configurators->ValuedConfigurator as $val_conf){
                    if(isset($val_conf->$attribute)){
						$body['item']['configs'][$key]->bucket = collect();
                        $body['item']['configs'][$key]->bucket->put($val_conf->$attribute->Pid, $val_conf->$attribute->Vid);
                    }else{
                        $body['item']['configs'][$key]->bucket->put($val_conf->Pid, $val_conf->Vid);
                    }
                }
                //dd($body['item']);
                if($config->Quantity !== '0' AND !isset($body['item']['config_current'])){
                    $body['item']['config_current'] = $body['item']['configs'][$key];
                }
            }else{
                $body['item']['config_current'] = $body['item']['configs'];
				$body['item']['config_current']->bucket = collect();
                //dd($Pid = $body['item']['configs']->Configurators->ValuedConfigurator);
                if( !isset($body['item']['configs']->Configurators->ValuedConfigurator->$attribute)){
                    //dd($body['item']['configs']->Configurators->ValuedConfigurator);
                    //1627207
                    foreach ($body['item']['configs']->Configurators->ValuedConfigurator as $val){
                        $Pid = $val->$attribute->Pid;
                        $Vid = $val->$attribute->Vid;
                        $body['item']['config_current']->bucket->put($Pid, $Vid);
                    }
                }else{
                    $Pid = $body['item']['configs']->Configurators->ValuedConfigurator->$attribute->Pid;
                    $Vid = $body['item']['configs']->Configurators->ValuedConfigurator->$attribute->Vid;
                    $body['item']['config_current']->bucket->put($Pid, $Vid);
                }
            }
		}

        if( !isset($body['item']['config_current'])){
            foreach ($body['item']['configs'] as $key => $value) {
                if($value['Quantity'] > 0){
                    $body['item']['config_current'] = $value;
                }
            }
        }

        if( !isset($body['item']['config_current'])){
            $body['item']['config_current'] = $body['item']['configs'][0];
        }

		Breadcrumbs::register('otapi.tovar', function($breadcrumbs, $rootPath)
		{
			$breadcrumbs->parent('otapi.index');

			$rootPath = $rootPath->reverse();
			foreach($rootPath as $item){
				$breadcrumbs->push($item->Name, route('otapi.category', ['categoryId' => $item->Id]));
			}
			//$breadcrumbs->push('Товар');
		});
		View::share('moduleLast', $this->ModuleSoputkaTovars($body['data']->RootPath->first()->Id));
		return view('otapi.tovarItem', $body);
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

    public function get_vendor($vendorId, Request $request)
    {
        $body['data'] = $this->create_request('GetVendorItemInfoSortedListFrame',
            ['vendorId' => $vendorId, 'framePosition' => 0, 'frameSize' => 60, 'sortingParameters' => '']);

        $total = $body['data']->OtapiItemInfoSubList->TotalCount;
        if($total > 400*60){
            $total = 400*60;
        }

        $body['paginator'] = new Paginator(
            $body['data']->OtapiItemInfoSubList->Content->Item,
            $total,
            $limit = 60,
            $page = $request->get('page'), [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);

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
		$body['sorters'] = [
			'Default' => ['name' => 'Лучшие предложения'],
			'Price:Asc' => ['name' => 'Цена: по возрастанию'],
			'Price:Desc' => ['name' => 'Цена: по убываю'],
			'VendorRating:Desc' => ['name' => 'Лучшие продавцы'],
			'Volume:Desc' => ['name' => 'Продаваемые'],
			'Popularity:Desc' => ['name' => 'Популярные']
		];

		$body['sort_active'] = 'Price:Asc';
		foreach($body['sorters'] as $sort_key => $sort){
			if($request->get('sort', '') === $sort_key){
				$body['sorters'][$sort_key]['active'] = 1;
				$body['sort_active'] = $sort_key;
			}
		}

        $search_params = '<SearchItemsParameters><IsClearItemTitles>false</IsClearItemTitles><ItemTitle>'. $request->get('search', 'iPhone') .'</ItemTitle><Configurators>';
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

        //dd($request->query());

		if((string)$body['data']->ErrorCode !== 'Ok'){
			abort('404', 'Товар не получен');
		}

		if($body['data']->Result->Items->Items->TotalCount > 0){
			$body['paginator'] = new Paginator(
				$body['data']->Result->Items->Items->Content->Item,
				//$body['data']->Result->Items->Items->TotalCount,
				400*60,
				$limit = 60,
				$page = $request->get('page', $page), [
				'path'  => $request->url(),
				'query' => $request->query(),
			]);
			return view('otapi.search', $body);
		}else{
			return view('otapi.search', $body);
		}
    }

	/**
	 * @return mixed
	 */
	public function getMenu()
    {
    	//Cache::forget('menu_tree');
        $tree = Cache::rememberForever('menu_tree', function() {
			$body = $this->create_request('GetThreeLevelRootCategoryInfoList');
			$tree = collect();
			$tree->level1 = collect();
			$tree->level2 = collect();
			$tree->level3 = collect();
			$exists_ids = array();
			//dd($body->CategoryInfoList->Content->Item);
			$saved_parent_id = '';
			foreach ($body->CategoryInfoList->Content->Item as $key => $value){
				$item = collect();
				foreach($value as $value_key => $value_value){
					$item->$value_key = $value_value;
					if($value_key === 'IsHidden'){
						$item->Active = $value_value;
					}
				}
				if( !isset($value->ParentId)){
					$item->Parents = collect();
					$tree->level1->put($value->Id, $item);
					//$tree[1][$value->Id] = collect($value);
				}else{
					$parent_id = $value->ParentId;
					if(isset($tree->level1[$parent_id])){
						$item->Parents = collect();
						$tree->level1[$parent_id]->Parents->put($value->Id, $item);
						$saved_parent_id = $parent_id;
					}else{
						$tree->level1[$saved_parent_id]->Parents[$parent_id]->Parents->put($value->Id, $item);
					}
				}
			}
            return $tree;
        });
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
		//dd($body['data']);
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
