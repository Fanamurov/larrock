<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App;
use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use App\Models\Catalog;
use App\Models\Category;
use Breadcrumbs;
use Component;
use Excel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Arr;
use Route;
use Validator;
use View;
use App\Models\Config as Model_Config;

class AdminWizardController extends Controller
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

	/**
	 * Сопоставление полей в прайсе с БД и выводом сайта
	 *
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function aliases()
	{
		$data['app'] = $this->config;
		$data['catalog'] = Config::get('components.catalog');
		$get_wizard_config = Model_Config::whereType('wizard')->whereKey('catalog')->first();
		$data['wizard'] = $get_wizard_config->value;
		$data['colomns'] = $this->getColomnNames();

		//TODO: Проверка сопоставления обязательных для заполнения полей
		$data['required'] = [];
		$rows_passed = ['category', 'url', 'position', 'active', 'nalichie', 'articul'];
		foreach($data['catalog']['rows'] as $rows_key => $rows_value){
			if( !in_array($rows_key, $rows_passed, FALSE) && array_key_exists('valid', $rows_value)){
				$data['required'][$rows_key]= $rows_value;
				$data['required'][$rows_key]['attached'] = 'FALSE';
				foreach($data['wizard'] as $wizard_value){
					if($wizard_value['slug'] === $rows_key){
						$data['required'][$rows_key]['attached'] = 'TRUE';
					}
				}
			}
		}

		Breadcrumbs::register('admin.wizard.aliases', function($breadcrumbs)
		{
			$breadcrumbs->parent('admin.wizard.index');
			$breadcrumbs->push('Сопоставление полей');
			$breadcrumbs->push('Проверка xls', route('admin.wizard.check'));
			$breadcrumbs->push('Импорт', route('admin.wizard.import'));
		});

		return view('admin.wizard.aliases', $data);
	}

	/**
	 * Проверка xls на корректность
	 *
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function check()
	{
		$data['data'] = Excel::load('resources/wizard/test.xls', function($reader) {

		})->get();

		$data['app'] = $this->config;
		Breadcrumbs::register('admin.wizard.check', function($breadcrumbs)
		{
			$breadcrumbs->parent('admin.wizard.index');
			$breadcrumbs->push('Сопоставление полей');
			$breadcrumbs->push('Проверка xls', route('admin.wizard.check'));
			$breadcrumbs->push('Импорт', route('admin.wizard.import'));
		});

		return view('admin.wizard.check', $data);
	}

    /**
     * Импорт товаров из xls в БД
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
		$this->deleteCatalog();
		$this->deleteCategoryCatalog();

		Excel::filter('chunk')->load('resources/wizard/test.xls')->chunk(25, function($results)
		{
			// Loop through all sheets
			$results->each(function($sheet) {
				//Крайняя сохраненная категория товаров
				$saved_category = [];
				$saved_tovar = '';
				// Loop through all rows
				$sheet->each(function($row) use (&$saved_category, &$saved_tovar) {
					//Определение раздела {=Rчисло=}
					if($row_category = $this->search_category($row)){
						//Это раздел
						//return TRUE;
						$add_data = collect($this->prepareCategory($row_category->toArray(), $saved_category));
						$add_category = json_decode($this->storeCategory($add_data)->getContent());
						if($add_category->status === 'success'){
							$add_data['id'] = $add_category->message;
							$saved_category[(int)$add_data['level']] = $add_data;
							$saved_category['current'] = $add_data;
						}else{
							$explain = '';
							foreach($add_category->explain as $explain_value){
								$explain .= ' '. $explain_value;
							}
							abort('500', 'Category add: '. $add_category->message .':'. $explain);
						}
					}else{
						$add_data = collect($this->prepareTovar($row->toArray(), $saved_category, $saved_tovar));
						$store_tovar = json_decode($this->storeTovar($add_data)->getContent());
						if($store_tovar->status === 'success'){
							$saved_tovar = $store_tovar->message;
						}else{
							$explain = '';
							foreach($store_tovar->explain as $explain_value){
								$explain .= ' '. $explain_value;
							}
							abort('500', 'Tovar add '. $store_tovar->message .':'. $explain);
						}
					}
					//dd($row);
				});
			});
		});

		Breadcrumbs::register('admin.wizard.step3', function($breadcrumbs)
		{
			$breadcrumbs->parent('admin.wizard.index');
			$breadcrumbs->push('Сопоставление полей', route('admin.wizard'));
			$breadcrumbs->push('Проверка xls', route('admin.wizard.check'));
			$breadcrumbs->push('Импорт', route('admin.wizard.import'));
		});

		$data['app'] = $this->config;
		return view('admin.wizard.step3', $data);
    }

	/**
	 * Удаление всех товаров каталога и открепление разделов
	 * @return bool
	 */
	protected function deleteCatalog()
	{
		$delete = Catalog::all();
		foreach($delete as $delete_value){
			$delete_value->delete();
			$delete_value->get_category()->detach($delete_value->category, ['catalog_id' => $delete_value->id]);
		}
		return TRUE;
	}

	/**
	 * Удаление разделов каталога. Выполнять только после deleteCatalog()
	 * @return bool
	 */
	protected function deleteCategoryCatalog()
	{
		$delete = Category::whereType('catalog')->get();
		foreach($delete as $delete_value){
			$delete_value->delete();
		}
		return TRUE;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  $request
	 * @return \Illuminate\Http\Response
	 */
	public function storeTovar($request)
	{
		//dd($request->all());
		$config_catalog = Config::get('components.catalog');
		$validator = Validator::make($request->all(), Component::_valid_construct($config_catalog['rows']));
		if($validator->fails()){
			return response()->json(['status' => 'error', 'message' => 'validation error', 'explain' => $validator->errors()->all()]);
		}

		$data = new Catalog();
		$data->fill($request->all());
		$data->active = $request->get('active', 1);
		$data->position = $request->get('position', 0);
		$data->articul = 'AR'. $request->get('id');

		if($data->save()){
			//Присоединяем разделы
			foreach($request->get('category') as $category){
				$data->get_category()->attach($category, ['catalog_id' => $data->id]);
			}

			return response()->json(['status' => 'success', 'message' => $data->id]);
		}else{
			return response()->json(['status' => 'error', 'message' => 'data no added on db']);
		}
	}

	/**
	 * Подготовка товара для сохранения в БД
	 * @param array	$tovar			Массив с параметрами раздела
	 * @param array	$saved_category		Массив с параметрами ранее сохраненного раздела
	 * @param int $saved_tovar	ID сохраненного ранее товара
	 *
	 * @return array
	 */
	protected function prepareTovar($tovar, $saved_category, $saved_tovar)
	{
		$data = [];
		$get_wizard_config = Model_Config::whereType('wizard')->whereKey('catalog')->first();
		$rows = $get_wizard_config->value;
		foreach($rows as $rows_key => $rows_value){
			if( !empty($rows_value['db'])){
				$data[$rows_value['db']] = Arr::get($tovar, $rows_key, '');
				if($data[$rows_value['db']] === null){
					$data[$rows_value['db']] = '';
				}
			}
		}

		$data['category'] = [$saved_category['current']['id']];
		$contentPlugins = new App\Helpers\ContentPlugins();
		$data['url'] = $contentPlugins->translit($data['title'] .'-'. $saved_category['current']['id']. '-'. $saved_tovar);
		$data['nalichie'] = '9999999';
		return $data;
	}

	/**
	 * Добавление раздела в БД
	 * @param $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function storeCategory($request)
	{
		$config_category = Config::get('components.category');
		$validator = Validator::make($request->all(), Component::_valid_construct($config_category['rows']));
		if($validator->fails()){
			return response()->json(['status' => 'error', 'message' => 'validation error', 'explain' => $validator->errors()->all()]);
		}
		$data = new Category();
		$data->fill($request->all());
		$data->active = $request->get('active', 1);
		$data->position = $request->get('position', 0);

		if($request->get('parent') !== 0){
			if($get_parent = Category::find($request->get('parent'))->first()){
				$data->level = (int) $get_parent->level +1;
			}
		}else{
			$data->level = 1;
		}

		if($data->save()){
			return response()->json(['status' => 'success', 'message' => $data->id]);
		}else{
			return response()->json(['status' => 'error', 'message' => 'data no added on db']);
		}
	}

	/**
	 * Подготовка раздела для сохранения в БД
	 * @param array	$category			Массив с параметрами раздела
	 * @param array	$saved_category		Массив с параметрами ранее сохраненного раздела
	 *
	 * @return array
	 */
	protected function prepareCategory($category, $saved_category)
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
						$data['level'] = ++$level['1'];
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
		if(array_key_exists($data['level']-1, $saved_category)){
			$data['parent'] = $saved_category[$data['level']-1]['id'];
		}else{
			$data['parent'] = 0;
		}
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
