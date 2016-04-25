<?php

namespace App\Http\Middleware;

use App\Models\Blocks;
use App\Models\Category;
use App\Models\Menu;
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
            return Category::whereParent(377)->orderBy('position', 'DESC')->get();
        });
		View::share('module_vidy', $module_vidy);

        $module_strany = Cache::remember('module_strany', 60, function() {
            return Category::whereParent(308)->with(['get_childActive'])->orderBy('position', 'DESC')->get();
        });
        View::share('module_strany', $module_strany);

        MenuApp::create('navbar', function($menu) use ($module_vidy, $module_strany)
        {
            //$menu->url('/', 'Home');
            $menu->dropdown('Компания', function ($sub) {
                $sub->url('/page/o-kompanii', 'О компании', ['icon' => 'fi flaticon-circle']);
                $sub->url('/news', 'Новости', ['icon' => 'fi flaticon-interface']);
                $sub->url('/page/vakansii-santa-avia', 'Вакансии', ['icon' => 'fi flaticon-hands']);
                $sub->url('/page/pochemu-pokupat-tury-nado-tolko-u-nas', 'Почему<br/>мы лучшие', ['icon' => 'fi flaticon-business']);
                $sub->url('settings/design', 'Наша команда', ['icon' => 'fi flaticon-people-5']);
                $sub->url('/page/zabota-o-klientakh', 'Забота о клиентах', ['icon' => 'fi flaticon-two']);
            });
            $menu->dropdown('Страны', function ($sub) use ($module_strany) {
                foreach ($module_strany as $item){
                    //$sub->url('/tours/strany/'. $item->url, $item->title, ['icon' => 'flag-icon flag-icon-'. mb_strimwidth($item->url, 0, 2)]);
                    $sub->url('/tours/strany/'. $item->url, $item->title);
                }
            });
            $menu->dropdown('Виды отдыха', function ($sub) use ($module_vidy) {
                foreach($module_vidy as $key => $item){
					$title = str_replace(' ', '<br/>', $item->title);
					$title = str_replace('<br/>и', ' и', $title);
					$title = str_replace('<br/>с', ' c', $title);
                    $sub->url('/tours/vidy-otdykha/'. $item->url, $title, ['icon' => $item->url]);
                }
            });
            $menu->dropdown('Услуги', function ($sub) {
                $sub->url('/page/tur-na-zakaz', 'Тур на заказ', ['icon' => 'fi flaticon-road']);
                $sub->url('/page/aviabilety', 'Авиабилеты', ['icon' => 'fi flaticon-transport-1']);
                $sub->url('/page/korporativnoe-obsluzhivanie', 'Корпоративное<br/>обслуживание', ['icon' => 'fi flaticon-travel-3']);
                $sub->url('/visovaya-podderjka', 'Визовая<br/>поддержка', ['icon' => 'fi flaticon-people-1']);
                $sub->url('/page/karta-klienta', 'Карта<br/>клиента', ['icon' => 'fi flaticon-ribbon']);
                $sub->url('/page/podarochnye-sertifikaty', 'Подарочные<br/>сертификаты', ['icon' => 'fi flaticon-shapes']);
            });
            $menu->url('/page/kontakty', 'Контакты');
            $menu->url('/otzyvy', 'Отзывы');
            $menu->url('/blog', 'Блог');
        });

        return $next($request);
    }
}
