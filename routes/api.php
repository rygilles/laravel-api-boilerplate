<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => ['cors', 'auth:api']], function (Router $api) {
	$api->get('/me', function (Request $request) {
		return $request->user();
	});

	$api->resource('/user', 'App\Http\Controllers\Api\UserController', ['only' => ['index', 'show', 'store']]);
	$api->resource('/user/{userId}/project', 'App\Http\Controllers\Api\UserProjectController', ['only' => ['index', 'show']]);
});
