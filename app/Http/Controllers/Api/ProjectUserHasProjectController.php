<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IndexProjectUserHasProjectRequest;
use App\Http\Transformers\Api\UserHasProjectTransformer;
use App\Models\Project;

/**
 * @resource UserHasProject
 * @todo Security ?
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

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index', 'show']]);
	}

	/**
	 * Project relationship between users and projects list
	 *
	 * You can specify a GET parameter `user_role_id` to filter results.
	 *
	 * @param IndexProjectUserHasProjectRequest $request
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index(IndexProjectUserHasProjectRequest $request, $projectId)
	{
		$project = Project::find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$paginator = $project->userHasProjects($request->input('user_role_id'))->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new UserHasProjectTransformer);
	}
}
