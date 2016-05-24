<?php

namespace App\Http\Controllers\Modules;

use Alert;
use App\Helpers\Sletat;
use App\Models\FormsLog;
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
		if(env('MAIL_STOP') === 'true'){
			Alert::add('danger', 'Отправка форм отключена')->flash();
			return back();
		}

		FormsLog::create(['formname' => 'contact', 'params' => $request->all(), 'status' => 'Новое']);

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.contact',
			['name' => $request->get('name'),
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

	public function send_corporate(Request $request)
	{
		if(env('MAIL_STOP') === 'true'){
			Alert::add('danger', 'Отправка форм отключена')->flash();
			return back();
		}

		FormsLog::create(['formname' => 'corporate', 'params' => $request->all(), 'status' => 'Новое']);

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.corporate',
			$request->all(),
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена анкета корпоративного обслуживания '. Arr::get($_SERVER, 'SERVER_NAME')
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
		if(env('MAIL_STOP') === 'true'){
			Alert::add('danger', 'Отправка форм отключена')->flash();
			return back();
		}
		
		FormsLog::create(['formname' => 'zakazTura', 'params' => $request->all(), 'status' => 'Новое', 'tour_id' => $request->get('tour_id')]);

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.zakazTura',
			['name' => $request->get('name'),
				'tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'date' => $request->get('date'),
				'comment' => $request->get('comment'),
				'tour_name' => $request->get('tour_name'),
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заказа тура '. Arr::get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

    public function send_formZakazHotel(Request $request)
    {
        if(env('MAIL_STOP') === 'true'){
            Alert::add('danger', 'Отправка форм отключена')->flash();
            return back();
        }

        FormsLog::create(['formname' => 'zakazHotel', 'params' => $request->all(), 'status' => 'Новое', 'hotel_id' => $request->get('hotel_id')]);

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $send = Mail::send('emails.zakazTura',
            ['name' => $request->get('name'),
                'tel' => $request->get('tel'),
                'email' => $request->get('email'),
                'date' => $request->get('date'),
                'date-out' => $request->get('date-out'),
                'comment' => $request->get('comment'),
                'hotel_name' => $request->get('hotel_name'),
                'adult' => $request->get('adult', 2),
                'kids' => $request->get('kids', 0),
                'baby' => $request->get('baby', 0),
                'city' => $request->get('city'),
            ],
            function($message){
                $message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
                $message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
                $message->subject('Отправлена форма бронирования отеля '. Arr::get($_SERVER, 'SERVER_NAME')
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
		if(env('MAIL_STOP') === 'true'){
			Alert::add('danger', 'Отправка форм отключена')->flash();
			return back();
		}

		FormsLog::create(['formname' => 'zakazSert', 'params' => $request->all(), 'status' => 'Новое']);

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.zakazSert',
			['tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'summa' => $request->get('summa'),
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заказа сертификата '. Arr::get($_SERVER, 'SERVER_NAME')
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
		if(env('MAIL_STOP') === 'true'){
			Alert::add('danger', 'Отправка форм отключена')->flash();
			return back();
		}

		FormsLog::create(['formname' => 'formPodbor', 'params' => $request->all(), 'status' => 'Новое']);
		
		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.podborTura',
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
		if(env('MAIL_STOP') === 'true'){
			Alert::add('danger', 'Отправка форм отключена')->flash();
			return back();
		}

		$ActualizePrice = $sletat->ActualizePrice($request);

		FormsLog::create(['formname' => 'formsletatOrderShort', 'params' => $request->all(), 'addict' => $ActualizePrice, 'status' => 'Новое']);

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.sletatOrderShort',
			['name' => $request->get('name'),
				'tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'sourceId' => $request->get('sourceId'),
				'offerId' => $request->get('offerId'),
				'countryId' => $request->get('countryId'),
				'requestId' => $request->get('requestId'),
				'cityFromName' => $request->get('cityFromName'),
				'countryName' => $request->get('countryName'),
				'comment' => $request->get('comment'),
				'sletat' => $ActualizePrice
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки на бронирование тура от sletat '. Arr::get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}

	public function send_formsletatOrderFull(Request $request, Sletat $sletat)
	{
		if(env('MAIL_STOP') === 'true'){
			Alert::add('danger', 'Отправка форм отключена')->flash();
			return back();
		}

		$ActualizePrice = $sletat->ActualizePrice($request);

		FormsLog::create(['formname' => 'formsletatOrderFull', 'params' => $request->all(), 'addict' => $ActualizePrice, 'status' => 'Новое']);

		/** @noinspection PhpVoidFunctionResultUsedInspection */
		$send = Mail::send('emails.sletatOrderFull',
			['fio' => $request->get('fio'),
				'tel' => $request->get('tel'),
				'email' => $request->get('email'),
				'address' => $request->get('address'),
				'passport' => $request->get('passport'),
				'passportDate' => $request->get('passportDate'),

				'firstname' => $request->get('firstname'),
				'lastname' => $request->get('lastname'),
				'citizenship' => $request->get('citizenship'),
				'gender' => $request->get('gender'),
				'birthday' => array_values(array_unique($request->get('birthday'))),
				'seriaZagran' => $request->get('seriaZagran'),
				'numberZagran' => $request->get('numberZagran'),
				'dateZagran' => array_values(array_unique($request->get('dateZagran'))),
				'srokZagran' => array_values(array_unique($request->get('srokZagran'))),
				'ktoZagran' => $request->get('ktoZagran'),

				'sourceId' => $request->get('sourceId'),
				'offerId' => $request->get('offerId'),
				'countryId' => $request->get('countryId'),
				'requestId' => $request->get('requestId'),
				'cityFromName' => $request->get('cityFromName'),
				'countryName' => $request->get('countryName'),
				'comment' => $request->get('comment'),
				'sletat' => $ActualizePrice
			],
			function($message){
				$message->from(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->to(env('MAIL_TO_ADMIN', 'robot@martds.ru'), env('MAIL_TO_ADMIN_NAME', 'TEST'));
				$message->subject('Отправлена форма заявки на бронирование тура для оплаты от sletat '. Arr::get($_SERVER, 'SERVER_NAME')
				);
			});

		if($send){
			$saveOrder = $sletat->SaveTourOrder($request);
			if($saveOrder->isError === 'false'){
				Alert::add('success', 'Заказ помещен в базу туроператора')->flash();
			}
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}
}
