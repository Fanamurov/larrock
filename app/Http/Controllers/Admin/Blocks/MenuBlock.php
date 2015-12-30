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
     * @param string $current_uri
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
					$components[$key]['admin_menu_items'] = Category::whereType($component['menu_category'])->whereLevel(1)->get();
					$components[$key]['admin_menu_items']->push(['title' => 'Общий список', 'id' => '']);
				}
                if($component['admin_menu']['type'] === 'hidden'){
                    unset($components[$key]);
                }
			}
		}
		$data['components'] = $components;
        $data['current_uri'] = $explode_uri;
		return view('admin.blocks.menu', $data);
    }
}
