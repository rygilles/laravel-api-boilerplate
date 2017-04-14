<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IndexMeProjectRequest;
use App\Http\Transformers\Api\ProjectTransformer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/**
 * @resource Project
 *
 * @package App\Http\Controllers\Api
 */
class MeProjectController extends ApiController
{
	/**
	 * Current user project list
	 *
	 * You can specify a GET parameter `user_role_id` to filter results.
	 *
	 * @param IndexMeProjectRequest $request
	 * @return \Dingo\Api\Http\Response
	 */
	public function index(IndexMeProjectRequest $request)
	{
		$user = User::where('id', Auth::user()->id)->first();

		if (!$user)
			return $this->response->errorNotFound();

		$paginator = $user->projects($request->input('user_role_id'))->paginate();

		return $this->response->paginator($paginator, new ProjectTransformer);
	}
}
