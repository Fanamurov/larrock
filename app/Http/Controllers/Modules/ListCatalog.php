<?php

namespace App\Http\Controllers\Modules;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Список разделов каталога (обычно в модуле справа)
 * Class ListCatalog
 *
 * @package App\Http\Controllers\Modules
 */
class ListCatalog extends Controller
{
    public function categories()
	{
		$data['data'] = Category::type('catalog')->with(['get_images'])->get(['title']);
		return view('front.modules.list.catalog', $data);
	}
}
