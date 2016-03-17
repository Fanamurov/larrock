<?php

namespace App\Http\Controllers\Modules;

use Alert;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Forms extends Controller
{
    public function contact(Request $request)
	{
		return view('front.modules.forms.contact', []);
	}

	public function send_form(Request $request)
	{
		Alert::add('success', 'Форма отправлена')->flash();
		Alert::add('error', 'Форма не отправлена')->flash();
		return back();
	}
}
