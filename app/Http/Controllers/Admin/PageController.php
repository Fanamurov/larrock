<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Apps;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Models\Page;
use Redirect;
use DB;
use App\Helpers\ContentPlugins as ContentPlugins;
use App\Helpers\FormBuilder;
use JsValidator;
use Alert;

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
     * @param  \App\Helpers\ContentPlugins $plugins
	 * @return \Illuminate\Http\Response
	 */
	public function create(ContentPlugins $plugins)
	{
		$data['data'] = new Page;
        $data['data'] = $plugins->attach_data($this->plugins_backend, $data['data']);
		$data['app'] = $this->get_app();

        $data = $this->tabbable($data);

		$data['next_id'] = DB::table($this->table_content)->max('id') + 1;

		$validator = JsValidator::make($this->_valid_construct());
		\View::share('validator', $validator);

		return view('admin.apps.create', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @param  \App\Helpers\ContentPlugins $plugins
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id, ContentPlugins $plugins)
	{
		$data['data'] = Page::find($id);
        $data['data'] = $plugins->attach_data($this->plugins_backend, $data['data']);
        $data['app'] = $this->get_app();

        $data = $this->tabbable($data);
		$data['id'] = $id;

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
            Alert::add('success', 'Материал '. $request->input('title') .' изменен')->flash();

			$plugins->update($this->plugins_backend);
            return back();
        }

        Alert::add('error', 'Материал '. $request->input('title') .' не изменен')->flash();
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
        $today = getdate();
		$data->date = $request->input('position', $today['year'] .'-'. $today['mon'] .'-'. $today['mday']);

		if($data->save()){
            Alert::add('success', 'Материал '. $request->input('title') .' добавлен')->flash();
			\Input::input('connect_id', $data->id);
			$plugins->update($this->plugins_backend);

			return Redirect::to('/admin/'. $this->name .'/'. $data->id .'/edit')->withInput();
		}

        Alert::add('error', 'Материал '. $request->input('title') .' не добавлен')->flash();
		return back()->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
     * @param  \App\Helpers\ContentPlugins $plugins
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id, ContentPlugins $plugins)
	{
		$data = Page::find($id);
		if($data->delete()){
            Alert::add('success', 'Материал успешно удален')->flash();

            //TODO: уничтожение данные от плагинов фото, файлы
			$plugins->destroy($this->plugins_backend);
		}else{
            Alert::add('error', 'Материал не удален')->flash();
		}
		return Redirect::to('/admin/'. $this->name);
	}
}
