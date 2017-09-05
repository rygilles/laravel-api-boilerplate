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
	})->name('welcome');

	Auth::routes();

	Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');

	Route::get('/widgets/{path}', 'WidgetFilesController@getFile')->where('path', '.*');

	Route::get('/phpinfo', 'PagesController@phpinfo')->name('phpinfo');

});