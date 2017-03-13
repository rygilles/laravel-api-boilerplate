<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => env('APP_DOMAIN')], function () {

	Route::get('/', function () {
		return view('welcome');
	});

	Auth::routes();

	Route::get('/home', 'PagesController@index')->name('home');

	Route::get('/api-config', 'PagesController@api')->name('api');

	Route::get('/user-projects', 'PagesController@userProjects')->name('user-projects');

	Route::get('/user-project/{project_id}', 'PagesController@userProject')->name('user-project');

	Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');

});