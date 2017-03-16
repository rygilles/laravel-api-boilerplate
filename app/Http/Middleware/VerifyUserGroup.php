<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Dingo\Api\Http\Response\Factory;

/**
 * Class VerifyUserGroup
 *
 * Check if current user has access the requested route/resource
 *
 * @package App\Http\Middleware
 */
class VerifyUserGroup
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 * @param string[] $authorizedUserGroupsIds Authorized user groups ids
	 * @return mixed
	 */
	public function handle($request, Closure $next, ...$authorizedUserGroupsIds)
	{
		if (!in_array(Auth::user()->user_group_id, $authorizedUserGroupsIds)) {
			if (config('app.debug')) {
				return app(Factory::class)->errorForbidden('Forbidden (You are in "' .
															Auth::user()->user_group_id .
															'" user group, not in ["' .
															implode('", "', $authorizedUserGroupsIds) . '"])');
			} else {
				return app(Factory::class)->errorForbidden();
			}
		}

		return $next($request);
	}
}
