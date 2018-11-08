<?php

namespace Tests\Feature\Api;

use App\Models\UserGroup;
use App\Models\User;

/**
 * Class UserGroupTest
 *
 * 'api/userGroup/...' related routes tests
 *
 * @package Tests\Feature\Api
 */
class UserGroupTest extends ApiCase
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
		$response = $this->get($this->getRouteUrl('userGroup.index'), $this->getAuthorizationHeaders());
		
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
		$userGroup = UserGroup::create([
			'id'     => 'Test',
		]);
		
		$response = $this->get(
			$this->getRouteUrl('userGroup.show', ['userGroupId' => $userGroup->id]),
			$this->getAuthorizationHeaders()
		);
		
		$response->assertHeader('content-type', 'application/json');
		$response->assertStatus(200);
		
		$response->assertJson([
			'data' => [
				'id'     => 'Test',
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
	public function testRouteUserGroupUserIndex()
	{
		$userGroup = UserGroup::create([
			'id'     => 'Test',
		]);
		
		$user = User::create([
			'user_group_id'     => 'Test',
			'name'              => 'test',
			'email'             => 'test@test.com',
			'password'          => 'Test123!'
		]);
		
		$response = $this->get(
			$this->getRouteUrl('userGroupUser.index', ['userGroupId' => $userGroup->id]),
			$this->getAuthorizationHeaders()
		);
		
		$response->assertHeader('content-type', 'application/json');
		$response->assertStatus(200);
		
		$response->assertJsonStructure([
			'data'
		]);
		
		$response->assertJson([
			'data' => [
				[
					'id'                => $user->id,
					'user_group_id'     => $userGroup->id,
					'name'              => 'test',
					'email'             => 'test@test.com',
				]
			],
			'meta' => [
				'pagination' => [
					'total' => 1
				]
			]
		]);
	}
}
