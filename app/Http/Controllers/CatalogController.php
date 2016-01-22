<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
	protected $config;

	public function __construct()
	{
		$this->config = \Config::get('components.catalog');
	}

    public function getCategory()
	{
		$data['data'] = Category::whereType('catalog')->whereLevel(1)->whereActive(1)->with(
			['get_images'=> function($query){
				$query->whereTypeConnect('category');
			}]
		)->get();

		return view('front.catalog.categorys', $data);
	}
}
