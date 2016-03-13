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
		return $data['data'] = Category::type('catalog')->get(['title', 'url', 'level']);
	}
}
