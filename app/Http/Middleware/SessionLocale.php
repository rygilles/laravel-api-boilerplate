<?php

namespace App\Http\Middleware;

use Closure, Session, Auth;

class SessionLocale
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!Session::has('locale'))
		{
			Session::put('locale', $request->getPreferredLanguage(config('app.locales')));
		}

		app()->setLocale(Session::get('locale'));

		return $next($request);
	}
}
