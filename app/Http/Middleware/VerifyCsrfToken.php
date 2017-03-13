<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //'api/*'
    ];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 *
	 * @throws \Illuminate\Session\TokenMismatchException
	 */
	public function handle($request, Closure $next)
	{
		if (
			$this->isReading($request) ||
			$this->runningUnitTests() ||
			$this->inExceptArray($request) ||
			$this->tokensMatch($request)
		) {
			return $this->addCookieToResponse($request, $next($request));
		}

		throw new TokenMismatchException;
	}
}
