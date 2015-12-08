<?php

namespace App\Providers;

use App\Helpers\Component;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
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
		$this->app->bind('App\Helpers\Component\ComponentInterface', function(){
			return new Component();
		});
    }
}
