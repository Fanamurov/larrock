<?php

namespace App\Http\Controllers;

use Alert;
use App\Helpers\Otapi\OtapiBrand;
use App\Helpers\Otapi\OtapiCategory;
use App\Helpers\Otapi\OtapiItem;
use App\Helpers\Otapi\OtapiReview;
use Breadcrumbs;
use Cart;
use Cache;
use Illuminate\Http\Request;
use Mail;
use View;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Helpers\Otapi\OtapiVendor;

class Otapi extends Controller
{
    public function __construct(OtapiCategory $otapiCategory)
    {
        Breadcrumbs::register('otapi.index', function($breadcrumbs){
            $breadcrumbs->push('Каталог', route('otapi.index'));
        });
        View::share('menu', $this->getMenu($otapiCategory));
    }

    public function get_index()
    {
		$otapiItem = new OtapiItem();
        View::share('modulePopular', $otapiItem->popularTovars('Popular', 12));
        View::share('moduleLast', $otapiItem->popularTovars('Last', 12));
        //View::share('moduleVendorPopular', $otapiVendor->GetVendorRatingList('Popular', 6));
		$load_categories = ['otc-2' => 'Женская одежда', 'otc-46' => 'Мужская одежда', 'otc-66' => 'Детская одежда и обувь',
			'otc-139' => 'Белье и домашняя одежда', 'otc-165' => 'Верхняя одежда',
			'otc-213' => 'Женская обувь', 'otc-221' => 'Мужская обувь', 'otc-3723' => 'Планшеты',
			'otc-3858' => 'Мобильные телефоны', 'otc-4003' => 'Цифровые зеркальные фотоаппараты'];
		$data['data'] = [];
		foreach($load_categories as $key => $value){
			$data['data'][$key]['items'] = $otapiItem->GetCategoryItemInfoListFrame($key, 0, 12);
			$data['data'][$key]['category'] = $value;
		}
        return view('tbkhv.otapi.frontpage', $data);
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
    	$otapiCategory = new OtapiCategory();
        if ($request->exists('_token')){
            return $this->get_tovarsCategoryFilter($request, $parentCategoryId);
        }
        $body['data'] = $otapiCategory->GetCategorySubcategoryInfoList($parentCategoryId);
        if(count($body['data'])> 0){
			$body['category'] = $otapiCategory->get($parentCategoryId);
            return view('tbkhv.otapi.categoryList', $body);
        }else{
            return $this->get_tovarsCategoryFilter($request, $parentCategoryId);
        }
    }

	/**
	 * Получение частичного списка товаров категории
	 *
	 * @param string        $categoryId
	 * @param Request       $request
	 *
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function get_tovarsCategoryFilter(Request $request, $categoryId = 'otc-3035')
    {
		$otapiCategory = new OtapiCategory();
		$otapiItem = new OtapiItem();
        $framePosition = ($request->get('page', 1)-1) * 60;
        $frameSize = 60;

		$body['sorters'] = [
			'Default' => ['name' => 'Лучшие предложения'],
			'Price:Asc' => ['name' => 'Цена: по возрастанию'],
			'Price:Desc' => ['name' => 'Цена: по убываю'],
			'VendorRating:Desc' => ['name' => 'Лучшие продавцы'],
			'Volume:Desc' => ['name' => 'Продаваемые'],
			'Popularity:Desc' => ['name' => 'Популярные']
		];

		$body['sort_active'] = 'Default';
		foreach($body['sorters'] as $sort_key => $sort){
			if($request->get('sort', 'Default') === $sort_key){
				$body['sorters'][$sort_key]['active'] = 1;
				$body['sort_active'] = $sort_key;
			}
		}

		$body['category'] = $otapiCategory->get($categoryId);
        $body['GetCategorySearchProperties'] = $otapiCategory->GetCategorySearchProperties($categoryId);

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
            if($key === 'MinPrice' AND !empty($filter)){
                $search_params .= '<MinPrice>'. $request->get($key, 0) .'</MinPrice>';
            }
            if($key === 'MaxPrice' AND !empty($filter)){
                $search_params .= '<MaxPrice>'. $request->get($key) .'</MaxPrice>';
            }
        }

        $search_params .= '</SearchParameters>';

		$body['data'] = $otapiItem->categoryTovars($categoryId, $search_params, $framePosition, $frameSize);
		$body['sub_categories'] = $otapiCategory->GetCategorySubcategoryInfoList($body['category']->ParentId);

        if($body['data']->TotalCount > 0){
            Breadcrumbs::register('otapi.category', function($breadcrumbs, $categoryId) use ($otapiCategory)
            {
                $breadcrumbs->parent('otapi.index');

				$GetCategoryRootPath = $otapiCategory->GetCategoryRootPath($categoryId);
                $categorys = array_reverse($GetCategoryRootPath);
                foreach($categorys as $item){
                    $breadcrumbs->push($item->Name, route('otapi.category', ['categoryId' => $item->Id]));
                }
            });

			$total = $body['data']->TotalCount;
            if($total > 65*60){
                $total = 65*60;
            }

            if(isset($body['data']->Content->Item)){
                $body['paginator'] = new Paginator(
                $body['data']->Content->Item,
                $total,
                $limit = 60,
                $page = $request->get('page'), [
                'path'  => $request->url(),
                'query' => $request->query()]);
            }

            return view('tbkhv.otapi.categoryTovars', $body);
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
		$otapiCategory = new OtapiCategory();
		$otapiItem = new OtapiItem();
		$otapiVendor = new OtapiVendor();
		$otapiReview = new OtapiReview();
		//Cache::forget('catalog'.$categoryId.$itemId);
        $body = Cache::remember('catalog'.$categoryId.$itemId, 1440, function() use($categoryId, $itemId, $otapiVendor, $otapiCategory, $otapiItem, $otapiReview){
            $body['category'] = $otapiCategory->get($categoryId);
            $body['data'] = $otapiItem->get($itemId, TRUE);
            $body['opinions'] = $otapiReview->get($itemId, 0, 10);
            $body['vendorTovars'] = $otapiVendor->tovars($body['data']->VendorId, 0, 6);
			$body['vendor'] = $otapiVendor->get($body['data']->VendorId);
            return $body;
        });

		//Ищем минимальную и максимальную сумму для товара
		$body['price_average'] = $body['data']->Price->ConvertedPriceWithoutSign;
		$body['price_min'] = $body['data']->Price->ConvertedPriceWithoutSign;
		$body['price_max'] = $body['data']->Price->ConvertedPriceWithoutSign;
		foreach($body['data']->ConfiguredItems as $config_price){
		    if(isset($config_price->Price->ConvertedPriceWithoutSign)){
                if($config_price->Price->ConvertedPriceWithoutSign < $body['price_min']){
                    $body['price_min'] = $config_price->Price->ConvertedPriceWithoutSign;
                }
                if($config_price->Price->ConvertedPriceWithoutSign > $body['price_max']){
                    $body['price_max'] = $config_price->Price->ConvertedPriceWithoutSign;
                }
            }else{
                if($body['data']->ConfiguredItems['Price']->ConvertedPriceWithoutSign < $body['price_min']){
                    $body['price_min'] = $body['data']->ConfiguredItems['Price']->ConvertedPriceWithoutSign;
                }
                if($body['data']->ConfiguredItems['Price']->ConvertedPriceWithoutSign > $body['price_max']){
                    $body['price_max'] = $body['data']->ConfiguredItems['Price']->ConvertedPriceWithoutSign;
                }
            }
		}
		if($body['price_min'] !== $body['price_max']){
			$body['price_average'] = $body['price_min'] .'-'. $body['price_max'];
		}

		Breadcrumbs::register('otapi.tovar', function($breadcrumbs, $rootPath)
		{
			$breadcrumbs->parent('otapi.index');
			$rootPath = $rootPath->reverse();
			foreach($rootPath as $item){
				$breadcrumbs->push($item->Name, route('otapi.category', ['categoryId' => $item->Id]));
			}
			$breadcrumbs->push('Товар');
		});
		$body['moduleLast'] = $otapiItem->getSearchByCategory($body['data']->RootPath->first()->Id, 0, 12, '');
		return view('tbkhv.otapi.tovarItem', $body);
    }

	public function getConfigItem(Request $request)
	{
		$configs = json_decode($request->get('configs'));
		$configs_promo = json_decode($request->get('configs_promo'));
		$params = $request->except(['configs', 'configs_promo']);
		$count_params = count($params);
		$attrKey = '@attributes';

        if(is_object($configs)){
            $configs_array = [0 => $configs];
        }else{
            $configs_array = $configs;
        }

		foreach($configs_array as $item){
			if(is_array($item->Configurators->ValuedConfigurator)){
				$count_find = 0;
				foreach($item->Configurators->ValuedConfigurator as $value){
					$Pid = $value->$attrKey->Pid;
					$Vid = $value->$attrKey->Vid;
					if(array_key_exists($Pid, $params) && $params[$Pid] === $Vid){
						++$count_find;
					}
					//dd($value->$attrKey);
				}
				if($count_find === $count_params){
					//Нашли совпадение конфига
					$output = [];
					$output['Id'] = $item->Id;
					$output['Quantity'] = $item->Quantity;
					$output['Price'] = $output['promoPrice'] = $item->Price->ConvertedPriceWithoutSign;

                    if(is_array($configs_promo)){
                        foreach($configs_promo as $promo){
                            foreach($promo->ConfiguredItems->Item as $promo_item){
                                if($promo_item->Id === $item->Id && $promo_item->Price->Quantity > 0){
                                    $output['promoPrice'] = $promo_item->Price->ConvertedPriceWithoutSign;
                                }
                            }
                        }
                    }else{
                        if($configs_promo->Id === $item->Id && $configs_promo->Price->Quantity > 0){
                            $output['promoPrice'] = $configs_promo->Price->ConvertedPriceWithoutSign;
                        }
                    }

					if($output['Quantity'] > 0){
						return response()->json(['status' => 'Update', 'data' => $output]);
					}else{
						return response()->json(['status' => 'QuantityZero']);
					}
				}
			}else{
				$Pid = $item->Configurators->ValuedConfigurator->$attrKey->Pid;
				$Vid = $item->Configurators->ValuedConfigurator->$attrKey->Vid;
				if(array_key_exists($Pid, $params) && $params[$Pid] === $Vid){
					$output = [];
					$output['Id'] = $item->Id;
					$output['Quantity'] = $item->Quantity;
					$output['Price'] = $output['promoPrice'] = $item->Price->ConvertedPriceWithoutSign;

					if($output['Quantity'] > 0){
						return response()->json(['status' => 'Update', 'data' => $output]);
					}else{
						return response()->json(['status' => 'QuantityZero']);
					}
				}
			}
		}
		return response()->json(['status' => 'NotFound']);
	}

    public function get_vendor($vendorId, $page = 1, Request $request)
    {
		$otapiVendor = new OtapiVendor();
		$framePosition = ($request->get('page', $page)-1)*60;
		if($framePosition >= 4000){
			$framePosition = 3999;
		}

    	$body['data'] = $otapiVendor->tovars($vendorId, $framePosition, 60);

        $total = $body['data']->TotalCount;
        if($total > 400*60){
            $total = 400*60;
        }

        $body['paginator'] = new Paginator(
            $body['data']->Content->Item,
            $total,
            $limit = 60,
            $page = $request->get('page'), [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);

        return view('tbkhv.otapi.vendorTovars', $body);
    }

    public function get_brand($brandId)
    {
		$otapiBrand = new OtapiBrand();
        $body['brand'] = $brandId;
		$body['data'] = $otapiBrand->tovars($brandId);
		return view('tbkhv.otapi.brand', $body);
    }

    public function SearchItemsFrame(Request $request, $page = 1)
    {
		$otapiItem = new OtapiItem();
		$body['sorters'] = [
			'Default' => ['name' => 'Лучшие предложения'],
			'Price:Asc' => ['name' => 'Цена: по возрастанию'],
			'Price:Desc' => ['name' => 'Цена: по убываю'],
			'VendorRating:Desc' => ['name' => 'Лучшие продавцы'],
			'Volume:Desc' => ['name' => 'Продаваемые'],
			'Popularity:Desc' => ['name' => 'Популярные']
		];

		$body['sort_active'] = 'Default';
		foreach($body['sorters'] as $sort_key => $sort){
			if($request->get('sort', '') === $sort_key){
				$body['sorters'][$sort_key]['active'] = 1;
				$body['sort_active'] = $sort_key;
			}
		}

        $search_params = '<Configurators>';
        $body['selected_filters'] = ['0' => 'test'];
        foreach ($request->all() as $key => $filter){
            if ($key !== '_token' && $key !== 'search' && $key !== 'page' && $key !== 'sort' && $key !== 'MinPrice' && $key !== 'MaxPrice' && !empty($filter)){
                $key = str_replace('TTT', '', $key);
                $search_params .= '<Configurator Pid="'. $key .'" Vid="'. $filter .'"/>';
                $body['selected_filters'][] = $filter;
            }
        }
		$search_params .= '</Configurators>';

        if($request->get('MinPrice') > 0){
            $search_params .= '<MinPrice>'. $request->get('MinPrice') .'</MinPrice>';
        }
        if($request->get('MaxPrice') > 0){
            $search_params .= '<MaxPrice>'. $request->get('MaxPrice') .'</MaxPrice>';
        }

        //dd($search_params);

        //http://docs.otapi.net/ru/Documentations/Type?name=OtapiSearchItemsParameters
        $framePosition = ($request->get('page', $page)-1)*60;
        //dd($framePosition);

        //dd($request->query());
		$body['data'] = $otapiItem->BatchSearchItemsFrame(
			$request->get('search', 'iPhone'),
			$search_params,
			$request->get('sort'),
			$request->get('framePosition', $framePosition),
            60);

		if($body['data']->Items->Items->TotalCount > 0){
            $total = $body['data']->Items->Items->TotalCount;
            if($total > 65*60){
                $total = 65*60;
            }
			$body['paginator'] = new Paginator(
				$body['data']->Items->Items->Content->Item,
				$total,
				$limit = 60,
				$page = $request->get('page', $page), [
				'path'  => $request->url(),
				'query' => $request->query(),
			]);
		}
		return view('tbkhv.otapi.search', $body);
    }

	/**
	 * @param OtapiCategory $otapiCategory
	 *
	 * @return mixed
	 */
	public function getMenu(OtapiCategory $otapiCategory)
    {
    	//Cache::forget('menu_tree');
        $tree = Cache::rememberForever('menu_tree', function() use ($otapiCategory) {
			$body = $otapiCategory->GetThreeLevelRootCategoryInfoList();
			$tree = collect();
			$tree->level1 = collect();
			$tree->level2 = collect();
			$tree->level3 = collect();
			$saved_parent_id = '';
			foreach ($body as $key => $value){
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
		$id = $request->get('id') .'-'. $request->get('price');
        \Cart::add($id, $request->get('name'), 1, $request->get('price'), $options);
        return response(\Cart::total());
    }

    public function get_cart(OtapiItem $otapiItem)
    {
        $cart = Cart::content();
        if(Cart::total() === 0){
            return redirect()->route('mainpage');
        }
        $tao_items = [];
        foreach($cart as $item){
            $id = str_replace('-'. $item->price, '', $item->id);
            $tao_items[$item->id] = $otapiItem->get($id);
        }
        return view('tbkhv.cart.table', compact('cart', 'tao_items', ['cart', 'tao_items']));
    }

	/**
	 * @param Request   $request
	 *
	 * @param OtapiItem $otapiItem
	 *
	 * @return mixed
	 */
	public function sendOrder(Request $request, OtapiItem $otapiItem)
	{
		$cart = Cart::content();
		$tao_items = [];
		foreach($cart as $item){
            $id = str_replace('-'. $item->price, '', $item->id);
			$tao_items[$item->id] = $otapiItem->get($id);
		}

		//TODO:Отправка на несколько имейлов (админы, покупатель)
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
		return redirect()->to('/thankyou');
	}

	public function thankyou()
	{
		return view('tbkhv.cart.thankyou');
	}
}
