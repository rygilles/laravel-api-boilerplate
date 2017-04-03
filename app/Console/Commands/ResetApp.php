<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use App\Models\I18nLang;
use App\Models\SearchEngine;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserGroup;

use Laravel\Passport\Token;
use Laravel\Passport\AuthCode;
use Laravel\Passport\Client;
use Laravel\Passport\PersonalAccessClient;

class ResetApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will reset all your database data and (optionally) ' .
                             'seed your app with samples data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $this->info('EMSEARCH Setup : App Reset (For DEV purpose only !)');
	    $this->info('(Ask to ryan@e-monsite.com for more information)');
	    $this->warn('');
	    $this->warn('This command will reset all your database data and (optionally) ' . "\n" .
		            'seed your app with samples data.');

	    if ($this->confirm('Do you wish to continue ?', false)) {
		    $this->resetDatabaseData();
		    
		    // Initialize with required data
		    $this->info('Initialize with required data seeder');
		    Artisan::call('db:seed', ['--class' => 'InitSeeder'], $this->getOutput());

		    if ($this->confirm('Run Passport install ? (highly recommended ! generate required app clients)', true)) {
			    Artisan::call('passport:install', [], $this->getOutput());
		    }

		    if ($this->confirm('Do you want to seed your application with some samples data ?', false)) {
			    // Seed with samples data
			    $this->info('Seed with samples data');
			    Artisan::call('db:seed', ['--class' => 'SamplesSeeder'], $this->getOutput());
		    }

		    $this->info('Your application is ready now.');
	    } else {
		    $this->info('Ok, nothing changes');
	    }
    }

	/**
	 * Reset all database table using models (with cascade like dependencies delete)
	 * @throws \Exception
	 */
	public function resetDatabaseData()
	{
		// /!\ Reset all tables data (using models tables dependencies)

		$this->warn('Reset all tables data (using models tables dependencies)');

		foreach (User::all() as $user) {
			$user->delete();
		}
		$this->info('Users removed');

		foreach (I18nLang::all() as $i18nLang) {
			$i18nLang->delete();
		}
		$this->info('I18nLangs removed');

		foreach (SearchEngine::all() as $searchEngine) {
			$searchEngine->delete();
		}
		$this->info('SearchEngines removed');

		foreach (UserRole::all() as $userRole) {
			$userRole->delete();
		}
		$this->info('UserRoles removed');

		foreach (UserGroup::all() as $userGroup) {
			$userGroup->delete();
		}
		$this->info('UserGroups removed');

		// Passport tables
		$this->info('Passport tables :');
		
		foreach (Token::all() as $token) {
			$token->delete();	
		};
		$this->info('Tokens removed');

		foreach (AuthCode::all() as $authCode) {
			$authCode->delete();
		};
		$this->info('AuthCodes removed');

		foreach (Client::all() as $client) {
			$client->delete();
		};
		$this->info('Clients removed');

		foreach (PersonalAccessClient::all() as $personalAccessClient) {
			$personalAccessClient->delete();
		};
		$this->info('PersonalAccessClients removed');
		
		DB::table('oauth_refresh_tokens')->truncate();
		$this->info('oauth_refresh_tokens table truncated');

		DB::table('oauth_refresh_tokens')->truncate();
		$this->info('oauth_refresh_tokens table truncated');

		DB::table('password_resets')->truncate();
		$this->info('password_resets table truncated');
	}
}
