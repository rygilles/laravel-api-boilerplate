<?php

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
	$api->get('me', 'App\Http\Controllers\Api\MeController@index');

	$api->resource('user', 'App\Http\Controllers\Api\UserController', ['only' => ['index', 'show', 'store']]);

	$api->get('user/{userId}/project',             'App\Http\Controllers\Api\UserProjectController@index');
	$api->get('user/{userId}/project/{projectId}', 'App\Http\Controllers\Api\UserProjectController@show');

	$api->resource('project', 'App\Http\Controllers\Api\ProjectController', ['only' => ['index', 'store', 'show', 'update']]);
});
