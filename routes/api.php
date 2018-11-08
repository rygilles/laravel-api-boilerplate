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

$api->version('v1', ['middleware' => ['acceptLanguage', /*'cors',*/ 'auth:api']], function (Router $api) {

    // Me

    $api->get(
        'me',
        'App\Http\Controllers\Api\MeController@index'
    )->name('me.index');

    // Me Notification

    $api->get(
        'me/notification',
        'App\Http\Controllers\Api\MeNotificationController@index'
    )->name('meNotification.index');

    $api->post(
        'me/notification/all/read',
        'App\Http\Controllers\Api\MeNotificationController@updateAllRead'
    )->name('meNotification.updateAllRead');

    $api->post(
        'me/notification/{notificationId}/read',
        'App\Http\Controllers\Api\MeNotificationController@updateRead'
    )->name('meNotification.updateRead');

    $api->post(
        'me/notification/{notificationId}/unread',
        'App\Http\Controllers\Api\MeNotificationController@updateUnread'
    )->name('meNotification.updateUnread');

    // User Group

    $api->get(
        'userGroup',
        'App\Http\Controllers\Api\UserGroupController@index'
    )->name('userGroup.index');

    $api->get(
        'userGroup/{userGroupId}',
        'App\Http\Controllers\Api\UserGroupController@show'
    )->name('userGroup.show');

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

    // User Group User

    $api->get(
        'userGroup/{userGroupId}/user',
        'App\Http\Controllers\Api\UserGroupUserController@index'
    )->name('userGroupUser.index');

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
});
