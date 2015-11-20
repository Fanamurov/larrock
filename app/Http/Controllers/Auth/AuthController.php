<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use Request;
use Sentinel;

class AuthController extends Controller
{
	public function getLogin()
	{
		if ($user = Sentinel::getUser())
		{
			var_dump($user->getUserLogin());
		}
		return view('auth.login');
	}

	public function postLogin(Request $request)
	{
		Sentinel::logout();
		$credentials = [
			'email'    => $request::input('email'),
			'password' => $request::input('password'),
		];

		Sentinel::authenticateAndRemember($credentials);

		if ($user = Sentinel::getUser())
		{
			var_dump($user->getUserLogin());
		}
		else
		{
			echo 'NOT';
		}
	}

	public function getLogout()
	{
		Sentinel::logout();
		return redirect('/auth/login');
	}

	public function getRegister()
	{
		return view('auth.register');
	}

	public function postRegister(Request $request)
	{
		// Register a new user
		Sentinel::register([
			'email'    => $request::input('email'),
			'password' => $request::input('password'),
		]);

		$user = Sentinel::findById(1);

		$role = Sentinel::findRoleByName('admin');

		$role->users()->attach($user);

		echo '<pre>';
		print_r($request::all());
		echo '</pre>';
		exit('');

	}
}
