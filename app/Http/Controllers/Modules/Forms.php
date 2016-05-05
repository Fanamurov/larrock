<?php

namespace App\Http\Controllers\Modules;

use Alert;
use App\Helpers\Sletat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Mail;

class Forms extends Controller
{
    public function formPodbor()
	{
		return view('santa.modules.forms.podbor', []);
	}

	public function send_form(Request $request)
	{
		Alert::add('danger', 'Отправка форм отключена')->flash();
		return back();

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.contact',
			['name' => $request->get('name'), 
				'name' => $request->get('name'),
				'contact' => $request->get('contact'),
				'comment' => $request->get('comment')],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки '. Arr::get($_SERVER, 'SERVER_NAME')
				);
		});
		
		if($send){
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

	public function send_formZakazTura(Request $request)
	{
		Alert::add('danger', 'Отправка форм отключена')->flash();
		return back();

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.ZakazTura',
			['name' => $request->get('name'),
				'tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'date' => $request->get('date'),
				'comment' => $request->get('comment'),
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки '. Arr::get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

	public function send_formZakazSert(Request $request)
	{
		Alert::add('danger', 'Отправка форм отключена')->flash();
		return back();

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.ZakazSert',
			['name' => $request->get('name'),
				'tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'summa' => $request->get('summa'),
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки '. Arr::get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

	public function send_formPodbor(Request $request)
	{
		Alert::add('danger', 'Отправка форм отключена')->flash();
		return back();
		
		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.podbor',
			['name' => $request->get('name'),
				'tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'country' => $request->get('country'),
				'date' => $request->get('date'),
				'time' => $request->get('time'),
				'comment' => $request->get('comment'),
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки '. Arr::get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

	public function send_formsletatOrderShort(Request $request, Sletat $sletat)
	{
		Alert::add('danger', 'Отправка форм отключена')->flash();
		return back();

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.podbor',
			['name' => $request->get('name'),
				'tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'comment' => $request->get('comment'),
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки на бронирование тура от sletat '. Arr::get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			$sletat->SaveTourOrder($request);
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

	public function send_formsletatOrderFull(Request $request, Sletat $sletat)
	{
		Alert::add('danger', 'Отправка форм отключена')->flash();
		return back();

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.podbor',
			['name' => $request->get('name'),
				'tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'comment' => $request->get('comment'),
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки на бронирование тура для оплаты от sletat '. Arr::get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			$sletat->SaveTourOrder($request);
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}
}
