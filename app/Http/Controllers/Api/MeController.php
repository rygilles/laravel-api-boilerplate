<?php

namespace App\Http\Controllers\Api;

use \App\Http\Transformers\Api\UserTransformer;
use \Dingo\Api\Http\Request;

/**
 * @resource Me
 *
 * @package App\Http\Controllers\Api
 */
class MeController extends ApiController
{
	/**
	 * Get curent user
	 *
	 * @param $request \Dingo\Api\Http\Request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function index(Request $request)
	{
		return $this->response->item($request->user(), new UserTransformer);
	}
}
