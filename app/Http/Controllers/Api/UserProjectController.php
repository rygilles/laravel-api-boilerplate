<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IndexUserProjectRequest;
use App\Http\Transformers\Api\ProjectTransformer;
use App\Models\User;

/**
 * @resource Project
 * @OpenApiOperationTag Resource:User
 *
 * @package App\Http\Controllers\Api
 */
class UserProjectController extends ApiController
{
	/**
	 * UserProjectController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index']]);
	}

	/**
	 * User project list
	 *
	 * You can specify a GET parameter `user_role_id` to filter results.
	 *
	 * @OpenApiResponseSchemaRef #/components/schemas/ProjectListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A Project list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
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

		$paginator = $user->projects($request->input('user_role_id'))->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new ProjectTransformer);
	}
}
