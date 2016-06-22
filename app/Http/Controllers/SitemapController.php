<?php

namespace App\Http\Controllers;

use App;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Hotels;
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
        //$sitemap->setCache('laravel.sitemap', 3600);

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
                $sitemap->add(URL::to('/tours/vidy-otdykha/'.$value->url), $value->updated_at, '1.0', 'monthly');
            }

            $strany = Category::whereParent(308)->whereActive(1)->with(['get_childActive', 'get_childActive.get_toursActive', 'get_toursActive'])->get();
            foreach ($strany as $value){
                $sitemap->add(URL::to('/tours/strany/'.$value->url), $value->updated_at, '1.0', 'monthly');
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

            $hotels = Hotels::whereActive(1)->get();
            foreach ($hotels as $value){
                $sitemap->add(URL::to('/hotels/'.$value->url), $value->updated_at, '1.0', 'monthly');
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
		$sitemap->store('xml', 'sitemap');
        echo 'OK';
	}

	public function rss()
	{
		$feed = App::make("feed");
		// set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
		// by default cache is disabled
		$feed->setCache('laravel.rss', 600);
		//$feed->clearCache();
		//Cache::flush();

		// check if there is cached feed and build new only if is not
		if( !$feed->isCached())
		{
			// set your feed's title, description, link, pubdate and language
			$feed->title = 'Santa-avia.ru :: Новости, блог, туры';
			$feed->description = 'Публикуем свежие новости, статьи из блока и обновления по индивидуальным турам';
			$feed->logo = 'http://santa-avia.ru/_assets/_santa/_images/logo.png';
			$feed->link = 'http://santa-avia.ru/feed.rss';
			$feed->setDateFormat('carbon'); // 'datetime', 'timestamp' or 'carbon'
			$feed->pubdate = Carbon::now();
			$feed->lang = 'ru';
			$feed->setShortening(false); // true or false
			$feed->setTextLimit(100); // maximum length of description text

			$blog = Blog::whereActive(1)->whereToRss(1)->with(['get_category', 'getFirstImage'])->orderBy('updated_at', 'DESC')->get();
			foreach ($blog as $value){
				$enclosure = [];
				$value->description = mb_strimwidth(strip_tags($value->description), 0, 350, '...');
				if(isset($value->getFirstImage->id)){
					$enclosure = ['url'=> 'http://santa-avia.ru'. $value->getFirstImage->getUrl(), 'type'=>'image/jpeg'];
					//echo 'http://santa-avia.ru'. $value->getFirstImage->getUrl() .'<br/>';
					$value->description = '<img src="http://santa-avia.ru'. $value->getFirstImage->getUrl() .'"/>'. $value->description;
				}

				$feed->add(
					$value->title,
					$feed->title,
					URL::to('/blog/'. $value->get_category->url .'/'. $value->url),
					$value->updated_at,
					mb_strimwidth(strip_tags($value->short), 0, 200, '...'),
					$value->description,
					$enclosure
				);
			}

			$news = News::whereActive(1)->whereToRss(1)->with(['get_category', 'getFirstImage'])->orderBy('updated_at', 'DESC')->get();
			foreach ($news as $value){
				$enclosure = [];
				$value->description = mb_strimwidth(strip_tags($value->description), 0, 350, '...');
				if($value->getMedia('images')->sortByDesc('order_column')->first()){
					if($img = $value->getMedia('images')->sortByDesc('order_column')->first()->getUrl()){
						$enclosure = ['url'=> 'http://santa-avia.ru'. $img,'type'=>'image/jpeg'];
						$value->description = '<img src="http://santa-avia.ru'. $img .'"/>'. $value->description;
					}
				}
				$feed->add(
					$value->title,
					$feed->title,
					URL::to('/news/'. $value->get_category->url .'/'. $value->url),
					$value->updated_at,
					mb_strimwidth(strip_tags($value->short), 0, 200, '...'),
					$value->description,
					$enclosure
				);
			}

			$strany = Category::whereParent(308)->whereActive(1)->whereToRss(1)->with(['get_childActive', 'get_childActive.get_toursActive', 'get_toursActive'])->orderBy('updated_at', 'DESC')->get();
			foreach ($strany as $value){
				$enclosure = [];
				$value->description = $description = mb_strimwidth(strip_tags($value->description), 0, 350, '...');
				if($value->getMedia('images')->sortByDesc('order_column')->first()){
					if($img = $value->getMedia('images')->sortByDesc('order_column')->first()->getUrl()){
						$enclosure = ['url'=> 'http://santa-avia.ru'. $img,'type'=>'image/jpeg'];
						$value->description = '<img src="http://santa-avia.ru'. $img .'"/>'. $description;
					}
				}
				$feed->add(
					$value->title,
					$feed->title,
					URL::to('/tours/strany/'.$value->url),
					$value->updated_at,
					mb_strimwidth(strip_tags($value->short), 0, 200, '...'),
					$value->description,
					$enclosure
				);
				foreach ($value->get_toursActive as $tours){
					$enclosure = [];
					$tours->description = mb_strimwidth(strip_tags($tours->description), 0, 350, '...');
					if($tours->getMedia('images')->sortByDesc('order_column')->first()){
						if($img = $tours->getMedia('images')->sortByDesc('order_column')->first()->getUrl()){
							$enclosure = ['url'=> 'http://santa-avia.ru'. $img,'type'=>'image/jpeg'];
							$tours->description = '<img src="http://santa-avia.ru'. $img .'"/>'. $tours->description;
						}
					}
					$feed->add(
						$tours->title,
						$feed->title,
						URL::to('/tours/strany/'.$value->url.'/'. $tours->url),
						$tours->updated_at,
						mb_strimwidth(strip_tags($tours->short), 0, 200, '...'),
						$tours->description,
						$enclosure
					);
				}
				foreach ($value->get_childActive as $child){
					$enclosure = [];
					$child->description = mb_strimwidth(strip_tags($child->description), 0, 350, '...');
					if($child->getMedia('images')->sortByDesc('order_column')->first()){
						if($img = $child->getMedia('images')->sortByDesc('order_column')->first()->getUrl()){
							$enclosure = ['url'=> 'http://santa-avia.ru'. $img,'type'=>'image/jpeg'];
							$child->description = '<img src="http://santa-avia.ru'. $img .'"/>'. $child->descriptionn;
						}
					}
					$feed->add(
						$child->title,
						$feed->title,
						URL::to('/tours/strany/'.$value->url.'/'. $child->url),
						$child->updated_at,
						mb_strimwidth(strip_tags($child->short), 0, 200, '...'),
						$child->description,
						$enclosure
					);
					foreach ($child->get_toursActive as $child_tours){
						$enclosure = [];
						$child_tours->description = mb_strimwidth(strip_tags($child_tours->description), 0, 350, '...');
						if($child_tours->getMedia('images')->sortByDesc('order_column')->first()){
							if($img = $child_tours->getMedia('images')->sortByDesc('order_column')->first()->getUrl()){
								$enclosure = ['url'=> 'http://santa-avia.ru'. $img,'type'=>'image/jpeg'];
								$child_tours->description = '<img src="http://santa-avia.ru'. $img .'"/>'. $child_tours->description;
							}
						}
						$feed->add(
							$child_tours->title .'33',
							$feed->title,
							URL::to('/tours/strany/'.$value->url.'/'. $child_tours->url),
							$child_tours->updated_at,
							mb_strimwidth(strip_tags($child_tours->short), 0, 200, '...'),
							$child_tours->description,
							$enclosure
						);
					}
				}
			}
		}

		// first param is the feed format
		// optional: second param is cache duration (value of 0 turns off caching)
		// optional: you can set custom cache key with 3rd param as string
		return $feed->render('atom');

		// to return your feed as a string set second param to -1
		// $xml = $feed->render('atom', -1);
	}
}
