<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\ProjectTransformer;
use App\Models\Project;
use App\Models\User;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @resource User Project
 *
 * @package App\Http\Controllers\Api
 */
class UserProjectController extends ApiController
{
	/**
	 * User project list
	 *
	 * @param $userId string User UUID
	 * @return \Dingo\Api\Http\Response
	 * @Get(uri="/user/{userId}/project{?user_role_id,page,limit}")
	 * @Parameters({
	 *      @Parameter("userId", type="string", required=true, description="User UUID"),
	 *      @Parameter("user_role_id", description="Filter projects user role", default=)
	 *      @Parameter("page", description="The page of results to view.", default=1),
	 *      @Parameter("limit", description="The amount of results per page.", default=20)
	 * })
	 */
	public function index(Request $request, $userId)
	{
		$user = User::find($userId);

		if (!$user)
			return $this->response->errorNotFound();

		// User role id ?

		$request_user_role_id = $request->input('user_role_id');

		if (!is_null($request_user_role_id))
		{
			$validator = Validator::make(['user_role_id' => $request_user_role_id], [
				'user_role_id' => 'exists:user_role,id'
			]);

			if ($validator->fails()) {
				throw new ValidationHttpException($validator->errors());
			}
		}

		$paginator = $user->projects($request_user_role_id)->paginate();

		return $this->response->paginator($paginator, new ProjectTransformer);
	}

	/**
	 * Get specified user project
	 *
	 * @param $userId string User UUID
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 *
	 * @Get(uri="/user/{userId}/project/{projectId}")
	 * @Parameters({
	 *      @Parameter("userId", type="string", required=true, description="User UUID"),
	 *      @Parameter("projectId", type="string", required=true, description="Project UUID"),
	 * })
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
