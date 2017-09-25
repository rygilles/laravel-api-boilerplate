<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Transformers\Api\UserTransformer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Validation\Rule;

/**
 * @resource User
 * @OpenApiOperationTag Manager:User
 *
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController
{
	/**
	 * UserController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		// @fixme Middleware not called ?!?!
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
		//$this->middleware('verifyUserGroup:Developer,Support')->only('index,show,store,update,destroy');
	}

	/**
	 * User list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/UserListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A User list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = User::applyRequestQueryString()->paginate();
		return $this->response->paginator($paginator, new UserTransformer);
	}

	/**
	 * Get specified user
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/UserResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A User
	 *
	 * @param string $userId User UUID
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
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId create
	 * @OpenApiResponseSchemaRef #/components/schemas/UserResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The created User
	 *
	 * @param StoreUserRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreUserRequest $request)
	{
		$user = User::create($request->all(), $request->getRealMethod());

		if ($user) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				User::class,
				UserTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('user.show', $user->id),
				$user);
		}

		return $this->response->errorBadRequest();
	}


	/**
	 * Update a specified user
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:User
	 * @OpenApiResponseSchemaRef #/components/schemas/UserResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The updated User
	 *
	 * @param UpdateUserRequest $request
	 * @param string $userId User UUID
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function update(UpdateUserRequest $request, $userId)
	{
		$user = User::find($userId);

		if (!$user)
			return $this->response->errorNotFound();

		// 'unique:user' in controller method to manage "ignore" parameter.
		$validator = Validator::make($request->all(), [
			'email' => [Rule::unique('user')->ignore($user->id)]
		]);

		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors());
		}

		$user->fill($request->all(), $request->getRealMethod());
		$user->save();

		return $this->response->item($user, new UserTransformer);
	}

	/**
	 * Delete specified user
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:User
	 * @OpenApiResponseDescription Empty response
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 *
	 * @param string $userId User UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($userId)
	{
		$user = User::find($userId);

		if (!$user)
			return $this->response->errorNotFound();

		$user->delete();

		return $this->response->noContent();
	}
}
