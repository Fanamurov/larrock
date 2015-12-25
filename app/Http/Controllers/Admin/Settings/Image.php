<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route;
use View;
use App\Models\Apps;
use App\Helpers\FormBuilder;
use Alert;
use Funct;
use App\Helpers\Component;

class Image extends Controller
{
    protected $config;

    public function __construct(MenuBlock $menu)
    {
        $this->config = Config::get('components.feed');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['apps'] = Config::get('components');
		foreach($data['apps'] as $app_key => $app_value){
            if(in_array('images', $app_value['plugins_backend'], TRUE)){
                if(isset($settings['image_original'])){
                    $settings['image_original'] = implode(',', $settings['image_original']);
                }else{
                    $settings['image_original'] = '';
                }
                if(isset($settings['image_generate'])){
                    $settings['image_generate'] = implode(',', $settings['image_generate']);
                }else{
                    $settings['image_generate'] = '';
                }
                $data['apps'][$app_key]['settings'] = $settings;
            }else{
				unset($data['apps'][$app_key]);
			}
		}
        dd($data['apps']);
        return View::make('admin.settings.image.index', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$get_app = Apps::find($request->get('id'));
		$settings = unserialize($get_app->settings);
		$settings['image_original'] = array_map('trim', explode(',', $request->input('image_original', 'none')));
		if( !Funct\Collection\get($settings['image_original'], 0)){
			$settings['image_original'] = [];
		}
		$settings['image_generate'] = array_map('trim', explode(',', $request->input('image_generate', 'none')));
		if( !Funct\Collection\get($settings['image_generate'], 0)){
			$settings['image_generate'] = [];
		}

		$get_app->settings = serialize($settings);

		if($get_app->save()){
			Alert::add('success', 'Пресет картинок '. $request->input('title') .' изменен')->flash();
			return back();
		}

		Alert::add('error', 'Пресет картинок '. $request->input('title') .' не изменен')->flash();
		return back()->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
