<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Breadcrumbs;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;

class HotelsController extends Controller
{
    protected $config;

    public function __construct()
    {
        $this->config = \Config::get('components.tours');
        \View::share('config_app', $this->config);
        $this->middleware('loaderModules');

        Breadcrumbs::register('hotels.index', function($breadcrumbs)
        {
            $breadcrumbs->push('Каталог отелей', '/hotels');
        });
    }

    public function getHotels(Request $request)
    {
        $data['data'] = Cache::remember('hotels_'. $request->get('page'), 1440, function() {
          return Hotels::whereActive(1)->with(['getFirstImage', 'get_category'])->paginate(18);
        });

        return view('santa.hotels.all', $data);
    }
    
    public function getItem(Request $request, $item)
    {
        Breadcrumbs::register('hotels.item', function($breadcrumbs, $data)
        {
            $breadcrumbs->parent('hotels.index');
            $breadcrumbs->push($data->title);
        });

        $data['data'] = Hotels::whereUrl($item)->with(['get_category', 'getImages'])->first();
        \View::share('sharing_type', 'hotels');
        \View::share('sharing_id', $data['data']->id);
        return view('santa.hotels.item', $data);
    }
}
