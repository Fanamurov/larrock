<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Apps;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins as ContentPlugins;
use App\Helpers\Component;
use App\Models\Feed;
use App\Models\Category;
use DB;
use JsValidator;
use Config;
use View;

class FeedController extends Apps
{
	public function __construct()
	{
		$this->check_app('feed');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function index(ContentPlugins $ContentPlugins)
	{
        $get_config = Config::get('components.feed');
        $data['app'] = $ContentPlugins->attach_rows($get_config);
        $data['data'] = Feed::with('categoryInfo')->get();

		View::share('validator', '');
		return view('admin.feed.index', $data);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
	 * @param \App\Helpers\Component $component
     * @return \Illuminate\Http\Response
     */
    public function show($id, Component $component)
    {
		$data['app'] = $component->get_app($this->name, TRUE);
		$data['category'] = Category::whereId($id)->first();
		$data['data'] = Feed::whereCategory($id)->paginate(30);
		View::share('validator', '');
		return view('admin.feed.category', $data);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @param  \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id, ContentPlugins $ContentPlugins)
	{
		$data['data'] = Feed::with('categoryInfo')->find($id);
		$data['data'] = $ContentPlugins->attach_data($this->plugins_backend, $data['data']);
        $get_config = Config::get('components.feed');
        $data['app'] = $ContentPlugins->attach_rows($get_config);

		$data = Component::tabbable($data);
		$data['id'] = $id;

		$validator = JsValidator::make(Component::_valid_construct($this->rows));
		View::share('validator', $validator);

		return view('admin.feed.edit', $data);
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
