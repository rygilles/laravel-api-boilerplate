<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

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
        Validator::extend('strength', 'App\Http\CustomValidator@validateStrength');
        Validator::extend('uppercase_min', 'App\Http\CustomValidator@validateUppercaseMin');
        Validator::extend('lowercase_min', 'App\Http\CustomValidator@validateLowercaseMin');
        Validator::extend('numeric_min', 'App\Http\CustomValidator@validateNumericMin');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
