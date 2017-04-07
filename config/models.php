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
	|
	| @see App\Models\ApiModel
	*/

	App\Models\User::class => [

		'attributes' => [

			'user_group_id' => [

				'defaultValue' => 'End-User',

				'apiCannotFillOnUserGroups' => ['End-User'],

			]
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

		]

	],

];