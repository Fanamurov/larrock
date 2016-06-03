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
use Validator;

class Forms extends Controller
{
    public function formPodbor()
	{
		return view('santa.modules.forms.podbor', []);
	}

	protected function sender(Request $request, $subject, $email_template){
		$to_email = $this->getEmailArray();
		$send = FALSE;
		foreach($to_email as $email_value){
			/** @noinspection PhpVoidFunctionResultUsedInspection */
			$send = Mail::send($email_template,
				$request->all(),
				function($message) use ($email_value, $subject){
					$message->from($email_value, env('MAIL_TO_ADMIN_NAME', 'TEST'));
					$message->to($email_value, env('MAIL_TO_ADMIN_NAME', 'TEST'));
					$message->subject($subject. ' '. array_get($_SERVER, 'SERVER_NAME')
					);
				});
		}
		return $send;
	}

	protected function getEmailArray(){
		$to_email = env('MAIL_TO_ADMIN', 'robot@martds.ru');
		$to_email = explode(',', $to_email);
		return array_map('trim', $to_email);
	}

	public function send_form(Request $request)
	{
		if(env('MAIL_STOP') === 'true'){
			Alert::add('danger', 'Отправка форм отключена')->flash();
			return back();
		}

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'contact' => 'required|max:255',
			'comment' => 'required',
		]);

		if ($validator->fails()) {
			Alert::add('danger', 'Ошибка при заполнении формы, проверьте данные')->flash();
			return back()->withErrors($validator)->withInput();
		}

		FormsLog::create(['formname' => 'contact', 'params' => $request->all(), 'status' => 'Новое']);
		$send = $this->sender($request, 'Отправлена форма заявки', 'emails.contact');
		
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

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'address' => 'required',
			'fio' => 'required',
			'place' => 'required',
			'tel' => 'required',
			'email' => 'required|email',
			'peoples' => 'required',
			'peoples_active' => 'required'
		]);

		if ($validator->fails()) {
			Alert::add('danger', 'Ошибка при заполнении формы, проверьте данные')->flash();
			return back()->withErrors($validator)->withInput();
		}

		FormsLog::create(['formname' => 'corporate', 'params' => $request->all(), 'status' => 'Новое']);
		$send = $this->sender($request, 'Отправлена анкета корпоративного обслуживания', 'emails.corporate');

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

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email',
			'date' => 'required|max:255'
		]);

		if ($validator->fails()) {
			Alert::add('danger', 'Ошибка при заполнении формы, проверьте данные')->flash();
			return back()->withErrors($validator)->withInput();
		}
		
		FormsLog::create(['formname' => 'zakazTura', 'params' => $request->all(), 'status' => 'Новое', 'tour_id' => $request->get('tour_id')]);
		$send = $this->sender($request, 'Отправлена форма заказа тура', 'emails.zakazTura');

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

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email',
			'city' => 'required|max:155',
			'adult' => 'required|max:15',
			'kids' => 'required|max:15',
			'baby' => 'required|max:15',
		]);

		if ($validator->fails()) {
			Alert::add('danger', 'Ошибка при заполнении формы, проверьте данные')->flash();
			return back()->withErrors($validator)->withInput();
		}

        FormsLog::create(['formname' => 'zakazHotel', 'params' => $request->all(), 'status' => 'Новое', 'hotel_id' => $request->get('hotel_id')]);
		$send = $this->sender($request, 'Отправлена форма бронирования отеля', 'emails.zakazHotel');

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

		$validator = Validator::make($request->all(), [
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email',
			'summa' => 'required|max:255'
		]);

		if ($validator->fails()) {
			Alert::add('danger', 'Ошибка при заполнении формы, проверьте данные')->flash();
			return back()->withErrors($validator)->withInput();
		}

		FormsLog::create(['formname' => 'zakazSert', 'params' => $request->all(), 'status' => 'Новое']);
		$send = $this->sender($request, 'Отправлена форма заказа сертификата', 'emails.zakazSert');

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

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email',
			'country' => 'required|max:255',
			'date' => 'required|max:255',
			'time' => 'required|max:255'
		]);

		if ($validator->fails()) {
			Alert::add('danger', 'Ошибка при заполнении формы, проверьте данные')->flash();
			return back()->withErrors($validator)->withInput();
		}

		FormsLog::create(['formname' => 'formPodbor', 'params' => $request->all(), 'status' => 'Новое']);
		$send = $this->sender($request, 'Отправлена форма подбора тура', 'emails.podborTura');

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

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email'
		]);

		if ($validator->fails()) {
			Alert::add('danger', 'Ошибка при заполнении формы, проверьте данные')->flash();
			return back()->withErrors($validator)->withInput();
		}

		$emails = $this->getEmailArray();
		$send = FALSE;
		foreach($emails as $email){
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
				function($message) use ($email){
					$message->from($email, env('MAIL_TO_ADMIN_NAME', 'TEST'));
					$message->to($email, env('MAIL_TO_ADMIN_NAME', 'TEST'));
					$message->subject('Отправлена форма заявки на бронирование тура от sletat '. Arr::get($_SERVER, 'SERVER_NAME')
					);
				});
		}

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

		$validator = Validator::make($request->all(), [
			'fio' => 'required|max:255',
			'address' => 'required',
			'tel' => 'required|max:255',
			'email' => 'required|max:255|email',
			'passport' => 'required|max:255',
			'passportDate' => 'required',
			'oferta' => 'required'
		]);

		if ($validator->fails()) {
			Alert::add('danger', 'Ошибка при заполнении формы, проверьте данные')->flash();
			return back()->withErrors($validator)->withInput();
		}

		$emails = $this->getEmailArray();
		$send = FALSE;
		foreach($emails as $email){
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
					'birthday' => $request->get('birthday'),
					'seriaZagran' => $request->get('seriaZagran'),
					'numberZagran' => $request->get('numberZagran'),
					'dateZagran' => $request->get('dateZagran'),
					'srokZagran' => $request->get('srokZagran'),
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
				function($message) use ($email){
					$message->from($email, env('MAIL_TO_ADMIN_NAME', 'TEST'));
					$message->to($email, env('MAIL_TO_ADMIN_NAME', 'TEST'));
					$message->subject('Отправлена форма заявки на бронирование тура для оплаты от sletat '. Arr::get($_SERVER, 'SERVER_NAME')
					);
				});
		}

		if($send){
			$saveOrder = $sletat->SaveTourOrder($request);
			if($saveOrder->IsError === false){
				Alert::add('success', 'Заказ помещен в базу туроператора')->flash();
			}
			Alert::add('success', 'Форма отправлена')->flash();
		}else{
			Alert::add('danger', 'Форма не отправлена')->flash();
		}
		return back();
	}
}
