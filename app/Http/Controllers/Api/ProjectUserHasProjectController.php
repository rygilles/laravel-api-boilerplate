<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IndexProjectUserHasProjectRequest;
use App\Http\Transformers\Api\UserHasProjectTransformer;
use App\Models\Project;

/**
 * @resource UserHasProject
 * @OpenApiOperationTag Resource:Project
 * 
 * @package App\Http\Controllers\Api
 */
class ProjectUserHasProjectController extends ApiController
{
	/**
	 * ProjectUserHasProject constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Project relationship between users and projects list
	 *
	 * You can specify a GET parameter `user_role_id` to filter results.
	 *
	 * @OpenApiOperationId getProjectHasUsers
	 * @OpenApiResponseSchemaRef #/components/schemas/UserHasProjectListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTask list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @param IndexProjectUserHasProjectRequest $request
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index(IndexProjectUserHasProjectRequest $request, $projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$paginator = $project->userHasProjects($request->input('user_role_id'))->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new UserHasProjectTransformer);
	}
}
