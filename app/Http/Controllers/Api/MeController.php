<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\UserTransformer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * @resource Me
 * @OpenApiOperationTag Manager:Me
 *
 * @package App\Http\Controllers\Api
 */
class MeController extends ApiController
{
	/**
	 * Get current user
	 *
	 * @OpenApiOperationId getUser
	 * @OpenApiResponseSchemaRef #/components/schemas/UserResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A User
	 *
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function index()
	{
		$user = User::where('id', Auth::user()->id)->first();
		return $this->response->item($user, new UserTransformer);
	}
}
