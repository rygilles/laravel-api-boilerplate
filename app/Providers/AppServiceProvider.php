<?php

namespace App\Providers;

use App\Models\ApiModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

use App\Models\User;

use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Laravel 5.4 fix for unique column
        Schema::defaultStringLength(191);

	    // Disable vendor publish migrations / Use UUID for user_id in tables
	    Passport::ignoreMigrations();

        // Custom validators
        Validator::extend('uuid', 'App\Http\CustomValidator@validateUUID');
	    Validator::extend('md5', 'App\Http\CustomValidator@validateMd5');
        Validator::extend('strength', 'App\Http\CustomValidator@validateStrength');
        Validator::extend('uppercase_min', 'App\Http\CustomValidator@validateUppercaseMin');
        Validator::extend('lowercase_min', 'App\Http\CustomValidator@validateLowercaseMin');
        Validator::extend('numeric_min', 'App\Http\CustomValidator@validateNumericMin');
	    Validator::extend('hex', 'App\Http\CustomValidator@validateHex');
	    Validator::extend('app_locale', 'App\Http\CustomValidator@validateAppLocale');

        // Models observers
	    User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    // Passport : Disable default migrations
	    Passport::ignoreMigrations();
	
	    // Laravel IDE Helper
	
	    if (!in_array($this->app->environment(), ['production', 'staging'])) {
		    $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
	    }
    }
}
