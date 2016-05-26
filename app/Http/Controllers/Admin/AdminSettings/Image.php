<?php

namespace App\Http\Controllers\Admin\AdminSettings;

use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use Config;
use Illuminate\Contracts\Auth\Guard;
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
    protected $current_user;

    public function __construct(MenuBlock $menu, Guard $guard)
    {
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}
        $this->current_user = $guard->user();
        if( !$this->current_user->is(array_get($this->config, 'role', 'admin'))) {
            abort(403, 'У вас нет прав доступа к этому разделу');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.settings.image', $data = $this->prepare_config())->render();
    }

    /**
     * Store a newly created resource in storage.
	 * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$settings['image_original'] = $request->input('image_original', '');
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

		Alert::add('danger', 'Пресет картинок '. $request->get('name') .' не изменен')->flash();
		return back()->withInput();
    }

	/* TODO: перегенерация миниатюр и больших фото по пресетам */
	public function generate()
	{
		$config = $this->prepare_config();
		foreach($config['apps'] as $app => $config_item){

		}

		Alert::add('danger', 'Генерация картинок еще не написана')->flash();
		return back()->withInput();
	}

	public function prepare_config()
	{
		$data['apps'] = Config::get('components');
		foreach($data['apps'] as $app_key => $app_value){
			if(in_array('images', $app_value['plugins_backend'], TRUE)){
				$get_presets = Model_Config::whereType('image_presets')->whereKey($app_value['name'])->first();
				if(isset($get_presets->value)){
					if(array_key_exists('image_original', $get_presets->value)){
						$data['apps'][$app_key]['image_original'] = $get_presets->value['image_original'];
					}
					if(array_key_exists('image_generate', $get_presets->value)){
						$data['apps'][$app_key]['image_generate'] = implode(', ', $get_presets->value['image_generate']);
					}
				}
			}else{
				unset($data['apps'][$app_key]);
			}
		}
		return $data;
	}
}
