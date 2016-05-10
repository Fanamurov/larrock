<?php

namespace App\Http\Controllers;

use App;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Feed;
use App\Models\News;
use App\Models\Page;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use URL;

class SitemapController extends Controller
{
    public function index()
	{
        $sitemap = App::make("sitemap");
        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 3600);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached())
        {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');

            $visa = App\Models\Visa::whereActive(1)->get();
            $sitemap->add(URL::to('/visovaya-podderjka'), Carbon::now(), '1.0', 'monthly');
            foreach ($visa as $value){
                $sitemap->add(URL::to('/visovaya-podderjka/'. $value->url), $value->updated_at, '1.0', 'monthly');
            }

            $blog = Blog::whereActive(1)->with(['get_category'])->get();
            $sitemap->add(URL::to('/blog'), Carbon::now(), '1.0', 'monthly');
            foreach ($blog as $value){
                $sitemap->add(URL::to('/blog/'. $value->get_category->url .'/'. $value->url), $value->updated_at, '1.0', 'monthly');
            }

            $news = News::whereActive(1)->with(['get_category'])->get();
            $sitemap->add(URL::to('/news'), Carbon::now(), '1.0', 'monthly');
            foreach ($news as $value){
                $sitemap->add(URL::to('/news/'. $value->get_category->url .'/'. $value->url), $value->updated_at, '1.0', 'monthly');
            }

            $pages = Page::whereActive(1)->get();
            foreach ($pages as $value){
                $sitemap->add(URL::to($value->url), $value->updated_at, '1.0', 'monthly');
            }

            $vidy = Category::whereParent(377)->whereActive(1)->get();
            foreach ($vidy as $value){
                $sitemap->add(URL::to('/tours/vidy-otdykha/'.$value->url), $value->updated_at, '2.0', 'monthly');
            }

            $strany = Category::whereParent(308)->whereActive(1)->with(['get_childActive', 'get_childActive.get_toursActive', 'get_toursActive'])->get();
            foreach ($strany as $value){
                $sitemap->add(URL::to('/tours/strany/'.$value->url), $value->updated_at, '2.0', 'monthly');
                foreach ($value->get_toursActive as $tours){
                    $sitemap->add(URL::to('/tours/strany/'.$value->url.'/'. $tours->url), $value->updated_at, '1.0', 'monthly');
                }
                foreach ($value->get_childActive as $child){
                    $sitemap->add(URL::to('/tours/strany/'.$value->url.'/'. $child->url), $value->updated_at, '1.0', 'monthly');
                    foreach ($child->get_toursActive as $child_tours){
                        $sitemap->add(URL::to('/tours/strany/'.$value->url.'/'. $child_tours->url), $value->updated_at, '1.0', 'monthly');
                    }
                }
            }

            $sletat = new App\Helpers\Sletat;
            $data['GetDepartCities'] = Cache::remember('GetDepartCities', 60, function() use ($sletat) {
                return $sletat->GetDepartCities();
            });
            $data['GetCountries'] = Cache::remember('GetCountries', 60, function() use ($data, $sletat){
                return $sletat->GetCountries($data['GetDepartCities']->first()->Id);
            });

            foreach ($data['GetDepartCities'] as $city){
                foreach ($data['GetCountries'] as $country){
                    $sitemap->add(URL::to('/sletat?cityFromId='. $city->Id .'&countryId='. $country->Id .'&date-int='. Carbon::now()->format('d/m/Y') .'+-+'. Carbon::now()->addMonth()->format('d/m/Y') .'&s_adults=2'), Carbon::now(), '1.0', 'daily');
                }
            }
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
	}
}
