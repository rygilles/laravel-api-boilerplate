<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Models configuration
	|--------------------------------------------------------------------------
	|
	| Extra configuration information for models.
	|
	| Each model configuration array is defined with :
	|
	| - attributes :                    List of attributes that need extra configuration (not all needed)
	|   - defaultValue :                Attribute default value (used for hidden & not fillable model fields)
	|   - apiCannotReadOnUserGroups :   Remove reading access (hide in transformer)
	|                                   from the Api user if it's not in the supplied user groups (string[])
	|                                   @see App\Http\Transformers\Api\ApiTransformer
	|   - apiCannotFillOnUserGroups :   Remove fill access (remove from fillable fields)
	|                                   from the Api user if it's not in the supplied user groups (string[])
	| - requestQueryStringParameters :  List of query string filtering parameters
	|   - authorizedOrderByColumns :    Comma delimited column names allowed for order by
	|   - authorizedSearchColumns :     Comma delimited column names allowed for searching
	|   - defaultSearchFields :         Comma delimited column names used for basic searching ("search=xxx" query parameter)
	|
	| @see App\Models\ApiModel
	*/

	App\Models\User::class => [

		'attributes' => [

			'user_group_id' => [

				'defaultValue' => 'End-User',
				'apiCannotFillOnUserGroups' => ['Support', 'End-User'],

			]
		],

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,user_group_id,name,email,created_at,updated_at',
			'authorizedSearchColumns' => 'name,email',
			'defaultSearchColumns' => 'name,email',

		]

	],

	App\Models\UserHasProject::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'user_id,project_id,user_role_id,created_at,updated_at',
			'authorizedIncludes' => 'user,project'

		]

	],

	App\Models\UserGroup::class => [

		'requestQueryStringParameters' => [

			'authorizedOrderByColumns' => 'id,users_count',

		]

	],

	App\Models\Project::class => [

		'attributes' => [

			'search_engine_id'  => [

				/* Algolia */
				'defaultValue' => 'ee87e3b2-1388-11e7-93ae-92361f002671',
				'apiCannotReadOnUserGroups' => ['End-User'],
				'apiCannotFillOnUserGroups' => ['End-User'],

			],

			'data_stream_id'  => [

				'apiCannotFillOnUserGroups' => ['End-User'],

			]

		],

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,name,created_at,updated_at',
			'authorizedSearchColumns' => 'id,name',
			'defaultSearchColumns' => 'id,name',
			'authorizedIncludes' => 'searchEngine,dataStream'

		]

	],

	App\Models\I18nLang::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,description',
			'authorizedSearchColumns' => 'id,description',
			'defaultSearchColumns' => 'id,description',

		]

	],

	App\Models\SearchEngine::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,name,created_at,updated_at,projects_count',
			'authorizedSearchColumns' => 'name',
			'defaultSearchColumns' => 'name',

		]

	],

	App\Models\SyncItem::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'item_id,item_signature,created_at,updated_at',
			'authorizedSearchColumns' => 'item_id,item_signature',
			'defaultSearchColumns' => 'item_id,item_signature',

		]

	],

	App\Models\SyncTask::class => [

		'requestQueryStringParameters' => [

			'authorizedOrderByColumns' => 'id,sync_task_id,sync_task_type_id,sync_task_status_id,created_by_user_id,project_id,created_at,updated_at',
			'authorizedIncludes' => 'createdByUser,project',
			'authorizeCreationDateBounding' => true,

		]

	],


	App\Models\SyncTaskStatus::class => [

		'requestQueryStringParameters' => [

			'authorizedOrderByColumns' => 'id,sync_tasks_count,sync_task_logs_count,sync_task_status_versions_count',

		]

	],

	App\Models\SyncTaskStatusVersion::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'sync_task_status_id,i18n_lang_id,description,created_at,updated_at',
			'authorizedSearchColumns' => 'sync_task_status_id,i18n_lang_id,description',
			'defaultSearchColumns' => 'sync_task_status_id,i18n_lang_id,description',

		]

	],

	App\Models\SyncTaskType::class => [

		'requestQueryStringParameters' => [

			'authorizedOrderByColumns' => 'id,sync_tasks_count,sync_task_type_versions_count',

		]

	],

	App\Models\SyncTaskTypeVersion::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'sync_task_type_id,i18n_lang_id,description,created_at,updated_at',
			'authorizedSearchColumns' => 'sync_task_type_id,i18n_lang_id,description',
			'defaultSearchColumns' => 'sync_task_type_id,i18n_lang_id,description',

		]

	],

	App\Models\SyncTaskLog::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,sync_task_status_id,entry,public,created_at,updated_at',
			'authorizedSearchColumns' => 'sync_task_status_id,entry',
			'defaultSearchColumns' => 'sync_task_status_id,entry',

		]

	],

	App\Models\DataStream::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,data_stream_decoder_id,name,feed_url,created_at,updated_at',
			'authorizedIncludes' => 'project,dataStreamDecoder',
			'authorizedSearchColumns' => 'name,feed_url',
			'defaultSearchColumns' => 'name',

		]

	],

	App\Models\DataStreamField::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,data_stream_id,name,path,versioned,searchable,to_retrieve,created_at,updated_at',
			'authorizedIncludes' => 'dataStream',
			'authorizedSearchColumns' => 'name,path',
			'defaultSearchColumns' => 'name,path',

		]

	],

	App\Models\DataStreamHasI18nLang::class => [

		'requestQueryStringParameters' => [

			'authorizedOrderByColumns' => 'data_stream_id,i18n_lang_id,created_at,updated_at',
			'authorizedIncludes' => 'dataStream,i18nLang'

		]

	],

	App\Models\DataStreamPreset::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,data_stream_decoder_id,name,created_at,updated_at',
			'authorizedIncludes' => 'dataStreamDecoder',
			'authorizedSearchColumns' => 'name',
			'defaultSearchColumns' => 'name',

		]

	],

	App\Models\DataStreamPresetField::class => [

		'requestQueryStringParameters' => [

			'authorizeSearch' => true,
			'authorizedOrderByColumns' => 'id,data_stream_preset_id,name,path,versioned,searchable,to_retrieve,created_at,updated_at',
			'authorizedIncludes' => 'dataStreamPreset',
			'authorizedSearchColumns' => 'name,path',
			'defaultSearchColumns' => 'name,path',

		]

	],

];