<?php

namespace App\Http\Controllers\Modules;

use App\Models\Category;
use Cache;
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
		$data = Cache::remember('list_catalog', 60, function() {
		    return Category::type('catalog')->orderBy('position', 'DESC')->get(['title', 'url', 'level']);
		});
		return $data;
	}
}
