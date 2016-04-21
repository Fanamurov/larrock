<?php

namespace App\Http\Controllers;

use Breadcrumbs;
use Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Cache;
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
        Cache::forget($cacheKey);
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

    public function get_category($categoryId = 'otc-3035', Request $request)
    {
        if($getSub = $this->get_subCategoryList($request, $categoryId)){
            return $getSub;
        }else{
            return $this->get_tovarsCategory($request, $categoryId);
        }
    }

    public function get_subCategoryList(Request $request, $parentCategoryId)
    {
        if ($request->exists('filter')){
            return $this->get_tovarsCategoryFilter($request, $parentCategoryId);
        }
        $body['data'] = $this->create_request('GetCategorySubcategoryInfoList', ['parentCategoryId' => $parentCategoryId]);
        $body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $parentCategoryId]);
        if(count($body['data']->CategoryInfoList->Content->Item) > 0){
            return view('otapi.categoryList', $body);
        }else{
            return NULL;
        }
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
        $framePosition = $request->get('page', 0) * 60;
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
                    $breadcrumbs->push((string)$item->Name, route('otapi.category.tovars', ['categoryId' => (string)$item->Id]));
                }
            });

            //Пагинатор
            $body['paginator']['total'] = (string)$body['data']->OtapiItemInfoSubList->TotalCount;
            $body['paginator']['pages'] = ceil($body['paginator']['total']/$frameSize)-1;
            $body['paginator']['current'] = $request->get('page', 1);

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
            if ($key !== '_token' && !empty($filter)){
                $search_params .= '<Configurator Pid="'. $key .'" Vid="'. $filter .'"/>';
                $body['selected_filters'][] = $filter;
            }
        }
        $search_params .= '</Configurators></SearchParameters>';

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
                    $breadcrumbs->push((string)$item->Name, route('otapi.category.tovars', ['categoryId' => (string)$item->Id]));
                }
            });

            //Пагинатор
            $body['paginator']['total'] = (string)$body['data']->OtapiItemInfoSubList->TotalCount;
            $body['paginator']['pages'] = ceil($body['paginator']['total']/$frameSize)-1;
            $body['paginator']['current'] = $request->get('page', 1);

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
        $body = Cache::remember('catalog'.$categoryId.$itemId, 60, function() use($categoryId, $itemId){
            $body['category'] = $this->create_request('GetCategoryInfo', ['categoryId' => $categoryId]);
            $body['data'] = $this->create_request('GetItemFullInfo', ['itemId' => $itemId]);
            $body['GetItemDescription'] = $this->create_request('GetItemDescription', ['itemId' => $itemId]);
            $body['opinions'] = $this->create_request('GetTradeRateInfoListFrame', ['itemId' => $itemId, 'framePosition' => 0, 'frameSize' => 32]);
            $body['vendorTovars'] = $this->create_request('GetVendorItemInfoSortedListFrame',
                ['vendorId' => (string)$body['data']->OtapiItemFullInfo->VendorId, 'framePosition' => 0, 'frameSize' => 6, 'sortingParameters' => '']);
            $body['vendor'] = $this->create_request('GetVendorInfo', ['vendorId' => (string)$body['data']->OtapiItemFullInfo->VendorId]);

            return json_encode($body);
        });

        $body = json_decode($body, TRUE);

        if(array_key_exists('OtapiConfiguredItem', $body['data']['OtapiItemFullInfo']['ConfiguredItems'])){
            foreach ($body['data']['OtapiItemFullInfo']['ConfiguredItems']['OtapiConfiguredItem'] as $configured){
                if(array_key_exists(0, $vid = $configured['Configurators']['ValuedConfigurator'])){
                    $vid = $configured['Configurators']['ValuedConfigurator'][0]['@attributes']['Vid'];
                    $pid = $configured['Configurators']['ValuedConfigurator'][0]['@attributes']['Pid'];
                    $body['configured'][$vid]['Price'] = $configured['Price']['ConvertedPriceWithoutSign'];
                    $body['configured'][$vid]['Quantity'] = $configured['Quantity'];
                    $body['configured'][$vid]['Vid'] = $vid;
                    $body['configured'][$vid]['Pid'] = $pid;
                }

                if(array_key_exists(0, $vid = $configured['Configurators']['ValuedConfigurator'])){
                    $vid = $configured['Configurators']['ValuedConfigurator'][1]['@attributes']['Vid'];
                    $pid = $configured['Configurators']['ValuedConfigurator'][1]['@attributes']['Pid'];
                    $body['configured'][$vid]['Price'] = $configured['Price']['ConvertedPriceWithoutSign'];
                    $body['configured'][$vid]['Quantity'] = $configured['Quantity'];
                    $body['configured'][$vid]['Vid'] = $vid;
                    $body['configured'][$vid]['Pid'] = $pid;
                }
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
                    $breadcrumbs->push((string)$item->Name, route('otapi.category.tovars', ['categoryId' => (string)$item->Id]));
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

    public function SearchItemsFrame(Request $request)
    {
        //http://docs.otapi.net/ru/Documentations/Type?name=OtapiSearchItemsParameters
        $body['data'] = $this->create_request('SearchItemsFrame', [
            'xmlParameters' => '<SearchItemsParameters><ItemTitle>'. $request->get('search') .'</ItemTitle></SearchItemsParameters>',
            'framePosition' => $request->get('framePosition', 0),
            'frameSize' => $request->get('frameSize', 60)]);

        if((string)$body['data']->ErrorCode === 'Ok'){
            return view('otapi.search', $body);
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

    public function categorys()
    {
        $data = $this->create_request('GetThreeLevelRootCategoryInfoList', []);
        dd($data->CategoryInfoList->Content->Item);
    }
}
