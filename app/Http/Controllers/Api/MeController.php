<?php

namespace App\Http\Controllers\Api;

use \App\Http\Transformers\Api\UserTransformer;
use \App\Models\User;
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
	 *
	 * @Get(uri="/")
	 * @Request(headers={"Authorization": "Bearer xxx"})
	 * @Response(200, body={
	 *      "data": {
	 *          "id": "c82473b0-c069-11e6-9598-0800200c9a66",
	 *          "email": "email@domain.tld",
	 *          "created_at": "2016-01-01 10:06:45",
	 *          "updated_at": "2016-09-06 11:08:20"
	 *      }
	 * })
	 */
	public function index(Request $request)
	{
		return $this->response->item($request->user(), new UserTransformer);
	}
}
