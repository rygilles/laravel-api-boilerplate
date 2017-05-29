<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserHasProjectRequest;
use App\Http\Requests\UpdateUserHasProjectRequest;
use App\Http\Transformers\Api\UserHasProjectTransformer;
use App\Models\UserHasProject;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Support\Facades\Lang;

/**
 * @resource UserHasProject
 * @todo Security ?
 * @package App\Http\Controllers\Api
 */
class UserHasProjectController extends ApiController
{
	/**
	 * UserHasProject constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support')->only('index,show,store,update,destroy');
	}

	/**
	 * List of relationships between users and projects
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = UserHasProject::paginate();

		return $this->response->paginator($paginator, new UserHasProjectTransformer);
	}

	/**
	 * Get specified relationship between a user and a project
	 *
	 * @param $userId string User UUID
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($userId, $projectId)
	{
		$userHasProject = UserHasProject::where('user_id', $userId)->where('project_id', $projectId)->get();

		if (!$userHasProject)
			return $this->response->errorNotFound();

		return $this->response->item($userHasProject, new UserHasProjectTransformer);
	}

	/**
	 * Create and store new relationship between a user and a project
	 *
	 * <aside class="notice">Only one relationship per user/project is allowed and only one user can be <code>Owner</code>of a project.</aside>
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreUserHasProjectRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreUserHasProjectRequest $request)
	{
		// Check if a relationship between the specified user and project already exists.
		if (UserHasProject::where('user_id', $request->input('user_id'))->where('project_id', $request->input('project_id'))->exists()) {
			return $this->response->errorBadRequest(Lang::get('errors.user_project_relationship_exists'));
		}

		// Check if a 'Owner' relationship is requested and verify if there's no relationship of this kind with the project.
		if ($request->input('user_role_id') == 'Owner') {
			if (UserHasProject::where('project_id', $request->input('project_id'))->where('user_role_id', 'Owner')->exists()) {
				return $this->response->errorBadRequest(Lang::get('errors.user_project_owner_exists'));
			}
		}

		$userHasProject = UserHasProject::create($request->all(), $request->getRealMethod());

		if ($userHasProject) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				UserHasProject::class,
				UserHasProjectTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('userHasProject.show', [$userHasProject->user_id, $userHasProject->project_id]), $userHasProject
			);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified relationship between a user and a project
	 *
	 * <aside class="notice">Only one relationship per user/project is allowed and only one user can be <code>Owner</code>of a project.</aside>
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateUserHasProjectRequest $request
	 * @param $userId string User UUID
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateUserHasProjectRequest $request, $userId, $projectId)
	{
		$userHasProject = UserHasProject::where('user_id', $userId)->where('project_id', $projectId)->first();

		if (!$userHasProject)
			return $this->response->errorNotFound();

		// Check if a relationship between the specified user and project already exists (ignoring the current if not changed).
		if (($userId != $request->input('user_id')) || ($projectId != $request->input('project_id'))) {
			if (UserHasProject::where('user_id', $request->input('user_id'))->where('project_id', $request->input('project_id'))->exists()) {
				return $this->response->errorBadRequest(Lang::get('errors.user_project_relationship_exists'));
			}
		}

		// Check if a 'Owner' relationship is requested and verify if there's no relationship of this kind with the project (ignoring the current if not changed).
		if ((($userId != $request->input('user_id')) || ($projectId != $request->input('project_id'))) ||
			(($userId == $request->input('user_id')) && ($projectId == $request->input('project_id')) && ($userHasProject->user_role_id != $request->input('user_role_id')))) {
			if ($request->input('user_role_id') == 'Owner') {
				if (UserHasProject::where('project_id', $request->input('project_id'))->where('user_role_id', 'Owner')->exists()) {
					return $this->response->errorBadRequest(Lang::get('errors.user_project_owner_exists'));
				}
			}
		}

		//$userHasProject->fill($request->all());
		//$userHasProject->save();
		UserHasProject::where('user_id', $userId)->where('project_id', $projectId)->update([
			'user_id'       => $request->input('user_id'),
			'project_id'    => $request->input('project_id'),
			'user_role_id'  => $request->input('user_role_id')
		]);

		$userHasProject = UserHasProject::where('user_id', $userId)->where('project_id', $projectId)->first();

		return $this->response->item($userHasProject, new UserHasProjectTransformer);
	}

	/**
	 * Delete specified relationship between a user and a project
	 *
	 * @ApiDocsNoCall
	 *
	 * @param $userId string User UUID
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($userId, $projectId)
	{
		if (!UserHasProject::where('user_id', $userId)->where('project_id', $projectId)->exists()) {
			return $this->response->errorNotFound();
		}

		UserHasProject::where('user_id', $userId)->where('project_id', $projectId)->delete();

		return $this->response->noContent();
	}
}
