<?php

namespace Tests\Feature\Api;

/**
 * Class MeTest.
 *
 * 'api/me/...' related routes tests
 */
class MeTest extends ApiCase
{
    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @group end-user
     * @return void
     */
    public function testRouteIndex()
    {
        $response = $this->get($this->getRouteUrl('me.index'), $this->getAuthorizationHeaders());

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'created_at',
                'updated_at',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'user_group_id'     => $this->user->user_group_id,
                'name'              => $this->user->name,
                'email'             => $this->user->email,
            ],
        ]);
    }

    /**
     * Test route.
     *
     * @group developer
     * @group support
     * @group end-user
     * @return void
     */
    public function testRouteNotificationIndex()
    {
        $response = $this->get($this->getRouteUrl('meNotification.index'), $this->getAuthorizationHeaders());

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
        ]);
    }
}
