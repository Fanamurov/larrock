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

        $module_vidy = Cache::remember('module_vidy', 60, function() {
            return Category::whereParent(377)->whereActive(1)->orderBy('position', 'DESC')->get();
        });
		View::share('module_vidy', $module_vidy);

        $module_strany = Cache::remember('module_strany', 60, function() {
            return Category::whereParent(308)->whereActive(1)->with(['get_childActive'])->orderBy('position', 'DESC')->get();
        });
        View::share('module_strany', $module_strany);

        MenuApp::create('navbar', function($menu) use ($module_vidy, $module_strany)
        {
            $menu->dropdown('Страны', function ($sub) use ($module_strany) {
                foreach ($module_strany as $item){
                    //$sub->url('/tours/strany/'. $item->url, $item->title, ['icon' => 'flag-icon flag-icon-'. mb_strimwidth($item->url, 0, 2)]);
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
			$menu->url('/page/partnery', 'Партнеры');
			$menu->url('/page/pochemu-pokupat-tury-nado-tolko-u-nas', 'О компании');
			$menu->url('/page/bronirovanie-i-oplata-turov-instruktsiya', 'Бронирование и оплата');
			$menu->url('/page/oplata-on-layn', 'Оплата он-лайн');
		});

        return $next($request);
    }
}
