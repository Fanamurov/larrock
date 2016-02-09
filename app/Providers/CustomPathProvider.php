<?php

namespace App\Providers;

use app\Helpers\FormBuilder;
use Illuminate\Support\ServiceProvider;
use Spatie\MediaLibrary\Test\PathGenerator\CustomPathGenerator;

class CustomPathProvider extends ServiceProvider
{
	protected $defer = true;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('App\Helpers\CustomPath\CustomPathInterface', function(){
			return new CustomPathGenerator();
		});
	}
}
