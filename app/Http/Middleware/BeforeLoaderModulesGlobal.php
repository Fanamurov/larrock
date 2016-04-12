<?php

namespace App\Http\Middleware;

use App\Models\Blocks;
use App\Models\Menu;
use Cache;
use Closure;
use Cookie;
use View;

class BeforeLoaderModulesGlobal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$banner = Cache::remember('banners_mod', 60, function() {
			if($banner = Blocks::whereUrl('banner')->whereActive(1)->first()){
				return $banner;
			}
			return NULL;
		});
		if($banner){
			View::share('banner', $banner);
		}

		$promo_text = Cache::remember('promo_text', 60, function() {
			if($promo_text = Blocks::whereUrl('promo-text')->whereActive(1)->first()){
				return $promo_text;
			}
			return NULL;
		});
		if($promo_text){
			View::share('promo_text', $promo_text);
		}

		$menu = Cache::remember('menu_front', 60, function() {
		    return Menu::whereActive(1)->orderBy('position', 'DESC')->get();
		});
		View::share('menu', $menu);

		//Cookie for promo-actions catalog
		if($request->get('UTM') === 'test' && Cookie::get('promo') !== 'true'){
			\Session::flash('promo', 'true'); //Чтобы иметь доступ к функциям до куки
			$response = $next($request);
			return $response->withCookie(cookie('promo', 'true', 604000));
		}else{
			return $next($request);
		}
    }
}
