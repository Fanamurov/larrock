<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Cart;
use Cookie;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Ajax extends Controller
{
	public function sharingCounter(Request $request)
	{
		$pass_types = ['magic', 'tours', 'category', 'blog', 'news', 'hotels'];
		$type = $request->get('type', '');
		$id = $request->get('id', '');
		if(empty($type) OR empty($id)){
			return false;
		}
		if( !in_array($type, $pass_types)){
			return false;
		}
		if(\DB::table($type)->where('id', $id)->increment('sharing')){
			echo 'OK';
		}else{
			echo 'ERROR DB';
		}
	}

    public function editPerPage(Request $request)
	{
		$response = new \Illuminate\Http\Response('perPage');
		$response->withCookie(cookie('perPage', $request->get('q'), 45000));
		return $response;
	}

	public function sort(Request $request)
	{
		$response = new \Illuminate\Http\Response('sort');
		$response->withCookie(cookie('sort_'. $request->get('type'), $request->get('q'), 45000));
		return $response;
	}

	public function vid(Request $request)
	{
		$response = new \Illuminate\Http\Response('vid');
		$response->withCookie(cookie('vid', $request->get('q', 'cards'), 45000));
		return $response;
	}

	public function getTovar(Request $request)
	{
		if($get_tovar = Catalog::whereId($request->get('id'))->with(['get_category'])->first()){
			if($image_url = $get_tovar->getFirstMediaUrl('images')){
				$get_tovar['image_url'] = $image_url;
			}
			if($request->get('in_template') === 'true'){
				return view('front.modals.addToCart', ['data' => $get_tovar, 'config_app' => \Config::get('components.catalog')]);
			}else{
				return response()->json($get_tovar);
			}
		}else{
			return response('Товар не найден', 404);
		}
	}


	/* https://packagist.org/packages/gloudemans/shoppingcart */
	/**
	 * Add a row to the cart
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartAdd(Request $request)
	{
		$get_tovar = Catalog::whereId($request->get('id'))->firstOrFail();
		Cart::associate('Catalog', 'App\Models')->add($request->get('id'), $get_tovar->title, $request->get('qty', 1), $get_tovar->cost);
		return response(Cart::total());
	}

	/**
	 * Empty the cart
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartDestroy()
	{
		Cart::destroy();
		return response('OK');
	}

	/**
	 * Get the price total
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartTotal()
	{
		Cart::total();
		return response('OK');
	}

	/**
	 * Get the cart content
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartContent()
	{
		Cart::content();
		return response('OK');
	}

	/**
	 * Update params of one row of the cart
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartUpdate(Request $request)
	{
		Cart::update($request->get('rowid'), []);
		return response('OK');
	}

	/**
	 * Update the quantity of one row of the cart
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartQty(Request $request)
	{
		if($update = Cart::update($request->get('rowid'), $request->get('qty'))){
			$subtotal = $update->first()->subtotal;
			return response()->json(['total' => Cart::total(), 'subtotal' => $subtotal]);
		}else{
			abort('500', 'not valid data input');
			return false;
		}
	}

	/**
	 * Remove a row from the cart
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartRemove(Request $request)
	{
		Cart::remove($request->get('rowid'));
		return response(Cart::total());
	}

	/**
	 * Remove a row from the cart
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartCount()
	{
		Cart::count();      // Total items
		Cart::count(false); // Total rows
		return response('OK');
	}

	/**
	 * Search if the cart has a item
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function cartSearch()
	{
		Cart::search(array('id' => 1, 'options' => array('size' => 'L'))); // Returns an array of rowid(s) of found item(s) or false on failure
		return response('OK');
	}
}
