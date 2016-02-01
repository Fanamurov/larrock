<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
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
