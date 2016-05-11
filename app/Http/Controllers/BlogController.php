<?php

namespace App\Http\Controllers;

use App\Helpers\ContentPlugins;
use App\Helpers\Sletat;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Feed;
use Breadcrumbs;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
	public function __construct(Sletat $sletat)
	{
		$this->middleware('loaderModules');

        Breadcrumbs::register('blog.index', function($breadcrumbs)
        {
            $breadcrumbs->push('Блог', '/blog');
        });
	}
	
    public function index(Request $request)
	{
		$page = $request->get('page', 1);
		$data = Cache::remember('blog_index'.$page, 1440, function() use ($page) {
			$data['category'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->orderBy('updated_at', 'desc')->with(['get_blogActive'])->get();
			$data['data'] = Blog::whereActive(1)->with('get_category')->orderBy('updated_at', 'desc')->skip(($page-1)*20)->paginate(15);
			return $data;
		});

		return view('santa.blog.index', $data);
	}

	public function show(Request $request, $category)
	{
		$page = $request->get('page', 1);
		$data = Cache::remember('blog_'.$category.'_'.$page, 1440, function() use ($category, $page) {
			$data['categorys'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->orderBy('updated_at', 'desc')->with(['get_blogActive'])->get();
			$data['category'] = Category::whereUrl($category)->whereActive(1)->with(['get_blogActive'])->first();
			$data['data'] = Blog::whereActive(1)->whereCategory($data['category']->id)->orderBy('updated_at', 'desc')->skip(($page-1)*20)->paginate(15);
			return $data;
		});

        Breadcrumbs::register('blog.category', function($breadcrumbs) use ($data)
        {
            $breadcrumbs->parent('blog.index');
            $breadcrumbs->push($data['category']->title);
        });

		return view('santa.blog.category', $data);
	}

	public function getItem(ContentPlugins $contentPlugins, $category, $item)
	{
        Cache::forget(md5('blog_item_'. $item));
		$data = Cache::remember(md5('blog_item_'. $item), 1440, function() use ($item, $category, $contentPlugins) {
			$data['data'] = Blog::whereUrl($item)->first();
			$data['category'] = Category::whereUrl($category)->whereActive(1)->first();
			$data['categorys'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->with(['get_blogActive'])->get();
            $data['data']['images'] = $data['data']->getMedia('images');
            $data['data'] = $contentPlugins->renderGallery($data['data']);
			return $data;
		});

        Breadcrumbs::register('blog.item', function($breadcrumbs) use ($data)
        {
            $breadcrumbs->parent('blog.index');
            $breadcrumbs->push($data['category']->title, '/blog/'. $data['category']->url);

        });

		if(\View::exists('santa.blog.'. $item)){
			return view('santa.blog.'. $item, $data);
		}else{
			return view('santa.blog.item', $data);
		}
	}
}
