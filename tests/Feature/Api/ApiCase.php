<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

abstract class ApiCase extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    
    protected $connectionsToTransact = [];
    
    /**
     * User for testing purpose
     *
     * @var User
     */
    protected $user;
    
    /**
     * User Personal Access Token for testing purpose
     *
     * @var string
     */
    protected $userToken;
    
    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @return void
     */
    public function runDatabaseMigrations()
    {
        $this->artisan(
            'migrate:fresh',
            [
                '--database' => 'sqlite',
                '--path' => 'database/migrations'
            ]
        );
        
        $this->app[Kernel::class]->setArtisan(null);
        
        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', ['--database' => 'sqlite']);
            
            RefreshDatabaseState::$migrated = false;
        });
    }
    
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        
        // Set default connection
        Config::set('database.default', 'sqlite');
        
        $this->artisan('passport:install');
        
        // Set default connection
        Config::set('database.default', 'sqlite');
        
        $this->artisan(
            'db:seed',
            [
                '--database' => 'sqlite',
                '--class' => 'InitSeeder'
            ]
        );
        
        // Set default connection
        Config::set('database.default', 'sqlite');
        
        // Use Env defined user group
        $TEST_USER_GROUP = getenv('TEST_USER_GROUP');
        
        if ($TEST_USER_GROUP) {
            $this->createUser($TEST_USER_GROUP);
        } else {
            $this->createUser();
        }
        
        // Auth user
        Auth::login($this->user);
        
        $this->createUserPersonalAccessToken();
    }
    
    /**
     * Create user for testing purpose.
     *
     * @param string $user_group_id
     * @return User
     */
    protected function createUser($user_group_id = 'Developer')
    {
        $this->user = User::create([
            'user_group_id'         => $user_group_id,
            'name'                  => 'phpunit',
            'email'                 => 'phpunit@domain.tld',
            'password'              => 'phpunit', // Magic setter auto crypt
            'preferred_language'    => 'en',
            'confirmed_at'          => Carbon::now()
        ]);
        
        return $this->user;
    }
    
    /**
     * Create user Personal Access Token for testing purpose.
     *
     * @return string
     */
    protected function createUserPersonalAccessToken()
    {
        $this->userToken = $this->user->createToken('testing')->accessToken;
        
        return $this->userToken;
    }
    
    /**
     * Return authorization headers for Api requests tests.
     *
     * @return string[]
     */
    protected function getAuthorizationHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . $this->userToken
        ];
    }
    
    /**
     * Return url of the matching Api route using Dingo UrlGenerator
     *
     * @param string $name Route name to match
     * @param string[] $parameters Route parameters
     * @param string $version Version to match
     * @return string
     */
    protected function getRouteUrl($name, $parameters = [], $version = 'v1')
    {
        return app('Dingo\Api\Routing\UrlGenerator')->version($version)->route($name, $parameters);
    }
}
