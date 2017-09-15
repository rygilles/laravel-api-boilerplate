<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\UserTransformer;
use App\Models\UserGroup;
use Dingo\Api\Http\Response;

/**
 * @resource User
 * @OpenApiOperationTag Resource:UserGroup
 *
 * @package App\Http\Controllers\Api
 */
class UserGroupUserController extends ApiController
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
	 * User group user list
	 *
	 * @OpenApiOperationId getUsers
	 * @OpenApiResponseSchemaRef #/components/schemas/UserListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A User list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @param string $userGroupId User Group ID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($userGroupId)
	{
		$userGroup = UserGroup::find($userGroupId);

		if (!$userGroup)
			return $this->response->errorNotFound();

		$paginator = $userGroup->users()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new UserTransformer());
	}
}
