<?php

namespace App\Http\Middleware;

use App\Models\Blocks;
use App\Models\Category;
use App\Models\Menu;
use Cache;
use Closure;
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
				return $banner->getFirstMediaUrl('images');
			}
			return NULL;
		});
		if($banner){
			View::share('banner', $banner);
		}

		$menu = Cache::remember('menu_front', 60, function() {
		    return Menu::whereActive(1)->orderBy('position', 'DESC')->get();
		});
		View::share('menu', $menu);

		$module_vidy = Category::whereParent(377)->get();
		foreach($module_vidy as $key => $item){
			//$module_vidy['icon'] = $item->getFirstMediaUrl('images');
		}
		View::share('module_vidy', $module_vidy);

        return $next($request);
    }
}
