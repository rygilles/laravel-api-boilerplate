<?php

return [

	/*
	|--------------------------------------------------------------------------
	| API Docs Profiles
	|--------------------------------------------------------------------------
	|
	| Different possible profiles used for documentation generation based on samples.
	|
	| Each profile is defined with :
	|
	| - defaultRoutePrefix :    Used for routing and added at the end of the computed output base (e.g. public/docs/developer/v1)
	| - outputPathBase :        Base of the directory where to generate the documentation (e.g. public/docs/developer)
	| - actAsUserId :           User ID used to fake Api access with generator
	| - bindings :              Bindings used to generate samples responses in documentation
	| - routes :                Routes used to generate documentation
	|
	| @see SamplesSeeder
	| @see App\Console\Commands\GenerateApiDocs
	|
	*/
	'profiles' => [

		'Developer' => [

			'defaultRoutePrefix' => 'v1',
			'outputPathBase' => realpath(base_path('public/docs/Developer')),
			'actAsUserId' => '41abdec2-1389-11e7-93ae-92361f002671',
			'bindings' => [

				// Notification filter
				'read_status' => 'unread',

				// John Smith
				'userId' => '605c7610-1389-11e7-93ae-92361f002671',

				// End-User,
				'userGroupId' => 'End-User',

				// en
				'i18nLangId' => 'en',

				// I18n lang id in query
				'i18n_lang_id' => 'fr',

				// Search page in query
				'page' => 1,

				// Search limit in query
				'limit' => 5,

			],
			'routes' => [

				'me.index',

				'meNotification.index',
				'meNotification.updateRead',
				'meNotification.updateUnread',

				'user.index',
				'user.show',
				'user.store',
				'user.update',
				'user.destroy',

				'userGroup.index',
				'userGroup.show',

				'userGroupUser.index',

				'i18nLang.index',
				'i18nLang.show',
				'i18nLang.store',
				'i18nLang.update',
				'i18nLang.destroy',

			]

		],

		'Support' => [

			'defaultRoutePrefix' => 'v1',
			'outputPathBase' => realpath(base_path('public/docs/Support')),
			'actAsUserId' => '41abdec2-1389-11e7-93ae-92361f002671',
			'bindings' => [

				// Notification filter
				'read_status' => 'unread',

				// John Smith
				'userId' => '605c7610-1389-11e7-93ae-92361f002671',

				// End-User,
				'userGroupId' => 'End-User',

				// en
				'i18nLangId' => 'en',

				// I18n lang id in query
				'i18n_lang_id' => 'fr',

				// Search page in query
				'page' => 1,

				// Limit in query
				'limit' => 5,

			],
			'routes' => [

				'me.index',

				'meNotification.index',
				'meNotification.updateRead',
				'meNotification.updateUnread',

				'user.index',
				'user.show',
				'user.store',
				'user.update',
				'user.destroy',

				'userGroup.index',
				'userGroup.show',

				'userGroupUser.index',

				'i18nLang.index',
				'i18nLang.show',

			]

		],

		'End-User' => [

			'defaultRoutePrefix' => 'v1',
			'outputPathBase' => realpath(base_path('public/docs/End-User')),
			'actAsUserId' => '605c7610-1389-11e7-93ae-92361f002671',
			'bindings' => [

				// Notification filter
				'read_status' => 'unread',

				// Notification
				'notificationId' => '5b0decfd-6f95-4e76-be12-8cc7fef976b0',

				// John Smith
				'userId' => '605c7610-1389-11e7-93ae-92361f002671',

				// en
				'i18nLangId' => 'en',

				// I18n lang id in query
				'i18n_lang_id' => 'fr',

				// Page in query
				'page' => 1,

				// Limit in query
				'limit' => 5,

			],
			'routes' => [

				'me.index',

				'meNotification.index',
				'meNotification.updateRead',
				'meNotification.updateUnread',
				
			]

		],

	]

];
