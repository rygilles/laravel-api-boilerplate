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

				'apiCannotFillOnUserGroups' => ['End-User'],

			]
		],

		'requestQueryStringParameters' => [

			'authorizedOrderByColumns' => 'id,user_group_id,name,email',
			'authorizedSearchColumns' => 'name,email',
			'defaultSearchColumns' => 'name,email',

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

			'authorizedOrderByColumns' => 'id,name,created_at,updated_at',
			'authorizedSearchColumns' => 'id,name',
			'defaultSearchColumns' => 'id,name',
			'authorizedIncludes' => 'searchEngine'

		]

	],

	App\Models\I18nLang::class => [

		'requestQueryStringParameters' => [

			'authorizedOrderByColumns' => 'id,description',
			'authorizedSearchColumns' => 'id,description',
			'defaultSearchColumns' => 'id,description',

		]

	],

	App\Models\SearchEngine::class => [

		'requestQueryStringParameters' => [

			'authorizedOrderByColumns' => 'id,name',
			'authorizedSearchColumns' => 'name',
			'defaultSearchColumns' => 'name',

		]

	],

];