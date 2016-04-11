<?php

namespace App\Http\Middleware;

use App\Models\Seo;
use Closure;
use URL;
use View;

class GetSeo
{
	protected $seo;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$get_seo = Seo::whereTypeConnect('custom_main')->first();
		$this->seo['postfix_global'] = $get_seo->seo_title;

		$get_seo = Seo::whereTypeConnect('catalog_category_postfix')->first();
		$this->seo['catalog_category_postfix'] = $get_seo->seo_title;

		$get_seo = Seo::whereTypeConnect('catalog_category_prefix')->first();
		$this->seo['catalog_category_prefix'] = $get_seo->seo_title;

		/*$current_url = URL::current();
		$parse_url = parse_url($current_url);
		if(array_key_exists('path', $parse_url)){
			$explode_path = explode('/', $parse_url['path']);
			$controller = $explode_path[1];
			$param = $explode_path[2];
			//dd($explode_path);
		}else{
			$this->seo['title'] = $this->seo['postfix_global'];
		}
		$request->flash(null, 'TEST');*/

		//dd(parse_url($current_url));
		View::share('seo_midd', $this->seo);
        return $next($request);
    }
}
