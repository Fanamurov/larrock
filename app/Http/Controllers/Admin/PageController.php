<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Apps;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Validator;
use App\Models\Page;
use Redirect;
use DB;
use App\Helpers\ContentPlugins as ContentPlugins;
use App\Helpers\FormBuilder;
use JsValidator;

class PageController extends Apps
{
	public function __construct()
	{
		$this->name = 'page';
		$this->title = 'Cтраницы';
		$this->description = 'Страницы без привязки к определенному разделу';
		$this->table_content = 'feed';
		$this->rows = [
			'title' => [
				'title' => 'Заголовок',
				'in_table_admin' => 'TRUE',
				'type' => 'text',
				'tab' => ['main' => 'Заголовок, описание'],
				'valid' => 'max:255|required',
				'typo' => 'true'
			],
			'description' => [
				'title' => 'Текст новости',
				'type' => 'textarea',
				'tab' => ['main' => 'Заголовок, описание']
			],
			'url' => [
				'title' => 'URL материала',
				'type' => 'text',
				'tab' => ['seo' => 'Seo'],
				'valid' => 'max:155|required'
			],
			'date' => [
				'title' => 'Дата материала',
				'type' => 'date',
				'tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'date_format:Y-m-d'
			],
			'position' => [
				'title' => 'Вес материала',
				'type' => 'text',
				'tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'integer',
				'default' => 0
			],
			'active' => [
				'title' => 'Опубликован',
				'type' => 'checkbox',
				'checked' => 'TRUE',
				'tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'integer|max:1',
				'default' => 1
			],
		];
		$this->settings = '';
		$this->plugins_backend = ['seo', 'images', 'files', 'templates'];
		$this->plugins_front = '';
		$this->version = 24;
		$this->check_app();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 * @param  \App\Helpers\FormBuilder $formBuilder
	 * @return \Illuminate\Http\Response
	 */
	public function create(FormBuilder $formBuilder)
	{
		$data['data'] = new Page;
		$data['app'] = $this->get_app();

		$data = $this->plugin_seo($data);
		$data = $this->plugin_templates($data);
		$data['tabs'] = $this->get_tabs_names_admin();
		$data['next_id'] = DB::table($this->table_content)->max('id') + 1;
		$data['app']->rows = $this->rows;

		foreach($data['tabs'] as $tab_key => $tab_value){
			$data['form'][$tab_key] = $formBuilder->render($data['app'], $data['data'], $tab_key);
		}

		$validator = JsValidator::make($this->_valid_construct());
		\View::share('validator', $validator);

		return view('admin.apps.create', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @param  \App\Helpers\FormBuilder $formBuilder
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id, FormBuilder $formBuilder)
	{
		$data['data'] = Page::find($id);
		//Подключаем данные от плагинов
		$data = $this->plugin_seo($data);
		$data = $this->plugin_templates($data);
		$data['id'] = $id;

		$data['tabs'] = $this->get_tabs_names_admin();
		//Получаем конфиг компонента
		$data['app'] = $this->get_app();
		//Обновляем данные о полях: включаем плагины
		$data['app']->rows = $this->rows;

		foreach($data['tabs'] as $tab_key => $tab_value){
			$data['form'][$tab_key] = $formBuilder->render($data['app'], $data['data'], $tab_key);
		}

		$validator = JsValidator::make($this->_valid_construct());
		\View::share('validator', $validator);

		return view('admin.apps.edit', $data);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
	 * @param  \App\Helpers\ContentPlugins $plugins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, ContentPlugins $plugins)
    {
        $validator = Validator::make($request->all(), $this->_valid_construct());
        if($validator->fails()){
            return back()->withInput($request->except('password'))->withErrors($validator);
        }

        $data = Page::find($id);
        if($data->fill($request->all())->save()){
            Session::flash('message', 'Материал '. $request->input('title') .' изменен');

			$plugins->update($this->plugins_backend);
            return back();
        }

        Session::flash('error', 'Материал '. $request->input('title') .' не изменен');
        return back()->withInput();
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Helpers\ContentPlugins $plugins
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, ContentPlugins $plugins)
	{
		$validator = Validator::make($request->all(), $this->_valid_construct());
		if($validator->fails()){
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Page();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->position = $request->input('position', 0);

		if($data->save()){
			Session::flash('message', 'Материал '. $request->input('title') .' добавлен');
			\Input::input('connect_id', $data->id);
			$plugins->update($this->plugins_backend);

			return Redirect::to('/admin/'. $this->name .'/'. $data->id .'/edit')->withInput();
		}

		Session::flash('error', 'Материал '. $request->input('title') .' не добавлен');
		return back()->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id, ContentPlugins $plugins)
	{
		$data = Page::find($id);
		if($data->delete()){
			Session::flash('message', 'Материал успешно удален');

			$plugins->destroy($this->plugins_backend);
		}else{
			Session::flash('error', 'Материал не удален');
		}
		return Redirect::to('/admin/'. $this->name);
	}
}
