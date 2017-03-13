<?php

namespace App\Providers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class ExceptionsServiceProvider extends ServiceProvider
{
	/**
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		app('Dingo\Api\Exception\Handler')->register(function(AuthorizationException  $exception) {
			throw new AccessDeniedHttpException($exception->getMessage());
		});

		app('Dingo\Api\Exception\Handler')->register(function(AuthenticationException   $exception) {
			throw new UnauthorizedHttpException(null, $exception->getMessage());
		});
	}
}