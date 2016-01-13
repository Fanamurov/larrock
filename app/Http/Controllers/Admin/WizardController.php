<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App;
use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Breadcrumbs;
use Excel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use Route;
use View;
use App\Models\Config as Model_Config;

class WizardController extends Controller
{
	protected $config;

	public function __construct(MenuBlock $menu)
	{
		$this->config = Config::get('components.wizard');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}

		Breadcrumbs::register('admin.wizard.index', function($breadcrumbs)
		{
			$breadcrumbs->push('Wizard');
		});
	}

	public function step1()
	{
		$data['app'] = $this->config;
		$data['catalog'] = Config::get('components.catalog');
		$get_wizard_config = Model_Config::whereType('wizard')->whereKey('catalog')->first();
		$data['wizard'] = $get_wizard_config->value;
		$data['colomns'] = $this->getColomnNames();

		Breadcrumbs::register('admin.wizard.step1', function($breadcrumbs)
		{
			$breadcrumbs->parent('admin.wizard.index');
			$breadcrumbs->push('Настройка полей', route('admin.wizard'));
			$breadcrumbs->push('Правила экспорта');
			$breadcrumbs->push('Экспорт');
		});

		return view('admin.wizard.step1', $data);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function step3()
    {
		Excel::filter('chunk')->load('resources/wizard/test.xls')->chunk(25, function($results)
		{
			// Loop through all sheets
			$results->each(function($sheet) {
				// Loop through all rows
				$sheet->each(function($row) {
					//Определение раздела {=Rчисло=}
					if($row = $this->search_category($row)){

						//Это раздел
						Input::merge($this->prepare_category($row->toArray()));
						$request = Request::create('/admin/category', 'POST');
						$r = Route::dispatch($request);
						//$r = app()->handle($request);
						dd($r);
						exit('1');
					}else{
						//Это товар
					}
					dd($row);
				});

			});
		});

		$app['name'] = 'Wizard. Export .xls to catalog';
		return view('admin.wizard.step2', ['app' => $app]);
    }

	/**
	 * Подготовка раздела для сохранения в БД через POST request /admin/category
	 * @param $category
	 *
	 * @return array
	 */
	protected function prepare_category($category)
	{
		$data = [];
		$get_wizard_config = Model_Config::whereType('wizard')->whereKey('catalog')->first();
		$rows = $get_wizard_config->value;
		foreach($rows as $rows_key => $rows_value){
			if( !empty($rows_value['db'])){
				if($rows_value['db'] === 'title'){
					if(preg_match('/(.*?){=R\d=}/', $category[$rows_key], $title)){
						$data['title'] = $title['1'];
					}
					if(preg_match('/{=R(.*?)=}/', $category[$rows_key], $level)){
						$data['level'] = $level['1'];
					}
				}else{
					$data[$rows_value['db']] = Arr::get($category, $rows_key, '');
					if($data[$rows_value['db']] === null){
						$data[$rows_value['db']] = '';
					}
				}
			}
		}
		$data['type'] = 'catalog';
		$data['parent'] = 0;
		$contentPlugins = new App\Helpers\ContentPlugins();
		if(array_key_exists('level', $data)){
			$data['url'] = $contentPlugins->translit($data['title']) .'-'. $data['level'] .'-'. $data['parent'];
		}else{
			$data['url'] = $contentPlugins->translit($data['title']);
		}
		$data['sitemap'] = 1;
		$data['active'] = 1;
		$data['position'] = 0;
		return $data;
	}

	protected function getFillableRows()
	{
		$catalog = new App\Models\Catalog();
		return $catalog->getFillable();
	}

	protected function getColomnNames()
	{
		$colomns = collect();
		$sheets = Excel::load('resources/wizard/test.xls')->get();

		foreach($sheets as $sheet_value){
			foreach($sheet_value->first() as $key => $value){
				if( !in_array($key, $colomns->all(), FALSE)){
					$colomns->push($key);
				}
			}
		}
		return $colomns->all();
	}

	protected function search_category($row)
	{
		if(preg_match('/{=R\d=}/', $row->naimenovanie, $match)){
			if(preg_match('/(.*?){=R\d=}/', $row->naimenovanie, $title)){
				$row->put('title', $title['1']);
			}
			if(preg_match('/{=R(.*?)=}/', $row->naimenovanie, $level)){
				$row->put('level', $level['1']);
			}
			return $row;
		}
		return FALSE;
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeConfig(Request $request)
    {
		$write_config = [];
		$colomns = [];
		foreach($request->get('xls') as $colomn){
			$colomns[] = $colomn;
		}

		foreach($colomns as $colomns_key => $colomns_value){
			$write_config[$colomns_value]['db'] = $request->get('db')[$colomns_key];
			$write_config[$colomns_value]['slug'] = $request->get('slug')[$colomns_key];
		}

		if( !$data = Model_Config::whereType('wizard')->whereKey('catalog')->first()){
			$data = new Model_Config();
			$data->key = 'catalog';
			$data->type = 'wizard';
			$data->value = serialize($write_config);
		}else{
			$data->value = serialize($write_config);
		}
		if($data->save()){
			Alert::add('success', 'Настройки полей импорта сохранены')->flash();
		}
		return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
