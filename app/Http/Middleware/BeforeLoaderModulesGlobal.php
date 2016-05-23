<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Cache;
use Closure;
use View;
use MenuApp;
use App\Helpers\Sletat;

class BeforeLoaderModulesGlobal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param Sletat $sletat
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$current_uri = explode('/', $request->getRequestUri());
		View::share('app_name', array_get($current_uri, 1));
		View::share('app_param', array_get($current_uri, 2));

		\View::share('sharing_type', '');
		\View::share('sharing_id', '');

        $module_vidy = Cache::remember('module_vidy', 1440, function() {
            return Category::whereParent(377)->whereActive(1)->orderBy('position', 'DESC')->get();
        });
		View::share('module_vidy', $module_vidy);

        $module_strany = Cache::remember('module_strany', 1440, function() {
            return Category::whereParent(308)->whereActive(1)->with(['get_childActive'])->orderBy('position', 'DESC')->get();
        });
        //View::share('module_strany', $module_strany);

        MenuApp::create('navbar', function($menu) use ($module_vidy, $module_strany)
        {
            $menu->dropdown('Страны', function ($sub) use ($module_strany) {
                foreach ($module_strany as $key => $item){
					if($key){

					}
                    $sub->url('/tours/strany/'. $item->url, $item->title);
                }
            });
            $menu->dropdown('Виды отдыха', function ($sub) use ($module_vidy) {
                foreach($module_vidy as $key => $item){
                    $sub->url('/tours/vidy-otdykha/'. $item->url, $item->title);
                }
            });
            $menu->dropdown('Услуги', function ($sub) {
                $sub->url('/page/tur-na-zakaz', 'Тур на заказ', ['icon' => 'fi flaticon-road']);
				$sub->url('/page/karta-klienta', 'Карта клиента', ['icon' => 'fi flaticon-ribbon']);
				$sub->url('/page/podarochnye-sertifikaty', 'Подарочные сертификаты', ['icon' => 'fi flaticon-shapes']);
                $sub->url('/page/korporativnoe-obsluzhivanie', 'Корпоративное обслуживание', ['icon' => 'fi flaticon-travel-3']);
                $sub->url('/visovaya-podderjka', 'Визовая поддержка', ['icon' => 'fi flaticon-people-1']);
            });
            $menu->url('/blog', 'Блог');
			$menu->url('/otzyvy', 'Отзывы');
			$menu->url('/page/kontakty', 'Контакты');
        });

		MenuApp::create('menu_footer', function($menu)
		{
			$menu->style('navmenu');
			$menu->url('/page/vakansii-santa-avia', 'Вакансии');
			//$menu->url('/page/partnery', 'Партнеры');
			$menu->url('/page/pochemu-pokupat-tury-nado-tolko-u-nas', 'О компании');
			$menu->url('/page/bronirovanie-i-oplata-turov-instruktsiya', 'Бронирование и оплата');
			$menu->url('/page/oplata-on-layn', 'Оплата он-лайн');
		});

		$menu_mobile = Cache::remember('menu_mobile', 1440, function() use ($module_strany, $module_vidy) {
			//Меню для мобильных
			$menu_mobile['countries'] = [];
			foreach ($module_strany as $item){
				$menu_mobile['countries'][$item->title] = $item->url;
			}
			$menu_mobile['vidy'] = [];
			foreach($module_vidy as $key => $item){
				$menu_mobile['vidy'][$item->title] = $item->url;
			}
			$menu_mobile['uslugi'] = [];
			$menu_mobile['uslugi']['Тур на заказ'] = '/page/tur-na-zakaz';
			$menu_mobile['uslugi']['Карта клиента'] = '/page/karta-klienta';
			$menu_mobile['uslugi']['Подарочные сертификаты'] = '/page/podarochnye-sertifikaty';
			$menu_mobile['uslugi']['Корпоративное обслуживание'] = '/page/korporativnoe-obsluzhivanie';
			$menu_mobile['uslugi']['Визовая поддержка'] = '/visovaya-podderjka';

			$menu_mobile['other'] = [];
			$menu_mobile['other']['Блог'] = '/blog';
			$menu_mobile['other']['Отзывы'] = '/otzyvy';
			$menu_mobile['other']['Контакты'] = '/page/kontakty';
			return $menu_mobile;
		});
		View::share('menu_mobile', $menu_mobile);

		$sletat = new Sletat();
		$getFullSearchForm = $sletat->getFullSearchForm($request);
		View::share('GetDepartCities', $getFullSearchForm['GetDepartCities']);
		View::share('GetCountries', $getFullSearchForm['GetCountries']);

		//Форма поиска туров по сайту
		$siteSearch = Cache::remember('siteSearch-form', 1440, function() {
			$siteSearch['countries'] = Category::whereType('tours')->whereActive(1)->whereParent(308)->get(['title','id']);
			$siteSearch['resorts'] = Category::whereType('tours')->whereActive(1)->where('parent', '!=', 308)->where('parent', '!=', 377)->where('parent', '!=', 0)->get(['title','id']);
			$siteSearch['vidy'] = Category::whereType('tours')->whereActive(1)->whereParent(377)->get(['title','id', 'url']);
			return $siteSearch;
		});
		View::share('siteSearch', $siteSearch);

        return $next($request);
    }
}
