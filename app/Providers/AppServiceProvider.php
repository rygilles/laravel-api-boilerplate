<?php

namespace App\Providers;

use App\Models\ApiModel;
use App\Models\SyncTask;
use App\Models\SyncTaskLog;
use App\Models\SyncTaskStatus;
use App\Models\SyncTaskType;
use App\Models\UserHasProject;
use App\Observers\SyncTaskLogObserver;
use App\Observers\SyncTaskObserver;
use App\Observers\UserHasProjectObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

use App\Models\User;
use App\Models\Project;

use App\Observers\UserObserver;
use App\Observers\ProjectObserver;
use App\Observers\SyncTaskTypeObserver;
use App\Observers\SyncTaskStatusObserver;

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
	    Validator::extend('search_engine_class_name', 'App\Http\CustomValidator@validateSearchEngineClassName');
	    Validator::extend('data_stream_decoder_class_name', 'App\Http\CustomValidator@validateDataStreamDecoderClassName');
	    Validator::extend('hex', 'App\Http\CustomValidator@validateHex');

        // Models observers
	    User::observe(UserObserver::class);
	    Project::observe(ProjectObserver::class);
	    UserHasProject::observe(UserHasProjectObserver::class);
	    SyncTask::observe(SyncTaskObserver::class);
	    SyncTaskType::observe(SyncTaskTypeObserver::class);
	    SyncTaskStatus::observe(SyncTaskStatusObserver::class);
	    SyncTaskLog::observe(SyncTaskLogObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    // Bugsnag
	    $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
	    $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
    }
}
