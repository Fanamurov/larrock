<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route;
use View;
use App\Models\Config as Model_Config;
use App\Helpers\FormBuilder;
use Alert;
use App\Helpers\Component;
use Illuminate\Support\Arr;

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
		//TODO: значения конфига в строку (implode)
        $data['apps'] = Config::get('components');
		foreach($data['apps'] as $app_key => $app_value){
            if(in_array('images', $app_value['plugins_backend'], TRUE)){
				$app_value['image_presets'] = Model_Config::whereType('image_presets')->whereKey($app_value['name'])->first()->toArray();
				dd($app_value['image_presets']);
				$app_value['image_presets'] = unserialize(Arr::get($app_value['image_presets'], 'value', []));
				if(array_key_exists('image_original', $app_value['image_presets'])){
					$app_value['image_presets']['image_original'] = implode(',', $app_value['image_presets']['image_original']);
				}
				if(array_key_exists('image_generate', $app_value['image_presets'])){
					$app_value['image_presets']['image_generate'] = implode(',', $app_value['image_presets']['image_generate']);
				}
            }else{
				unset($data['apps'][$app_key]);
			}
		}
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
		$settings['image_original'] = array_map('trim', explode(',', $request->input('image_original', 'none')));
		$settings['image_generate'] = array_map('trim', explode(',', $request->input('image_generate', 'none')));
		$settings = serialize($settings);

		if( !$data = Model_Config::whereType('image_presets')->whereKey($request->get('name'))->first()){
			$data = new Model_Config();
		}
		$data->key = $request->get('name');
		$data->value = $settings;
		$data->type = 'image_presets';

		if($data->save()){
			Alert::add('success', 'Пресет картинок '. $request->get('name') .' изменен')->flash();
			return back();
		}

		Alert::add('error', 'Пресет картинок '. $request->get('name') .' не изменен')->flash();
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
