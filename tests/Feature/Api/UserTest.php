<?php

namespace Tests\Feature\Api;

use App\Mails\UserEmailValidation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserTest
 *
 * 'api/user/...' related routes tests
 *
 * @package Tests\Feature\Api
 */
class UserTest extends ApiCase
{
    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @return void
     */
    public function testRouteIndex()
    {
    	$response = $this->get($this->getRouteUrl('user.index'), $this->getAuthorizationHeaders());
	    
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        
        $response->assertJsonStructure([
            'data'
        ]);
    }
    
    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @return void
     */
    public function testRouteShow()
    {
        $user = User::create([
            'user_group_id'     => 'End-User',
            'name'              => 'test',
            'email'             => 'test@test.com',
            'password'          => 'Test123!'
        ]);
        
        $response = $this->get(
            $this->getRouteUrl('user.show', ['userId' => $user->id]),
            $this->getAuthorizationHeaders()
        );
        
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        
        $response->assertJsonStructure([
            'data' => [
                'id',
                'created_at',
                'updated_at'
            ]
        ]);
        
        $response->assertJson([
            'data' => [
                'user_group_id'     => 'End-User',
                'name'              => 'test',
                'email'             => 'test@test.com',
            ]
        ]);
    }
    
    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @return void
     */
    public function testRouteStore()
    {
        $response = $this->post(
            $this->getRouteUrl('user.store'),
            [
                'user_group_id'     => 'End-User',
                'name'              => 'test',
                'email'             => 'test@test.com',
                'password'          => 'Test123!',
                'double_optin'      => false
            ],
            $this->getAuthorizationHeaders()
        );
        
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(201);
        
        $response->assertJsonStructure([
            'data' => [
                'id',
                'created_at',
                'updated_at'
            ]
        ]);
        
        $response->assertJson([
            'data' => [
                'user_group_id'     => 'End-User',
                'name'              => 'test',
                'email'             => 'test@test.com',
            ]
        ]);
    }
    
    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @return void
     */
    public function testRouteStoreDoubleOptIn()
    {
        Mail::fake();
        
        $response = $this->post(
            $this->getRouteUrl('user.store'),
            [
                'user_group_id'     => 'End-User',
                'name'              => 'test',
                'email'             => 'test@test.com',
                'password'          => 'Test123!',
                'double_optin'      => true
            ],
            $this->getAuthorizationHeaders()
        );
        
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(201);
        
        $response->assertJsonStructure([
            'data' => [
                'id',
                'created_at',
                'updated_at'
            ]
        ]);
        
        $response->assertJson([
            'data' => [
                'user_group_id'     => 'End-User',
                'name'              => 'test',
                'email'             => 'test@test.com',
            ]
        ]);
        
        Mail::assertQueued(UserEmailValidation::class);
    }
    
    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @return void
     */
    public function testRouteUpdatePut()
    {
        $user = User::create([
            'user_group_id'     => 'End-User',
            'name'              => 'test',
            'email'             => 'test@test.com',
            'password'          => 'Test123!'
        ]);
        
        $response = $this->put(
            $this->getRouteUrl('user.update', ['userId' => $user->id]),
            [
                'user_group_id'     => 'End-User',
                'name'              => 'test1',
                'email'             => 'test1@test.com',
                'password'          => 'Test1234!'
            ],
            $this->getAuthorizationHeaders()
        );
        
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        
        $response->assertJsonStructure([
            'data' => [
                'id',
                'created_at',
                'updated_at'
            ]
        ]);
        
        $response->assertJson([
            'data' => [
                'user_group_id'     => 'End-User',
                'name'              => 'test1',
                'email'             => 'test1@test.com',
            ]
        ]);
    }
    
    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @return void
     */
    public function testRouteUpdatePatch()
    {
        $user = User::create([
            'user_group_id'     => 'End-User',
            'name'              => 'test',
            'email'             => 'test@test.com',
            'password'          => 'Test123!'
        ]);
        
        $response = $this->patch(
            $this->getRouteUrl('user.update', ['userId' => $user->id]),
            [
                'name'              => 'test1',
                'email'             => 'test1@test.com',
            ],
            $this->getAuthorizationHeaders()
        );
        
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        
        $response->assertJsonStructure([
            'data' => [
                'id',
                'created_at',
                'updated_at'
            ]
        ]);
        
        $response->assertJson([
            'data' => [
                'name'              => 'test1',
                'email'             => 'test1@test.com',
            ]
        ]);
    }
    
    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @return void
     */
    public function testRouteDestroy()
    {
        $user = User::create([
            'user_group_id'     => 'End-User',
            'name'              => 'test',
            'email'             => 'test@test.com',
            'password'          => 'Test123!'
        ]);
        
        $response = $this->delete(
            $this->getRouteUrl('user.destroy', ['userId' => $user->id]),
            [],
            $this->getAuthorizationHeaders()
        );
        
        $response->assertStatus(204);
        
        $this->assertNull(User::find($user->id));
    }
}
