<?php

namespace App\Http\Controllers\Modules;

use Alert;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class Forms extends Controller
{
    public function contact()
	{
		return view('front.modules.forms.contact', []);
	}

	public function send_form(Request $request)
	{
		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.contact',
			['name' => $request->get('name'), 
				'contact' => $request->get('contact'), 
				'comment' => $request->get('comment')],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST@martds.ru'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST@martds.ru'));
				$message->subject('Отправлена форма заявки '. array_get($_SERVER, 'SERVER_NAME')
				);
		});
		
		if($send){
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

	public function send_formGetPrice(Request $request)
	{
		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.getPrice',
			['email' => $request->get('email')],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST@martds.ru'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST@martds.ru'));
				$message->subject('Запрошен прайс '. array_get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}
}
