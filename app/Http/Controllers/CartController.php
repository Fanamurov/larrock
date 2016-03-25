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
		$this->middleware('loaderModules');
	}

    public function getIndex()
	{
		$cart = Cart::content();
		if(Cart::count() === 0){
			\Alert::add('message', 'Ваша корзина пуста');
			return redirect('/');
		}
		$seo = ['title' => 'Cart page'];
		return view('front.cart.table', compact('cart', 'seo', ['cart', 'seo']));
	}
}
