<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\UserGroupTransformer;
use App\Models\UserGroup;

/**
 * @resource UserGroup
 *
 * @package App\Http\Controllers\Api
 */
class UserGroupController extends ApiController
{
	/**
	 * UserGroup constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index', 'show']]);;
	}

	/**
	 * Show User group list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$userGroups = UserGroup::applyRequestQueryString()->withCount('users')->paginate();

		return $this->response->paginator($userGroups, new UserGroupTransformer);
	}

	/**
	 * Get specified User group
	 *
	 * @param string $userGroupId User Group Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($userGroupId)
	{
		$userGroup = UserGroup::withCount('users')->find($userGroupId);

		if (!$userGroup)
			return $this->response->errorNotFound();

		return $this->response->item($userGroup, new UserGroupTransformer);
	}
}
