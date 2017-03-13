<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\UserTransformer;
use App\Models\User;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * User
 *
 * @package App\Http\Controllers\Api
 *
 * @Resource("User", uri="/user")
 */
class UserController extends ApiController
{
	/**
	 * User list
	 *
	 * @return \Dingo\Api\Http\Response
	 * @Get(uri="/{?page,limit}")
	 * @Parameters({
	 *      @Parameter("page", description="The page of results to view.", default=1),
	 *      @Parameter("limit", description="The amount of results per page.", default=20)
	 * })
	 * @Request(headers={"Authorization": "Bearer xxx"})
	 * @Response(200, body={
	 *      "data": {
	 *          {
	 *              "id": "c82473b0-c069-11e6-9598-0800200c9a66",
	 *              "email": "email@domain.tld",
	 *              "created_at": "2016-01-01 10:06:45",
	 *              "updated_at": "2016-09-06 11:08:20"
	 *          },
	 *          {
	 *              "id": "420307a0-c06a-11e6-9598-0800200c9a66",
	 *              "email": "anotheremail@domain.tld",
	 *              "created_at": "2016-10-03 20:03:17",
	 *              "updated_at": "2016-11-08 05:10:32"
	 *          }
	 *      },
	 *      "meta": {
	 *          "pagination": {
	 *              "total": 18,
	 *			    "count": 2,
	 *			    "per_page": 2,
	 *			    "current_page": 3,
	 *			    "total_pages": 9,
	 *			    "links": {
	 *                  "previous": "https://domain.tld/api/user?page=2&limit=2",
	 *                  "next": "https://domain.tld/api/user?page=4&limit=2"
	 *              }
	 *          }
	 *      }
	 * })
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
	 *
	 * @Get(uri="/{userId}")
	 * @Parameters({
	 *      @Parameter("userId", type="string", required=true, description="User UUID"),
	 * })
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
	 * @param Request $request
	 * @return \Dingo\Api\Http\Response|void
	 *
	 * @Post("/")
	 * @Request({"name": "foo", "email": "email@domain.tld", "password": "bar"}),
	 * @Response(201, body={
	 *      "user": {
	 *      	"name": "foo",
	 *          "email": "email@domain.tld",
	 *          "id": "8cf2c131-a98d-4103-992b-fdca2b9f5f24",
	 *      	"updated_at": "2016-12-12 13:21:50",
	 *          "created_at": "2016-12-12 13:21:50"
	 *		}
	 * })
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), User::getRules());

		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors());
		}

		$user = User::create($request->all());

		if ($user)
			return $this->response->created(app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('user.show', $user->id), $user);

		return $this->response->errorBadRequest();
	}
}
