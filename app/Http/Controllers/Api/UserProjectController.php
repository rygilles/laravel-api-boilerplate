<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IndexUserProjectRequest;
use App\Http\Transformers\Api\ProjectTransformer;
use App\Models\Project;
use App\Models\User;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @resource UserProject
 *
 * @package App\Http\Controllers\Api
 */
class UserProjectController extends ApiController
{
	/**
	 * User project list
	 *
	 * You can specify a GET parameter `user_role_id` to filter results.
	 *
	 * @param IndexUserProjectRequest $request
	 * @param string $userId User UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index(IndexUserProjectRequest $request, $userId)
	{
		$user = User::find($userId);

		if (!$user)
			return $this->response->errorNotFound();

		$paginator = $user->projects($request->input('user_role_id'))->paginate();

		return $this->response->paginator($paginator, new ProjectTransformer);
	}

	/**
	 * Get specified user project
	 *
	 * @param $userId string User UUID
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($userId, $projectId)
	{
		$user = User::find($userId);

		if (!$user)
			return $this->response->errorNotFound();

		$project = User::find($userId)->project($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		return $this->response->item($project, new ProjectTransformer);
	}
}
