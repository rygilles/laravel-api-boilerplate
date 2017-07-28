<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SearchUseCaseTransformer;
use App\Models\Project;

/**
 * @resource SearchUseCase
 *
 * @package App\Http\Controllers\Api
 */
class ProjectSearchUseCaseController extends ApiController
{
	/**
	 * Project search use case list
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
