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
					'title' => 'emsearch API', // REQUIRED
					/*
					'description' => null,
					'termsOfService' => null,
					'contact' => new \Rygilles\OpenApiGenerator\OpenApi\Contact([
						'name'  => 'API support',
						'url'   => 'http://www.example.com/support',
						'email' => 'support@example.com',
					]),
					'license' => new \Rygilles\OpenApiGenerator\OpenApi\License([
						'name' => 'Apache 2.0', // REQUIRED
						'url' => 'http://www.apache.org/licenses/LICENSE-2.0.html'
					]),
					*/
					'version' => '1.0', // REQUIRED
				]),

				'servers' => [
					new Server([
						'url' => env('APP_URL')
					])
				],

				'components' => new Components([
					'schemas' => [
						'Pagination' => new Schema([
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
						'Project' => new Schema([
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'search_engine_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'data_stream_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'name' => new Schema([
									'type' => 'string'
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
						'ProjectResponse' => new Schema([
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/Project',
								]),
							])
						]),
						'ProjectListResponse' => new Schema([
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/Project',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
							'example' => new Reference([
								'ref' => '#/components/examples/ProjectIndexExampleResponse'
							])
						]),
						'DataStream' => new Schema([
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'data_stream_decoder_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'name' => new Schema([
									'type' => 'string'
								]),
								'feed_url' => new Schema([
									'type' => 'string',
									'format' => 'url'
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
						'DataStreamResponse' => new Schema([
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/DataStream',
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta'
								])
							])
						]),
						'DataStreamList' => new Schema([
							'type' => 'array',
							'items' => new Reference([
								'ref' => '#/components/schemas/DataStream',
							])
						]),
						'DataStreamListResponse' => new Schema([
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/DataStream',
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							])
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