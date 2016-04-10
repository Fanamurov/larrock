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
		$banner = Cache::remember('banners_mod', 60, function() {
			if($banner = Blocks::whereUrl('banner')->whereActive(1)->first()){
				return $banner->getFirstMediaUrl('images');
			}
			return NULL;
		});
		if($banner){
			View::share('banner', $banner);
		}

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
                $sub->url('/page/o-kompanii', 'О компании', ['icon' => 'ico.png']);
                $sub->url('/news', 'Новости');
                $sub->url('/page/vakansii-santa-avia', 'Вакансии');
                $sub->url('/page/pochemu-pokupat-tury-nado-tolko-u-nas', 'Почему мы лучшие');
                $sub->url('settings/design', 'Наша команда');
                $sub->url('/page/zabota-o-klientakh', 'Забота о клиентах');
            });
            $menu->dropdown('Страны', function ($sub) use ($module_strany) {
                foreach ($module_strany as $item){
                    $sub->url('/tours/strany/'. $item->url, $item->title);
                }
            });
            $menu->dropdown('Виды отдыха', function ($sub) use ($module_vidy) {
                foreach($module_vidy as $key => $item){
                    $sub->url('/tours/vidy-otdykha/'. $item->url, $item->title);
                }
            });
            $menu->dropdown('Услуги', function ($sub) {
                $sub->url('/page/tur-na-zakaz', 'Тур на заказ');
                $sub->url('/page/aviabilety', 'Авиабилеты');
                $sub->url('/page/korporativnoe-obsluzhivanie', 'Корпоративное обслуживание');
                $sub->url('settings/account', 'Визовая поддержка');
                $sub->url('settings/account', 'Карта клиента');
                $sub->url('settings/account', 'Подарочные сертификаты');
            });
            $menu->url('/page/kontakty', 'Контакты');
            $menu->url('/otzyvy', 'Отзывы');
            $menu->url('/blog', 'Блог');
        });

        return $next($request);
    }
}
