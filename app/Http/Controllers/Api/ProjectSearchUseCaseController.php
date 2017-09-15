<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SearchUseCaseTransformer;
use App\Models\Project;

/**
 * @resource SearchUseCase
 * @OpenApiOperationTag Resource:Project
 *
 * @package App\Http\Controllers\Api
 */
class ProjectSearchUseCaseController extends ApiController
{
	/**
	 * Project search use case list
	 *
	 * @OpenApiOperationId getSearchUseCases
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCaseListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SearchUseCase list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$paginator = $project->searchUseCases()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new SearchUseCaseTransformer);
	}
}
