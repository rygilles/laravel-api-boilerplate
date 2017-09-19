<?php

use Rygilles\OpenApiGenerator\OpenApi\Components;
use Rygilles\OpenApiGenerator\OpenApi\Info;
use Rygilles\OpenApiGenerator\OpenApi\Schema;
use Rygilles\OpenApiGenerator\OpenApi\Server;
use Rygilles\OpenApiGenerator\OpenApi\Reference;
use Rygilles\OpenApiGenerator\OpenApi\SecurityScheme;
use Rygilles\OpenApiGenerator\OpenApi\OAuthFlows;
use Rygilles\OpenApiGenerator\OpenApi\ImplicitOAuthFlow;
use Rygilles\OpenApiGenerator\OpenApi\AuthorizationCodeOAuthFlow;
use Rygilles\OpenApiGenerator\OpenApi\Parameter;


return [

	/*
	|--------------------------------------------------------------------------
	| Open API Schemas Generator : Router
	|--------------------------------------------------------------------------
	|
	| Router used for your Api in Laravel.
	| Can be 'laravel' or 'dingo'
	|
	*/

	'router' => 'dingo',

	/*
	|--------------------------------------------------------------------------
	| Open API Schemas Generator : Routes prefix
	|--------------------------------------------------------------------------
	|
	| Define your Api routes prefix ("v1" commonly)
	|
	*/

	'routes_prefix' => 'v1',

	/*
	|--------------------------------------------------------------------------
	| Open API Schemas Generator : Models namespace
	|--------------------------------------------------------------------------
	|
	| Define your models namespace ("App" commonly)
	|
	*/

	'models_namespace' => 'App\Models',

	/*
	|--------------------------------------------------------------------------
	| Open API Schemas Generator : Model tag
	|--------------------------------------------------------------------------
	|
	| Define your resource/model tag ("resource" for @resource, "model" for @model, etc.)
	| This tag should by in your controller classes docblock and can be overloaded
	| on the methods.
	|
	*/

	'resource_tag' => 'resource',

	/*
	|--------------------------------------------------------------------------
	| Open API Schemas Generator : Auth Provider
	|--------------------------------------------------------------------------
	|
	| User provider to use for the "act as user" feature.
	| Pick the right name from your config/auth.php file (default is "users")
	|
	*/
	'auth_provider' => 'users',

	/*
	|--------------------------------------------------------------------------
	| Open API Schemas Generator : Auth Guard
	|--------------------------------------------------------------------------
	|
	| Auth guard to use for the "act as user" feature.
	| default is "web"
	|
	*/
	'auth_guard' => 'web',

	/*
	|--------------------------------------------------------------------------
	| Open API Schemas Generator : Profiles
	|--------------------------------------------------------------------------
	|
	| Array of profiles.
	| If you need to generate different schemas according to users rights :
	| Copy the default entry and edit the name and values.
	| The command execution will ask you which profile you want to generate
	| if there is more than one profile in this array
	|
	*/

	'profiles' => [

		'default' => [

			/*
			|--------------------------------------------------------------------------
			| Act As User Id
			|--------------------------------------------------------------------------
			|
			| Act as user Id for Api calls
			|
			*/
			'act_as_user_id' => '41abdec2-1389-11e7-93ae-92361f002671',

			/*
			|--------------------------------------------------------------------------
			| Output
			|--------------------------------------------------------------------------
			|
			| The path where the json schema file will be generated.
			|
			*/
			'output' => (base_path('public/docs/Developer/v1/openapi.json')),

			/*
			|--------------------------------------------------------------------------
			| Api Calls Bindings
			|--------------------------------------------------------------------------
			|
			| Array of fixed bindings for routes calls (for example responses)
			| Each entry is an array
			|
			*/
			'api_calls_bindings' => [

				[
					'routes_aliases' => [
						'project.show',
					],

					'bindings' => [
						[
							// John Smith Sample Project 1
							'in' => 'query-route',
							'name' => 'projectId',
							'value' => '1bcc7efc-138c-11e7-93ae-92361f002671'
						]
					]

				]

			],

			/*
			|--------------------------------------------------------------------------
			| Open API Bindings
			|--------------------------------------------------------------------------
			|
			| Define fixed bindings of the Open API document here.
			|
			*/
			'openapi_bindings' => [

				/*
				|--------------------------------------------------------------------------
				| info
				|--------------------------------------------------------------------------
				|
				| Define values related to Info Object here.
				| Fields with null value will be ignored.
				| 'title' and 'version' fields are mandatory.
				| @see https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.0.md#infoObject
				|
				*/

				'info' => new Info([
					'title' => env('API_NAME'), // REQUIRED
					'version' => '1.0', // REQUIRED
				]),

				'servers' => [
					new Server([
						'url' => env('APP_URL')
					])
				],

				'components' => new Components([
					'parameters' => [
						'Include' =>  new Parameter([
							'name' => 'include',
							'in' => 'query',
							'description' => 'Include responses : {include1},{include2,{include3}[...]',
							'required' => false,
							'schema' => new Schema([
								'type' => 'string',
							])
						]),
						'PaginationPage' => new Parameter([
							'name' => 'page',
							'in' => 'query',
							'description' => 'Pagination : Page number',
							'required' => false,
							'schema' => new Schema([
								'type' => 'integer',
								'format' => 'int32',
								'minimum' => 1,
								'example' => 1
							])
						]),
						'PaginationLimit' => new Parameter([
							'name' => 'limit',
							'in' => 'query',
							'description' => 'Pagination : Maximum entries per page',
							'required' => false,
							'schema' => new Schema([
								'type' => 'integer',
								'format' => 'int32',
								'example' => 20
							])
						]),
						'OrderBy' => new Parameter([
							'name' => 'order_by',
							'in' => 'query',
							'description' => 'Order by : {field},[asc|desc]',
							'required' => false,
							'schema' => new Schema([
								'type' => 'string',
							])
						]),
					],
					'schemas' => [
						'ErrorResponse' => new Schema([
							'required' => [
								'message'
							],
							'properties' => [
								'message' => new Schema([
									'type' => 'string',
									'description' => 'Error message'
								]),
								'errors' => new Schema([
									'type' => 'object',
									'additionalProperties' => new Schema([
										'type' => 'array',
										'items' => new Schema([
											'type' => 'string',
											'description' => 'Field error'
										]),
										'description' => 'Field errors'
									]),
									'description' => 'Fields errors map'
								]),
								'status_code' => new Schema([
									'type' => 'integer',
									'description' => "Error status code"
								]),
								'debug' => new Schema([
									'required' => [
										'line',
										'file',
										'class',
										'trace'
									],
									'properties' => [
										'line' => new Schema([
											'type' => 'integer',
											'description' => 'Code file line where error occurred',
										]),
										'file' => new Schema([
											'type' => 'string',
											'description' => 'Error file name'
										]),
										'class' => new Schema([
											'type' => 'string',
											'description' => 'Error class name'
										]),
										'trace' => new Schema([
											'type' => 'array',
											'items' => new Schema([
												'type' => 'string',
												'description' => 'Error trace'
											]),
											'description' => 'Error traces'
										])
									],
									'description' => 'Debug mode extra info'
								])
							]
						]),
						'Pagination' => new Schema([
							'required' => [
								'total',
								'count',
								'per_page',
								'current_page',
								'total_pages',
								'links'
							],
							'properties' => [
								'total' => new Schema([
									'type' => 'integer',
									'format' => 'int32',
									'minimum' => 0,
									'example' => 434
								]),
								'count' => new Schema([
									'type' => 'integer',
									'format' => 'int32',
									'minimum' => 0,
									'example' => 10
								]),
								'per_page' => new Schema([
									'type' => 'integer',
									'format' => 'int32',
									'minimum' => 0,
									'example' => 10
								]),
								'current_page' => new Schema([
									'type' => 'integer',
									'format' => 'int32',
									'minimum' => 0,
									'example' => 1
								]),
								'total_pages' => new Schema([
									'type' => 'integer',
									'format' => 'int32',
									'minimum' => 0,
									'example' => 44
								]),
								'links'=> new Schema([
									'properties' => [
										'next' => new Schema([
											'type' => 'string',
											'format' => 'url',
										]),
										'previous' => new Schema([
											'type' => 'string',
											'format' => 'url',
										]),
									],
								]),
							]
						]),
						'Meta' => new Schema([
							'properties' => [
								'pagination' => new Reference([
									'ref' => '#/components/schemas/Pagination',
								]),
							]
						]),

						'I18nLang' => new Schema([
							'required' => [
								'id',
								'description'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
								]),
								'description' => new Schema([
									'type' => 'string',
								]),
							]
						]),
						'I18nLangResponse' => new Schema([
							'required' => [
								'data',
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/I18nLang',
								]),
							])
						]),
						'I18nLangListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/I18nLang',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'User' => new Schema([
							'required' => [
								'id',
								'user_group_id',
								'name',
								'email',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'user_group_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'name' => new Schema([
									'type' => 'string'
								]),
								'email' => new Schema([
									'type' => 'string',
									'format' => 'email'
								]),
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at'=> new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
							]
						]),
						'UserResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/User',
								]),
							])
						]),
						'UserListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/User',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'UserGroup' => new Schema([
							'required' => [
								'id',
								'users_count'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
								]),
								'users_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
							]
						]),
						'UserGroupResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/UserGroup',
								]),
							])
						]),
						'UserGroupListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/UserGroup',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),
						
					],
					'securitySchemes' => [
						'apiBearer' => new SecurityScheme([
							'type' => 'http',
							'scheme' => 'bearer',
						]),
						'apiOAuth' => new SecurityScheme([
							'type' => 'oauth2',
							'flows' => new OAuthFlows([
								'implicit' => new ImplicitOAuthFlow([
									'authorizationUrl' => '/oauth/authorize',
									'scopes' => [
										'*' => 'Access to anything'
									]
								]),
								'authorizationCode' => new AuthorizationCodeOAuthFlow([
									'authorizationUrl' => '/oauth/authorize',
									'tokenUrl' => '/oauth/token',
									'refreshUrl' => '/oauth/token/refresh',
									'scopes' => [
										'*' => 'Access to anything'
									]
								]),
							])
						])
					]
				]),

				'security' => [
					['apiBearer' => ['*']],
					['apiOAuth' => ['*']]
				],

			],

		]

	]
];