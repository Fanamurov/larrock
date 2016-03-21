<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use App\Models\Menu;
use Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
	public function __construct()
	{
		\View::share('menu', Menu::whereActive(1)->orderBy('position', 'DESC')->get());
		\View::share('banner', Blocks::whereUrl('banner')->first()->getFirstMediaUrl('images'));
	}

    public function getIndex()
	{
		$cart = Cart::content();
		if(count($cart) === 0){
			return redirect()->route('mainpage');
		}
		$seo = ['title' => 'Cart page'];
		return view('front.cart.table', compact('cart', 'seo', ['cart', 'seo']));
	}
}
