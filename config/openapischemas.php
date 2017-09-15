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
						'Search' => new Parameter([
							'name' => 'search',
							'in' => 'query',
							'description' => 'Search words',
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
						'SearchPagination' => new Schema([
							'required' => [
								'total',
								'count',
								'per_page',
								'current_page',
								'total_pages'
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
							]
						]),
						'SearchMeta' => new Schema([
							'properties' => [
								'pagination' => new Reference([
									'ref' => '#/components/schemas/SearchPagination',
								]),
							]
						]),

						'Project' => new Schema([
							'required' => [
								'id',
								'search_engine_id',
								'data_stream_id',
								'name',
								'created_at',
								'updated_at',
							],
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
								'dataStream' => new Reference([
									'ref' => '#/components/schemas/DataStreamResponse'
								]),
								'searchEngine' => new Reference([
									'ref' => '#/components/schemas/SearchEngineResponse'
								]),
							]
						]),
						'ProjectResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/Project',
								]),
							])
						]),
						'ProjectListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
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

						'SearchEngine' => new Schema([
							'required' => [
								'id',
								'name',
								'class_name',
								'created_at',
								'updated_at',
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'name' => new Schema([
									'type' => 'string'
								]),
								'class_name' => new Schema([
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
								'projects_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								])
							]
						]),
						'SearchEngineResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SearchEngine',
								]),
							])
						]),
						'SearchEngineListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SearchEngine',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							])
						]),

						'DataStream' => new Schema([
							'required' => [
								'id',
								'data_stream_decoder_id',
								'name',
								'feed_url',
								'created_at',
								'updated_at'
							],
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
								'project' => new Reference([
									'ref' => '#/components/schemas/ProjectResponse'
								]),
								'dataStreamDecoder' => new Reference([
									'ref'=> '#/components/schemas/DataStreamDecoderResponse'
								])
							]
						]),
						'DataStreamResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/DataStream',
								]),
							])
						]),
						'DataStreamListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/DataStream',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),


						'DataStreamField' => new Schema([
							'required' => [
								'id',
								'data_stream_id',
								'name',
								'path',
								'versioned',
								'searchable',
								'to_retrieve',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'id' => new Schema([
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
								'path' => new Schema([
									'type' => 'string',
								]),
								'versioned' => new Schema([
									'type' => 'boolean',
								]),
								'searchable' => new Schema([
									'type' => 'boolean',
								]),
								'to_retrieve' => new Schema([
									'type' => 'boolean',
								]),
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at'=> new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'dataStream' => new Reference([
									'ref'=> '#/components/schemas/DataStreamResponse'
								])
							]
						]),
						'DataStreamFieldResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/DataStreamField',
								]),
							])
						]),
						'DataStreamFieldListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/DataStreamField',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'DataStreamHasI18nLang' => new Schema([
							'required' => [
								'data_stream_id',
								'i18n_lang_id',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'data_stream_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'i18n_lang_id' => new Schema([
									'type' => 'string',
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
						'DataStreamHasI18nLangResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/DataStreamHasI18nLang',
								]),
							])
						]),
						'DataStreamHasI18nLangListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/DataStreamHasI18nLang',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'DataStreamDecoder' => new Schema([
							'required' => [
								'id',
								'name',
								'class_name',
								'file_mime_type',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'name' => new Schema([
									'type' => 'string'
								]),
								'class_name' => new Schema([
									'type' => 'string',
								]),
								'file_mime_type' => new Schema([
									'type' => 'string',
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
						'DataStreamDecoderResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/DataStreamDecoder',
								]),
							])
						]),
						'DataStreamDecoderListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/DataStreamDecoder',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
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

						'DataStreamPreset' => new Schema([
							'required' => [
								'id',
								'data_stream_decoder_id',
								'name',
								'created_at',
								'updated_at'
							],
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
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at'=> new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'dataStreamDecoder' => new Reference([
									'ref'=> '#/components/schemas/DataStreamDecoderResponse'
								])
							]
						]),
						'DataStreamPresetResponse' => new Schema([
							'required' => [
								'data',
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/DataStreamPreset',
								]),
							])
						]),
						'DataStreamPresetListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/DataStreamPreset',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'DataStreamPresetField' => new Schema([
							'required' => [
								'id',
								'data_stream_preset_id',
								'name',
								'path',
								'versioned',
								'searchable',
								'to_retrieve',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'data_stream_preset_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'name' => new Schema([
									'type' => 'string'
								]),
								'path' => new Schema([
									'type' => 'string',
								]),
								'versioned' => new Schema([
									'type' => 'boolean',
								]),
								'searchable' => new Schema([
									'type' => 'boolean',
								]),
								'to_retrieve' => new Schema([
									'type' => 'boolean',
								]),
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at'=> new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'dataStreamPreset' => new Reference([
									'ref'=> '#/components/schemas/DataStreamPresetResponse'
								])
							]
						]),
						'DataStreamPresetFieldResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/DataStreamPresetField',
								]),
							])
						]),
						'DataStreamPresetFieldListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/DataStreamPresetField',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SearchUseCasePreset' => new Schema([
							'required' => [
								'id',
								'data_stream_preset_id',
								'name',
								'created_at',
								'updated_at',
								'search_use_case_preset_fields_count'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'data_stream_preset_id' => new Schema([
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
								'search_use_case_preset_fields_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
								'dataStreamPreset' => new Reference([
									'ref'=> '#/components/schemas/DataStreamPresetResponse'
								])
							]
						]),
						'SearchUseCasePresetResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SearchUseCasePreset',
								]),
							])
						]),
						'SearchUseCasePresetListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SearchUseCasePreset',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'WidgetPreset' => new Schema([
							'required' => [
								'id',
								'search_use_case_preset_id',
								'name',
								'created_at',
								'updated_at',
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'search_use_case_preset_id' => new Schema([
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
								'searchUseCasePreset' => new Reference([
									'ref'=> '#/components/schemas/SearchUseCasePresetResponse'
								])
							]
						]),
						'WidgetPresetResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/WidgetPreset',
								]),
							])
						]),
						'WidgetPresetListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/WidgetPreset',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SyncTaskTypeVersion' => new Schema([
							'required' => [
								'sync_task_type_id',
								'i18n_lang_id',
								'description',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'sync_task_type_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'i18n_lang_id' => new Schema([
									'type' => 'string',
								]),
								'description' => new Schema([
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
						'SyncTaskTypeVersionResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SyncTaskTypeVersion',
								]),
							])
						]),
						'SyncTaskTypeVersionListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SyncTaskTypeVersion',
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

						'SearchUseCase' => new Schema([
							'required' => [
								'id',
								'data_stream_preset_id',
								'name',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'project_id' => new Schema([
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
								'updated_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'search_use_case_fields_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
								'project' => new Reference([
									'ref'=> '#/components/schemas/ProjectResponse'
								])
							]
						]),
						'SearchUseCaseResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SearchUseCase',
								]),
							])
						]),
						'SearchUseCaseListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SearchUseCase',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SyncTask' => new Schema([
							'required' => [
								'id',
								'sync_task_type_id',
								'sync_task_status_id',
								'created_by_user_id',
								'project_id',
								'planned_at',
								'created_at',
								'updated_at',
								'sync_task_logs_count',
								'children_sync_tasks_count'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'sync_task_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'sync_task_type_id' => new Schema([
									'type' => 'string',
								]),
								'sync_task_status_id' => new Schema([
									'type' => 'string',
								]),
								'created_by_user_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'project_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'planned_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at'=> new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'sync_task_logs_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
								'children_sync_tasks_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
								'createdByUser' => new Reference([
									'ref'=> '#/components/schemas/UserResponse'
								]),
								'project' => new Reference([
									'ref'=> '#/components/schemas/ProjectResponse'
								])
							]
						]),
						'SyncTaskResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SyncTask',
								]),
							])
						]),
						'SyncTaskListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SyncTask',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'UserHasProject' => new Schema([
							'required' => [
								'user_id',
								'project_id',
								'user_role_id',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'user_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'project_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'user_role_id' => new Schema([
									'type' => 'string'
								]),
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'user' => new Reference([
									'ref'=> '#/components/schemas/UserResponse'
								]),
								'project' => new Reference([
									'ref'=> '#/components/schemas/ProjectResponse'
								])
							]
						]),
						'UserHasProjectResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/UserHasProject',
								]),
							])
						]),
						'UserHasProjectListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/UserHasProject',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SearchUseCaseSearchResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'object',
									'additionalProperties' => true,
									'description' => 'Search response data'
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/SearchMeta',
								])
							])
						]),

						'SearchUseCaseField' => new Schema([
							'required' => [
								'search_use_case_id',
								'data_stream_field_id',
								'name',
								'searchable',
								'to_retrieve',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'search_use_case_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'data_stream_field_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'name' => new Schema([
									'type' => 'string'
								]),
								'searchable' => new Schema([
									'type' => 'boolean',
								]),
								'to_retrieve' => new Schema([
									'type' => 'boolean',
								]),
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'searchUseCase' => new Reference([
									'ref'=> '#/components/schemas/SearchUseCaseResponse'
								]),
								'dataStreamField' => new Reference([
									'ref'=> '#/components/schemas/DataStreamFieldResponse'
								])
							]
						]),
						'SearchUseCaseFieldResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SearchUseCaseField',
								]),
							])
						]),
						'SearchUseCaseFieldListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SearchUseCaseField',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SearchUseCasePresetField' => new Schema([
							'required' => [
								'search_use_case_preset_id',
								'data_stream_preset_field_id',
								'name',
								'searchable',
								'to_retrieve',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'search_use_case_preset_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'data_stream_preset_field_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'name' => new Schema([
									'type' => 'string'
								]),
								'searchable' => new Schema([
									'type' => 'boolean',
								]),
								'to_retrieve' => new Schema([
									'type' => 'boolean',
								]),
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'searchUseCasePreset' => new Reference([
									'ref'=> '#/components/schemas/SearchUseCasePresetResponse'
								]),
								'dataStreamPresetField' => new Reference([
									'ref'=> '#/components/schemas/DataStreamPresetFieldResponse'
								])
							]
						]),
						'SearchUseCasePresetFieldResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SearchUseCasePresetField',
								]),
							])
						]),
						'SearchUseCasePresetFieldListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SearchUseCasePresetField',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'Widget' => new Schema([
							'required' => [
								'id',
								'search_use_case_id',
								'name',
								'created_at',
								'updated_at',
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'search_use_case_id' => new Schema([
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
								'searchUseCase' => new Reference([
									'ref'=> '#/components/schemas/SearchUseCasePresetResponse'
								])
							]
						]),
						'WidgetResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/Widget',
								]),
							])
						]),
						'WidgetListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/Widget',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SyncItem' => new Schema([
							'required' => [
								'item_id',
								'project_id',
								'item_signature',
								'created_at',
								'updated_at',
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
								]),
								'project_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'item_signature' => new Schema([
									'type' => 'string',
									'format' => 'md5'
								]),
								'created_at' => new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'updated_at'=> new Schema([
									'type' => 'string',
									'format' => 'date-time'
								]),
								'searchUseCase' => new Reference([
									'ref'=> '#/components/schemas/SearchUseCasePresetResponse'
								])
							]
						]),
						'SyncItemResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SyncItem',
								]),
							])
						]),
						'SyncItemListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SyncItem',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SyncTaskStatus' => new Schema([
							'required' => [
								'id',
								'sync_tasks_count',
								'sync_task_logs_count',
								'sync_task_status_versions_count'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
								]),
								'sync_tasks_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
								'sync_task_logs_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
								'sync_task_status_versions_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
							]
						]),
						'SyncTaskStatusResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SyncTaskStatus',
								]),
							])
						]),
						'SyncTaskStatusListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SyncTaskStatus',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SyncTaskStatusVersion' => new Schema([
							'required' => [
								'sync_task_status_id',
								'i18n_lang_id',
								'sync_tasks_count',
								'sync_task_logs_count',
								'sync_task_status_versions_count'
							],
							'properties' => [
								'sync_task_status_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'i18n_lang_id' => new Schema([
									'type' => 'string',
								]),
								'description' => new Schema([
									'type' => 'string',
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
						'SyncTaskStatusVersionResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SyncTaskStatusVersion',
								]),
							])
						]),
						'SyncTaskStatusVersionListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SyncTaskStatusVersion',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SyncTaskLog' => new Schema([
							'required' => [
								'id',
								'sync_task_status_id',
								'sync_task_id',
								'entry',
								'public',
								'created_at',
								'updated_at'
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
								]),
								'sync_task_status_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'sync_task_id' => new Schema([
									'type' => 'string',
									'format' => 'uuid'
								]),
								'entry' => new Schema([
									'type' => 'string',
								]),
								'public' => new Schema([
									'type' => 'boolean',
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
						'SyncTaskLogResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SyncTaskLog',
								]),
							])
						]),
						'SyncTaskLogListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SyncTaskLog',
									])
								]),
								'meta' => new Reference([
									'ref' => '#/components/schemas/Meta',
								])
							]),
						]),

						'SyncTaskType' => new Schema([
							'required' => [
								'id',
								'sync_tasks_count',
								'sync_task_type_versions_count',
							],
							'properties' => [
								'id' => new Schema([
									'type' => 'string',
								]),
								'sync_tasks_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
								'sync_task_type_versions_count' => new Schema([
									'type' => 'integer',
									'format' => 'int32'
								]),
							]
						]),
						'SyncTaskTypeResponse' => new Schema([
							'required' => [
								'data'
							],
							'properties' => ([
								'data' => new Reference([
									'ref' => '#/components/schemas/SyncTaskType',
								]),
							])
						]),
						'SyncTaskTypeListResponse' => new Schema([
							'required' => [
								'data',
								'meta'
							],
							'properties' => ([
								'data' => new Schema([
									'type' => 'array',
									'items' => new Reference([
										'ref' => '#/components/schemas/SyncTaskType',
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