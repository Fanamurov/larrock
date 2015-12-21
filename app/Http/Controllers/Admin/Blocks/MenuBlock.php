<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Models\Category;
//use Illuminate\Http\Request;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Arr;

class MenuBlock extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($current_uri = '/')
    {
		$explode_uri = explode('/', $current_uri);
        $components = Config::get('components');
		foreach($components as $key => $component){
			if(in_array($component['name'], $explode_uri, TRUE)){
				$components[$key]['admin_menu_active'] = 'TRUE';
			}
			$components[$key]['admin_menu'] = Arr::get($component, 'admin_menu', ['default']);
			if(array_key_exists('type', Arr::get($component, 'admin_menu', []))){
				if($component['admin_menu']['type'] === 'category_list'){
					$components[$key]['admin_menu_items'] = Category::whereType($component['menu_category'])->get();
				}
			}
		}
		$data['components'] = $components;
		return view('admin.blocks.menu', $data);
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
}
