<?php

namespace App\Providers;

use App\Helpers\Otapi\OtapiVendor;
use Illuminate\Support\ServiceProvider;

class OtapiProvider extends ServiceProvider
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
		$this->app->singleton(OtapiVendor::class, function ($app) {
			return new OtapiVendor();
		});
    }
}
