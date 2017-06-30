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

	// Me Project

	$api->get(
		'me/project',
		'App\Http\Controllers\Api\MeProjectController@index'
	)->name('meProject.index');

	// Me Notification

	$api->get(
		'me/notification',
		'App\Http\Controllers\Api\MeNotificationController@index'
	)->name('meNotification.index');

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
	)->name('userGroup.index');

	// User User Has Project

	$api->get(
		'user/{userId}/userHasProject',
		'App\Http\Controllers\Api\UserUserHasProjectController@index'
	)->name('userUserHasProject.index');

	// Project User Has Project

	$api->get(
		'project/{projectId}/userHasProject',
		'App\Http\Controllers\Api\ProjectUserHasProjectController@index'
	)->name('projectUserHasProject.index');


	// User Project

	$api->get(
		'user/{userId}/project',
		'App\Http\Controllers\Api\UserProjectController@index'
	)->name('userProject.index');

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

	// Sync Item

	$api->get(
		'syncItem',
		'App\Http\Controllers\Api\SyncItemController@index'
	)->name('syncItem.index');

	$api->get(
		'syncItem/{syncItemId},{projectId}',
		'App\Http\Controllers\Api\SyncItemController@show'
	)->name('syncItem.show');

	$api->post(
		'syncItem',
		'App\Http\Controllers\Api\SyncItemController@store'
	)->name('syncItem.store');

	$api->match(
		['put', 'patch'],
		'syncItem/{syncItemId},{projectId}',
		'App\Http\Controllers\Api\SyncItemController@update'
	)->name('syncItem.update');

	$api->delete(
		'syncItem/{syncItemId},{projectId}',
		'App\Http\Controllers\Api\SyncItemController@destroy'
	)->name('syncItem.destroy');

	// Project Sync Item

	$api->get(
		'project/{projectId}/syncItem',
		'App\Http\Controllers\Api\ProjectSyncItemController@index'
	)->name('projectSyncItem.index');

	// Sync Task

	$api->get(
		'syncTask',
		'App\Http\Controllers\Api\SyncTaskController@index'
	)->name('syncTask.index');

	$api->get(
		'syncTask/{syncTaskId}',
		'App\Http\Controllers\Api\SyncTaskController@show'
	)->name('syncTask.show');

	$api->post(
		'syncTask',
		'App\Http\Controllers\Api\SyncTaskController@store'
	)->name('syncTask.store');

	$api->match(
		['put', 'patch'],
		'syncTask/{syncTaskId}',
		'App\Http\Controllers\Api\SyncTaskController@update'
	)->name('syncTask.update');

	$api->delete(
		'syncTask/{syncTaskId}',
		'App\Http\Controllers\Api\SyncTaskController@destroy'
	)->name('syncTask.destroy');

	// Sync Task Sync Task

	$api->get(
		'syncTask/{syncTaskId}/children',
		'App\Http\Controllers\Api\SyncTaskSyncTaskController@index'
	)->name('syncTaskSyncTask.index');

	// Sync Task Sync Task Log

	$api->get(
		'syncTask/{syncTaskId}/syncTaskLog',
		'App\Http\Controllers\Api\SyncTaskSyncTaskLogController@index'
	)->name('syncTaskSyncTaskLog.index');

	// Project Sync Task

	$api->get(
		'project/{projectId}/syncTask',
		'App\Http\Controllers\Api\ProjectSyncTaskController@index'
	)->name('projectSyncTask.index');

	// Sync Task Type

	$api->get(
		'syncTaskType',
		'App\Http\Controllers\Api\SyncTaskTypeController@index'
	)->name('syncTaskType.index');

	$api->get(
		'syncTaskType/{syncTaskTypeId}',
		'App\Http\Controllers\Api\SyncTaskTypeController@show'
	)->name('syncTaskType.show');

	$api->post(
		'syncTaskType',
		'App\Http\Controllers\Api\SyncTaskTypeController@store'
	)->name('syncTaskType.store');

	$api->match(
		['put', 'patch'],
		'syncTaskType/{syncTaskTypeId}',
		'App\Http\Controllers\Api\SyncTaskTypeController@update'
	)->name('syncTaskType.update');

	$api->delete(
		'syncTaskType/{syncTaskTypeId}',
		'App\Http\Controllers\Api\SyncTaskTypeController@destroy'
	)->name('syncTaskType.destroy');

	// Sync Task Type Version

	$api->get(
		'syncTaskTypeVersion',
		'App\Http\Controllers\Api\SyncTaskTypeVersionController@index'
	)->name('syncTaskTypeVersion.index');

	$api->get(
		'syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}',
		'App\Http\Controllers\Api\SyncTaskTypeVersionController@show'
	)->name('syncTaskTypeVersion.show');

	$api->post(
		'syncTaskTypeVersion',
		'App\Http\Controllers\Api\SyncTaskTypeVersionController@store'
	)->name('syncTaskTypeVersion.store');

	$api->match(
		['put', 'patch'],
		'syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}',
		'App\Http\Controllers\Api\SyncTaskTypeVersionController@update'
	)->name('syncTaskTypeVersion.update');

	$api->delete(
		'syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}',
		'App\Http\Controllers\Api\SyncTaskTypeVersionController@destroy'
	)->name('syncTaskTypeVersion.destroy');

	// Sync Task Type Sync Task Type Version

	$api->get(
		'syncTaskType/{syncTaskTypeId}/version',
		'App\Http\Controllers\Api\SyncTaskTypeSyncTaskTypeVersionController@index'
	)->name('syncTaskTypeSyncTaskTypeVersionController.index');

	// Sync Task Status

	$api->get(
		'syncTaskStatus',
		'App\Http\Controllers\Api\SyncTaskStatusController@index'
	)->name('syncTaskStatus.index');

	$api->get(
		'syncTaskStatus/{syncTaskStatusId}',
		'App\Http\Controllers\Api\SyncTaskStatusController@show'
	)->name('syncTaskStatus.show');

	$api->post(
		'syncTaskStatus',
		'App\Http\Controllers\Api\SyncTaskStatusController@store'
	)->name('syncTaskStatus.store');

	$api->match(
		['put', 'patch'],
		'syncTaskStatus/{syncTaskStatusId}',
		'App\Http\Controllers\Api\SyncTaskStatusController@update'
	)->name('syncTaskStatus.update');

	$api->delete(
		'syncTaskStatus/{syncTaskStatusId}',
		'App\Http\Controllers\Api\SyncTaskStatusController@destroy'
	)->name('syncTaskStatus.destroy');

	// Sync Task Status Version

	$api->get(
		'syncTaskStatusVersion',
		'App\Http\Controllers\Api\SyncTaskStatusVersionController@index'
	)->name('syncTaskStatusVersion.index');

	$api->get(
		'syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}',
		'App\Http\Controllers\Api\SyncTaskStatusVersionController@show'
	)->name('syncTaskStatusVersion.show');

	$api->post(
		'syncTaskStatusVersion',
		'App\Http\Controllers\Api\SyncTaskStatusVersionController@store'
	)->name('syncTaskStatusVersion.store');

	$api->match(
		['put', 'patch'],
		'syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}',
		'App\Http\Controllers\Api\SyncTaskStatusVersionController@update'
	)->name('syncTaskStatusVersion.update');

	$api->delete(
		'syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}',
		'App\Http\Controllers\Api\SyncTaskStatusVersionController@destroy'
	)->name('syncTaskStatusVersion.destroy');

	// Sync Task Status Sync Task Status Version

	$api->get(
		'syncTaskStatus/{syncTaskStatusId}/version',
		'App\Http\Controllers\Api\SyncTaskStatusSyncTaskStatusVersionController@index'
	)->name('syncTaskStatusSyncTaskStatusVersion.index');

	// Data Stream

	$api->get(
		'dataStream',
		'App\Http\Controllers\Api\DataStreamController@index'
	)->name('dataStream.index');

	$api->get(
		'dataStream/{dataStreamId}',
		'App\Http\Controllers\Api\DataStreamController@show'
	)->name('dataStream.show');

	$api->post(
		'dataStream',
		'App\Http\Controllers\Api\DataStreamController@store'
	)->name('dataStream.store');

	$api->match(
		['put', 'patch'],
		'dataStream/{dataStreamId}',
		'App\Http\Controllers\Api\DataStreamController@update'
	)->name('dataStream.update');

	$api->delete(
		'dataStream/{dataStreamId}',
		'App\Http\Controllers\Api\DataStreamController@destroy'
	)->name('dataStream.destroy');

	// Data Stream Field

	$api->get(
		'dataStreamField',
		'App\Http\Controllers\Api\DataStreamFieldController@index'
	)->name('dataStreamField.index');

	$api->get(
		'dataStreamField/{dataStreamFieldId}',
		'App\Http\Controllers\Api\DataStreamFieldController@show'
	)->name('dataStreamField.show');

	$api->post(
		'dataStreamField',
		'App\Http\Controllers\Api\DataStreamFieldController@store'
	)->name('dataStreamField.store');

	$api->match(
		['put', 'patch'],
		'dataStreamField/{dataStreamFieldId}',
		'App\Http\Controllers\Api\DataStreamFieldController@update'
	)->name('dataStreamField.update');

	$api->delete(
		'dataStreamField/{dataStreamFieldId}',
		'App\Http\Controllers\Api\DataStreamFieldController@destroy'
	)->name('dataStreamField.destroy');

	// Data Stream Data Stream Field

	$api->get(
		'dataStream/{dataStreamPresetId}/dataStreamField',
		'App\Http\Controllers\Api\DataStreamDataStreamFieldController@index'
	)->name('dataStreamDataStreamField.index');

	// Project Data Stream

	$api->get(
		'project/{projectId}/dataStream',
		'App\Http\Controllers\Api\ProjectDataStreamController@show'
	)->name('projectDataStream.show');

	$api->post(
		'project/{projectId}/dataStream',
		'App\Http\Controllers\Api\ProjectDataStreamController@store'
	)->name('projectDataStream.store');

	$api->match(
		['put', 'patch'],
		'project/{projectId}/dataStream',
		'App\Http\Controllers\Api\ProjectDataStreamController@update'
	)->name('projectDataStream.update');

	$api->delete(
		'project/{projectId}/dataStream',
		'App\Http\Controllers\Api\ProjectDataStreamController@destroy'
	)->name('projectDataStream.destroy');

	// Data Stream Has I18n Lang

	$api->get(
		'dataStreamHasI18nLang',
		'App\Http\Controllers\Api\DataStreamHasI18nLangController@index'
	)->name('dataStreamHasI18nLang.index');

	$api->get(
		'dataStreamHasI18nLang/{dataStreamId},{i18nLangId}',
		'App\Http\Controllers\Api\DataStreamHasI18nLangController@show'
	)->name('dataStreamHasI18nLang.show');

	$api->post(
		'dataStreamHasI18nLang',
		'App\Http\Controllers\Api\DataStreamHasI18nLangController@store'
	)->name('dataStreamHasI18nLang.store');

	$api->match(
		['put', 'patch'],
		'dataStreamHasI18nLang/{dataStreamId},{i18nLangId}',
		'App\Http\Controllers\Api\DataStreamHasI18nLangController@update'
	)->name('dataStreamHasI18nLang.update');

	$api->delete(
		'dataStreamHasI18nLang/{dataStreamId},{i18nLangId}',
		'App\Http\Controllers\Api\DataStreamHasI18nLangController@destroy'
	)->name('dataStreamHasI18nLang.destroy');

	// Data Stream Data Stream Has I8n Lang

	$api->get(
		'dataStream/{dataStreamId}/dataStreamHasI18nLang',
		'App\Http\Controllers\Api\DataStreamDataStreamHasI18nLangController@index'
	)->name('dataStreamDataStreamHasI18nLang.index');

	// Data Stream I18n Lang

	$api->get(
		'dataStream/{dataStreamId}/i18nLang',
		'App\Http\Controllers\Api\DataStreamI18nLangController@index'
	)->name('dataStreamI18nLang.index');

	// I18n Lang Data Stream

	$api->get(
		'i18nLang/{i18nLangId}/dataStream',
		'App\Http\Controllers\Api\I18nLangDataStreamController@index'
	)->name('i18nLangDataStream.index');

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

	// Data Stream Decoder

	$api->get(
		'dataStreamDecoder',
		'App\Http\Controllers\Api\DataStreamDecoderController@index'
	)->name('dataStreamDecoder.index');

	$api->get(
		'dataStreamDecoder/{dataStreamDecoderId}',
		'App\Http\Controllers\Api\DataStreamDecoderController@show'
	)->name('dataStreamDecoder.show');

	$api->post(
		'dataStreamDecoder',
		'App\Http\Controllers\Api\DataStreamDecoderController@store'
	)->name('dataStreamDecoder.store');

	$api->match(
		['put', 'patch'],
		'dataStreamDecoder/{dataStreamDecoderId}',
		'App\Http\Controllers\Api\DataStreamDecoderController@update'
	)->name('dataStreamDecoder.update');

	$api->delete(
		'dataStreamDecoder/{dataStreamDecoderId}',
		'App\Http\Controllers\Api\DataStreamDecoderController@destroy'
	)->name('dataStreamDecoder.destroy');

	// Data Stream Preset

	$api->get(
		'dataStreamPreset',
		'App\Http\Controllers\Api\DataStreamPresetController@index'
	)->name('dataStreamPreset.index');

	$api->get(
		'dataStreamPreset/{dataStreamPresetId}',
		'App\Http\Controllers\Api\DataStreamPresetController@show'
	)->name('dataStreamPreset.show');

	$api->post(
		'dataStreamPreset',
		'App\Http\Controllers\Api\DataStreamPresetController@store'
	)->name('dataStreamPreset.store');

	$api->match(
		['put', 'patch'],
		'dataStreamPreset/{dataStreamPresetId}',
		'App\Http\Controllers\Api\DataStreamPresetController@update'
	)->name('dataStreamPreset.update');

	$api->delete(
		'dataStreamPreset/{dataStreamPresetId}',
		'App\Http\Controllers\Api\DataStreamPresetController@destroy'
	)->name('dataStreamPreset.destroy');

	// Data Stream Preset Data Stream Preset Field

	$api->get(
		'dataStreamPreset/{dataStreamPresetId}/dataStreamPresetField',
		'App\Http\Controllers\Api\DataStreamPresetDataStreamPresetFieldController@index'
	)->name('dataStreamPresetDataStreamPresetField.index');

	// Data Stream Preset Field

	$api->get(
		'dataStreamPresetField',
		'App\Http\Controllers\Api\DataStreamPresetFieldController@index'
	)->name('dataStreamPresetField.index');

	$api->get(
		'dataStreamPresetField/{dataStreamPresetFieldId}',
		'App\Http\Controllers\Api\DataStreamPresetFieldController@show'
	)->name('dataStreamPresetField.show');

	$api->post(
		'dataStreamPresetField',
		'App\Http\Controllers\Api\DataStreamPresetFieldController@store'
	)->name('dataStreamPresetField.store');

	$api->match(
		['put', 'patch'],
		'dataStreamPresetField/{dataStreamPresetFieldId}',
		'App\Http\Controllers\Api\DataStreamPresetFieldController@update'
	)->name('dataStreamPresetField.update');

	$api->delete(
		'dataStreamPresetField/{dataStreamPresetFieldId}',
		'App\Http\Controllers\Api\DataStreamPresetFieldController@destroy'
	)->name('dataStreamPresetField.destroy');

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

	$api->get(
		'i18nLang/search/',
		'App\Http\Controllers\Api\I18nLangController@index'
	)->name('i18nLang.index');

	// I18n Lang Sync Task Type Version

	$api->get(
		'i18nLang/{i18nLangId}/syncTaskTypeVersion',
		'App\Http\Controllers\Api\I18nLangSyncTaskTypeVersionController@index'
	)->name('i18nLangSyncTaskTypeVersion.index');

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

	// Search Engine Project

	$api->get(
		'searchEngine/{searchEngineId}/project',
		'App\Http\Controllers\Api\SearchEngineProjectController@index'
	)->name('searchEngineProject.index');
	
});
