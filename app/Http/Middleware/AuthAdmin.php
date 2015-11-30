<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AuthAdmin
{
	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Запрашиваем роль посетителя
	 */
	public function __construct()
	{
		$this->isAdmin = NULL;
		if ($user = Sentinel::getUser())
		{
			$this->isAdmin = Sentinel::inRole('admin');
		}
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->isAdmin){
			return $next($request);
		}

		if ($request->ajax())
		{
			return response('Access forbidden', 403);
		}
		else
		{
			return redirect()->intended('admin/auth/login');
		}
	}
}
