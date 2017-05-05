<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;

/**
 * Class AcceptLanguage
 *
 * Set application locale using "Accept-Language" header if defined and valid
 *
 * @package App\Http\Middleware
 */
class AcceptLanguage
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
		// get preferred language
		$locale = $request->getPreferredLanguage(config('app.locales'));

		// set the local language
		app()->setLocale($locale);

		$response = $next($request);

		// set Content Languages header in the response
		$response->header('Content-Language', $locale);

		return $response;
	}
}
