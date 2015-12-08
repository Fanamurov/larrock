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

class FeedController extends Apps
{
	public function __construct()
	{
		$this->check_app('feed');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param \App\Helpers\Component $component
	 * @return \Illuminate\Http\Response
	 */
	public function index(Component $component)
	{
		$data['apps'] = $component->get_app($this->name, TRUE);
		$data['data'] = Category::whereType($this->menu_category)->whereLevel(1)->get();
		foreach($data['data'] as $category_key => $category_value){
			$data['data'][$category_key]['data'] = Feed::whereCategory($category_value->id)->paginate(30);
		}
		//$data['data'] = Feed::with('get_category')->whereCategory(1)->paginate(30);
		\View::share('validator', '');
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
		$data['apps'] = $component->get_app($this->name, TRUE);
		$data['category'] = Category::find($id)->first();
		$data['data'] = Feed::whereCategory($id)->paginate(30);
		\View::share('validator', '');
		return view('admin.feed.category', $data);
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
