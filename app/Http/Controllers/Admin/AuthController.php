<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use Request;
use Lang;
use Validator;
use Redirect;

class AuthController extends Controller
{
	public function getLogin()
	{
		if ($user = Sentinel::getUser())
		{
			Redirect::to('/admin');
		}
		return view('admin.auth.login');
	}

	public function postLogin(Request $request)
	{
		Sentinel::logout();

		$validation = Validator::make($request::all(), [
			'email' => 'required|min:5|email',
			'password' => 'required|min:3',
		]);

		if($validation->fails())
		{
			return Redirect::to('/admin/auth/login')->withInput()->withErrors($validation);
		}

		$credentials = [
			'email'    => $request::input('email'),
			'password' => $request::input('password'),
		];

		Sentinel::authenticateAndRemember($credentials);

		if ($user = Sentinel::getUser())
		{
			return redirect('/admin');
		}
		else
		{
			$validation->errors()->add('auth', Lang::get('auth.failed'));
			return Redirect::to('/admin/auth/login')->withInput()->withErrors($validation);
		}
	}

	public function getLogout()
	{
		Sentinel::logout();
		return redirect('admin/auth/login');
	}
}
