<?php

namespace Tests\Feature\Api;

use App\Models\I18nLang;

/**
 * Class I18nLangTest.
 *
 * 'api/i18nLang/...' related routes tests
 */
class I18nLangTest extends ApiCase
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
        $response = $this->get($this->getRouteUrl('i18nLang.index'), $this->getAuthorizationHeaders());

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
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
    public function testRouteShow()
    {
        $i18nLang = I18nLang::create([
            'id'            => 'test',
            'description'   => 'test',
        ]);

        $response = $this->get(
            $this->getRouteUrl('i18nLang.show', ['i18nLangId' => $i18nLang->id]),
            $this->getAuthorizationHeaders()
        );

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id'            => 'test',
                'description'   => 'test',
            ],
        ]);
    }

    /**
     * Test route.
     *
     * @group developer
     * @return void
     */
    public function testRouteStore()
    {
        $response = $this->post(
            $this->getRouteUrl('i18nLang.store'),
            [
                'id'            => 'test',
                'description'   => 'test',
            ],
            $this->getAuthorizationHeaders()
        );

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(201);

        $response->assertJson([
            'data' => [
                'id'            => 'test',
                'description'   => 'test',
            ],
        ]);
    }

    /**
     * Test route.
     *
     * @group developer
     * @return void
     */
    public function testRouteUpdatePut()
    {
        $i18nLang = I18nLang::create([
            'id'            => 'test',
            'description'   => 'test',
        ]);

        $response = $this->put(
            $this->getRouteUrl('i18nLang.update', ['i18nLangId' => $i18nLang->id]),
            [
                'description'   => 'test1',
            ],
            $this->getAuthorizationHeaders()
        );

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id'            => 'test',
                'description'   => 'test1',
            ],
        ]);
    }

    /**
     * Test route.
     *
     * @group developer
     * @return void
     */
    public function testRouteUpdatePatch()
    {
        $i18nLang = I18nLang::create([
            'id'            => 'test',
            'description'   => 'test',
        ]);

        $response = $this->patch(
            $this->getRouteUrl('i18nLang.update', ['i18nLangId' => $i18nLang->id]),
            [
                'description'        => 'test1',
            ],
            $this->getAuthorizationHeaders()
        );

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id'            => 'test',
                'description'   => 'test1',
            ],
        ]);
    }

    /**
     * Test route.
     *
     * @group developer
     * @return void
     */
    public function testRouteDestroy()
    {
        $i18nLang = I18nLang::create([
            'id'            => 'test',
            'description'   => 'test',
        ]);

        $response = $this->delete(
            $this->getRouteUrl('i18nLang.destroy', ['i18nLangId' => $i18nLang->id]),
            [],
            $this->getAuthorizationHeaders()
        );

        $response->assertStatus(204);

        $this->assertNull(I18nLang::find($i18nLang->id));
    }
}
