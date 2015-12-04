<?php

namespace App\Providers;

use app\Helpers\ContentPlugins;
use Illuminate\Support\ServiceProvider;

class ContentPluginsServiceProvider extends ServiceProvider
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
		$this->app->bind('App\Helpers\Plugins\ContentPluginsInterface', function(){
			return new ContentPlugins();
		});
    }
}
