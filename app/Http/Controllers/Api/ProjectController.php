<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Transformers\Api\ProjectTransformer;
use App\Models\Project;
use App\Models\UserHasProject;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Support\Facades\Validator;

/**
 * @resource Project
 *
 * @package App\Http\Controllers\Api
 */
class ProjectController extends ApiController
{
	/**
	 * ProjectController constructor.
	 */
	public function __construct()
	{
		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support')->only('index');
	}

	/**
	 * Project list
	 *
	 * @return \Dingo\Api\Http\Response
	 * @Get(uri="/project/{?page,limit}")
	 * @Parameters({
	 *      @Parameter("page", description="The page of results to view.", default=1),
	 *      @Parameter("limit", description="The amount of results per page.", default=20)
	 * })
	 */
	public function index()
	{
		$paginator = Project::paginate();

		return $this->response->paginator($paginator, new ProjectTransformer);
	}

	/**
	 * Create and store new project
	 *
	 * @param StoreProjectRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreProjectRequest $request)
	{
		$project = Project::create($request->all());

		if ($project) {
			// Create user has project owner relationship
			$userHasProject = new UserHasProject();
			$userHasProject->user_id = $request->user()->id;
			$userHasProject->project_id = $project->id;
			$userHasProject->user_role_id = 'Owner';
			$userHasProject->save();

			return $this->response->created(app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('project.show', $project->id), $project);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Get specified user project
	 *
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 *
	 * @Get(uri="/project/{projectId}")
	 * @Parameters({
	 *      @Parameter("projectId", type="string", required=true, description="Project UUID"),
	 * })
	 */
	public function show($projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		return $this->response->item($project, new ProjectTransformer);
	}

	/**
	 * Update a specified user project
	 *
	 * @param UpdateProjectRequest $request
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 *
	 * @Put(uri="/project/{projectId}")
	 * @Patch(uri="/project/{projectId}")
	 * @Parameters({
	 *      @Parameter("projectId", type="string", required=true, description="Project UUID"),
	 * })
	 */
	public function update(UpdateProjectRequest $request, $projectId)
	{
		$project = Project::authorized(['Owner'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$project->fill($request->all());
		$project->save();

		return $this->response->item($project, new ProjectTransformer);
	}

	public function delete()
	{
		// @todo
		// delete (cascade ?) user_has_project
	}
}
