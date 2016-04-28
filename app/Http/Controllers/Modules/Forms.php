<?php

namespace App\Http\Controllers\Modules;

use Alert;
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
}
