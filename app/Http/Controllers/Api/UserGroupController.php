<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\UserGroupTransformer;
use App\Models\UserGroup;

/**
 * @resource UserGroup
 * @OpenApiOperationTag Manager:UserGroup
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
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/UserGroupListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A UserGroup list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
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
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/UserGroupResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A UserGroup
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
