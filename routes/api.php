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

	// Me

	$api->get(
		'me',
		'App\Http\Controllers\Api\MeController@index'
	)->name('me.index');

	// User

	$api->get(
		'user',
		'App\Http\Controllers\Api\UserController@index'
	)->name('user.index');

	$api->get(
		'user/{userId}',
		'App\Http\Controllers\Api\UserController@show'
	)->name('user.show');

	$api->post(
		'user',
		'App\Http\Controllers\Api\UserController@store'
	)->name('user.store');

	$api->match(
		['put', 'patch'],
		'user/{userId}',
		'App\Http\Controllers\Api\UserController@update'
	)->name('user.update');

	$api->delete(
		'user/{userId}',
		'App\Http\Controllers\Api\UserController@destroy'
	)->name('user.destroy');

	/*
	$api->resource(
		'user',
		'App\Http\Controllers\Api\UserController',
		[
			'only' => ['index', 'show', 'store'],
			'parameters' => ['user' => 'userId']
		]
	);
	*/

	// User Project

	$api->get(
		'user/{userId}/project',
		'App\Http\Controllers\Api\UserProjectController@index'
	)->name('userProject.index');

	$api->get(
		'user/{userId}/project/{projectId}',
		'App\Http\Controllers\Api\UserProjectController@show'
	)->name('userProject.show');

	// Project

	$api->get(
		'project',
		'App\Http\Controllers\Api\ProjectController@index'
	)->name('project.index');

	$api->get(
		'project/{projectId}',
		'App\Http\Controllers\Api\ProjectController@show'
	)->name('project.show');

	$api->post(
		'project',
		'App\Http\Controllers\Api\ProjectController@store'
	)->name('project.store');

	$api->match(
		['put', 'patch'],
		'project/{projectId}',
		'App\Http\Controllers\Api\ProjectController@update'
	)->name('project.update');

	$api->delete(
		'project/{projectId}',
		'App\Http\Controllers\Api\ProjectController@destroy'
	)->name('project.destroy');

	/*
	$api->resource(
		'project',
		'App\Http\Controllers\Api\ProjectController',
		[
			'only' => ['index', 'store', 'show', 'update'],
			'parameters' => ['project' => 'projectId']
		]
	);
	*/

	// User Has Project

	$api->get(
		'userHasProject',
		'App\Http\Controllers\Api\UserHasProjectController@index'
	)->name('userHasProject.index');

	$api->get(
		'userHasProject/{userId},{projectId}',
		'App\Http\Controllers\Api\UserHasProjectController@show'
	)->name('userHasProject.show');

	$api->post(
		'userHasProject',
		'App\Http\Controllers\Api\UserHasProjectController@store'
	)->name('userHasProject.store');

	$api->match(
		['put', 'patch'],
		'userHasProject/{userId},{projectId}',
		'App\Http\Controllers\Api\UserHasProjectController@update'
	)->name('userHasProject.update');

	$api->delete(
		'userHasProject/{userId},{projectId}',
		'App\Http\Controllers\Api\UserHasProjectController@destroy'
	)->name('userHasProject.destroy');

	// I18n Lang

	$api->get(
		'i18nLang',
		'App\Http\Controllers\Api\I18nLangController@index'
	)->name('i18nLang.index');

	$api->get(
		'i18nLang/{i18nLangId}',
		'App\Http\Controllers\Api\I18nLangController@show'
	)->name('i18nLang.show');

	$api->post(
		'i18nLang',
		'App\Http\Controllers\Api\I18nLangController@store'
	)->name('i18nLang.store');

	$api->match(
		['put', 'patch'],
		'i18nLang/{i18nLangId}',
		'App\Http\Controllers\Api\I18nLangController@update'
	)->name('i18nLang.update');

	$api->delete(
		'i18nLang/{i18nLangId}',
		'App\Http\Controllers\Api\I18nLangController@destroy'
	)->name('i18nLang.destroy');

	// Search Engine

	$api->get(
		'searchEngine',
		'App\Http\Controllers\Api\SearchEngineController@index'
	)->name('searchEngine.index');

	$api->get(
		'searchEngine/{searchEngineId}',
		'App\Http\Controllers\Api\SearchEngineController@show'
	)->name('searchEngine.show');

	$api->post(
		'searchEngine',
		'App\Http\Controllers\Api\SearchEngineController@store'
	)->name('searchEngine.store');

	$api->match(
		['put', 'patch'],
		'searchEngine/{searchEngineId}',
		'App\Http\Controllers\Api\SearchEngineController@update'
	)->name('searchEngine.update');

	$api->delete(
		'searchEngine/{searchEngineId}',
		'App\Http\Controllers\Api\SearchEngineController@destroy'
	)->name('searchEngine.destroy');
	
});
