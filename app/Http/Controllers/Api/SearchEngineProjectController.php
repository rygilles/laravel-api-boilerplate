<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\ProjectTransformer;
use App\Models\SearchEngine;

/**
 * @resource Project
 * @OpenApiOperationTag Resource:SearchEngine
 *
 * @package App\Http\Controllers\Api
 */
class SearchEngineProjectController extends ApiController
{
	/**
	 * I18nLangController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support',  ['only' => ['index']]);
	}

	/**
	 * Search engine project list
	 *
	 * @OpenApiOperationId getProjects
	 * @OpenApiResponseSchemaRef #/components/schemas/ProjectListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A Project list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 * 
	 * @param string $searchEngineId Search Engine UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($searchEngineId)
	{
		$searchEngine = SearchEngine::find($searchEngineId);

		if (!$searchEngine)
			return $this->response->errorNotFound();

		$paginator = $searchEngine->projects()->paginate();

		return $this->response->paginator($paginator, new ProjectTransformer);
	}
}
