<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Transformers\Api\UserTransformer;
use App\Models\User;

/**
 * @resource User
 *
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController
{
	/**
	 * User list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = User::paginate();
		return $this->response->paginator($paginator, new UserTransformer);
	}

	/**
	 * Get specified user
	 *
	 * @param $userId int User UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($userId)
	{
		$user = User::find($userId);

		if (!$user)
			return $this->response->errorNotFound();

		return $this->response->item($user, new UserTransformer);
	}

	/**
	 * Create and store new user
	 *
	 * @param StoreUserRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreUserRequest $request)
	{
		$user = User::create($request->all());

		if ($user)
			return $this->response->created(app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('user.show', $user->id), $user);

		return $this->response->errorBadRequest();
	}


	/**
	 * Update a specified user project
	 *
	 * @param UpdateUserRequest $request
	 * @param $userId string User UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateUserRequest $request, $userId)
	{
		$user = User::find($userId);

		if (!$user)
			return $this->response->errorNotFound();

		$user->fill($request->all());
		$user->save();

		return $this->response->item($user, new UserTransformer);
	}

	/**
	 * Check if this user can access to a specified project
	 *
	 * @param string $projectId Project ID
	 * @param string[] $authorizedUserRolesIds An array of user user_role_id that are granted
	 * @param string[] $ignoreUserGroupsIds An array of user user_group_id that are granted
	 */
	public function checkProjectAccess($projectId, $authorizedUserRolesIds = ['Owner', 'Administrator'], $ignoreUserGroupsIds = ['Developer', 'Support'])
	{
		// Ignore access check for those user groups ids
		if (in_array($this->user_group_id, $ignoreUserGroupsIds))
			return;

		// Check user_has_project rights
		$userHasProjects = UserHasProject::where('user_id', $this->id)->where('project_id', $projectId)->get();
		$authorized = false;

		foreach ($userHasProjects as $userHasProject)
		{
			if (in_array($userHasProject->user_role_id, $authorizedUserRolesIds))
			{
				$authorized = true;
				break;
			}
		}

		if (!$authorized)
			$this->response->errorForbidden();
	}
}
