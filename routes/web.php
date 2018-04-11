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
	
	Route::get('/confirm/{token?}', 'Auth\EmailConfirmController@confirm')->name('confirm');
	Route::get('/confirm-failed', 'Auth\EmailConfirmController@confirmFailed')->name('confirm_failed');
	Route::get('/confirm-new-token', 'Auth\EmailConfirmController@sendNewToken')->name('confirm.new_token');

	Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');

	Route::get('/phpinfo', 'PagesController@phpinfo')->name('phpinfo');

});