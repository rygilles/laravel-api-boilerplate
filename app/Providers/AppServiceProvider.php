<?php

namespace App\Providers;

use App\Models\ApiModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

use App\Models\User;
use App\Models\Project;

use App\Observers\UserObserver;
use App\Observers\ProjectObserver;

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

        // Models observers
	    User::observe(UserObserver::class);
	    Project::observe(ProjectObserver::class);
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
