<?php

return [

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => 'http://localhost',

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Vladivostok',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'ru',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY', 'SomeRandomString'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => 'single',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        //Illuminate\Routing\ControllerServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

		App\Providers\FormBuilderServiceProvider::class,
		App\Providers\ContentPluginsServiceProvider::class,
		/* Кастомные пути для medialibrary */
		App\Providers\CustomPathProvider::class,

        /* http://image.intervention.io/getting_started/installation */
        Intervention\Image\ImageServiceProvider::class,

        /* https://cartalyst.com/manual/sentinel/2.0#installation :: ACL, Oauth, register etc. */
        Cartalyst\Sentinel\Laravel\SentinelServiceProvider::class,

        /* https://packagist.org/packages/barryvdh/laravel-ide-helper */
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,

        /* https://packagist.org/packages/barryvdh/laravel-debugbar */
        Barryvdh\Debugbar\ServiceProvider::class,

        Prologue\Alerts\AlertsServiceProvider::class,

		App\Providers\ComponentServiceProvider::class,

        /* https://packagist.org/packages/rap2hpoutre/laravel-log-viewer */
        //Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,

        /* https://packagist.org/packages/mccool/laravel-auto-presenter :: A system for auto-decorating models with presenter objects. */
        //McCool\LaravelAutoPresenter\AutoPresenterServiceProvider::class,

        /* https://packagist.org/packages/proengsoft/laravel-jsvalidation */
        Proengsoft\JsValidation\JsValidationServiceProvider::class,

        /* https://packagist.org/packages/roumen/sitemap :: Generate sitenap.xml */
        //Roumen\Sitemap\SitemapServiceProvider::class,

        /* https://packagist.org/packages/gloudemans/shoppingcart :: Корзина для каталога */
        Gloudemans\Shoppingcart\ShoppingcartServiceProvider::class,

        /* https://packagist.org/packages/greggilbert/recaptcha :: Каптча */
        Greggilbert\Recaptcha\RecaptchaServiceProvider::class,

		/* http://laravel-breadcrumbs.davejamesmiller.com/ */
		DaveJamesMiller\Breadcrumbs\ServiceProvider::class,

		/* http://www.maatwebsite.nl/laravel-excel/docs/import */
		Maatwebsite\Excel\ExcelServiceProvider::class,

		/* https://github.com/jarektkaczyk/eloquence :: Поиск по сайту */
		Sofa\Eloquence\ServiceProvider::class,

		/* https://github.com/GrahamCampbell/Laravel-Exceptions */
		GrahamCampbell\Exceptions\ExceptionsServiceProvider::class,

		/* http://medialibrary.spatie.be/v3/installation-and-setup/ */
		Spatie\MediaLibrary\MediaLibraryServiceProvider::class,

		/* https://github.com/LaravelRUS/localized-carbon/blob/master/docs/README-ru.md */
		//Laravelrus\LocalizedCarbon\LocalizedCarbonServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        'Auth'      => Illuminate\Support\Facades\Auth::class,
        'Blade'     => Illuminate\Support\Facades\Blade::class,
        'Bus'       => Illuminate\Support\Facades\Bus::class,
        'Cache'     => Illuminate\Support\Facades\Cache::class,
        'Config'    => Illuminate\Support\Facades\Config::class,
        'Cookie'    => Illuminate\Support\Facades\Cookie::class,
        'Crypt'     => Illuminate\Support\Facades\Crypt::class,
        'DB'        => Illuminate\Support\Facades\DB::class,
        'Eloquent'  => Illuminate\Database\Eloquent\Model::class,
        'Event'     => Illuminate\Support\Facades\Event::class,
        'File'      => Illuminate\Support\Facades\File::class,
        'Gate'      => Illuminate\Support\Facades\Gate::class,
        'Hash'      => Illuminate\Support\Facades\Hash::class,
        'Input'     => Illuminate\Support\Facades\Input::class,
        'Inspiring' => Illuminate\Foundation\Inspiring::class,
        'Lang'      => Illuminate\Support\Facades\Lang::class,
        'Log'       => Illuminate\Support\Facades\Log::class,
        'Mail'      => Illuminate\Support\Facades\Mail::class,
        'Password'  => Illuminate\Support\Facades\Password::class,
        'Queue'     => Illuminate\Support\Facades\Queue::class,
        'Redirect'  => Illuminate\Support\Facades\Redirect::class,
        'Redis'     => Illuminate\Support\Facades\Redis::class,
        'Request'   => Illuminate\Support\Facades\Request::class,
        'Response'  => Illuminate\Support\Facades\Response::class,
        'Route'     => Illuminate\Support\Facades\Route::class,
        'Schema'    => Illuminate\Support\Facades\Schema::class,
        'Session'   => Illuminate\Support\Facades\Session::class,
        'Storage'   => Illuminate\Support\Facades\Storage::class,
        'URL'       => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View'      => Illuminate\Support\Facades\View::class,

		'FormBuilder' 	=> App\Providers\FormBuilderServiceProvider::class,
		'Component' 	=> \App\Helpers\Component::class,
		'Tree' 			=> \App\Helpers\Tree::class,

        'Image'     => Intervention\Image\Facades\Image::class,
        'Alert'     => Prologue\Alerts\Facades\Alert::class,

        'Activation' => Cartalyst\Sentinel\Laravel\Facades\Activation::class,
        'Reminder'   => Cartalyst\Sentinel\Laravel\Facades\Reminder::class,
        'Sentinel'   => Cartalyst\Sentinel\Laravel\Facades\Sentinel::class,

        'Debugbar' 		=> Barryvdh\Debugbar\Facade::class,
        'Breadcrumbs' 	=> DaveJamesMiller\Breadcrumbs\Facade::class,
        'JsValidator' 	=> Proengsoft\JsValidation\Facades\JsValidatorFacade::class,
		'Excel' 		=> Maatwebsite\Excel\Facades\Excel::class,
        'Cart'        	=> Gloudemans\Shoppingcart\Facades\Cart::class,
        'Recaptcha' 	=> Greggilbert\Recaptcha\Facades\Recaptcha::class,
        'Search' 		=> Sofa\Eloquence\ServiceProvider::class,

    ],

];
