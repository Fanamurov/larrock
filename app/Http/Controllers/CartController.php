<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Blocks;
use App\Models\Menu;
use Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class CartController extends Controller
{
	public function __construct()
	{
		$this->middleware('loaderModules');
	}

    public function getIndex()
	{
		$cart = Cart::content();
		foreach($cart as $key => $item){
			$cart[$key]['image'] = $item->catalog->getMedia('images')->sortByDesc('order_column')->first();
		}
		if(Cart::count() === 0){
			Alert::add('message', 'Ваша корзина пуста');
			return redirect('/');
		}
		$seo = ['title' => 'Корзина товаров. Оформление заявки'];
		return view('front.cart.table', compact('cart', 'seo', ['cart', 'seo']));
	}

	public function sendOrderShort(Request $request)
	{
		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.orderShort',
			['name' => $request->get('name'),
				'contact' => $request->get('contact'),
				'comment' => $request->get('comment'),
				'cart'	=>	Cart::content()],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST@martds.ru'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST@martds.ru'));
				$message->subject('Отправлена форма заявки '. array_get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			Alert::add('success', 'Заявка успешно отправлена. С Вами свяжется наш менеджер')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена. Ошибка отправки')->flash();
		}
		return back();
	}
}
