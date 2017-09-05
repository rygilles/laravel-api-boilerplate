<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Transformers\Api\ProjectTransformer;
use App\Models\Project;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource Project
 * @OpenApiOperationTag Manager:Project
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
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index']]);
	}

	/**
	 * Project list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/ProjectListResponse
	 * @OpenApiResponseDescription A Project list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = Project::applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new ProjectTransformer);
	}

	/**
	 * Get specified project
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/ProjectResponse
	 * @OpenApiResponseDescription A Project
	 *
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		return $this->response->item($project, new ProjectTransformer);
	}

	/**
	 * Create and store new project
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId create
	 * @OpenApiOperationTag Resource:Project
	 * @OpenApiResponseSchemaRef #/components/schemas/ProjectResponse
	 * @OpenApiResponseDescription The created Project
	 *
	 * @param StoreProjectRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreProjectRequest $request)
	{
		$project = Project::create($request->all(), $request->getRealMethod());

		if ($project) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				Project::class,
				ProjectTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('project.show', $project->id),
				$project);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified project
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:Project
	 * @OpenApiResponseSchemaRef #/components/schemas/ProjectResponse
	 * @OpenApiResponseDescription The updated Project
	 *
	 * @param UpdateProjectRequest $request
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateProjectRequest $request, $projectId)
	{
		$project = Project::authorized(['Owner'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$project->fill($request->all(), $request->getRealMethod());
		$project->save();

		return $this->response->item($project, new ProjectTransformer);
	}

	/**
	 * Delete specified project
	 *
	 * All relationships between the project and his users will be automatically deleted too.<br />
	 * The project sync items will be automatically deleted too.<br />
	 * The project data stream will be automatically deleted too, if exists.
	 * <aside class="notice">Only <code>Owner</code> of project is allowed to delete it.</aside>
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:Project
	 *
	 * @ApiDocsNoCall
	 * @OpenApiResponseDescription Empty response
	 *
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($projectId)
	{
		$project = Project::authorized(['Owner'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$project->delete();

		return $this->response->noContent();
	}
}
