<?php

namespace App\Providers;

use Dingo\Api\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Dingo\Api\Auth\Provider\Authorization;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class PassportAuthServiceProvider extends Authorization
{
    /**
     * Illuminate authentication manager.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The guard driver name.
     *
     * @var string
     */
    protected $guard = 'api';

    /**
     * Create a new basic provider instance.
     *
     * @param \Illuminate\Auth\AuthManager $auth
     */
    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth->guard($this->guard);
    }

    /**
     * Authenticate request with a Illuminate Guard.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Dingo\Api\Routing\Route $route
     *
     * @return mixed
     */
    public function authenticate(Request $request, Route $route)
    {
        $this->validateAuthorizationHeader($request);

        if (! $user = $this->auth->user()) {
            //return $this->response->error('The user credentials were incorrect.', 401);
            throw new UnauthorizedHttpException(
                get_class($this),
                'The user credentials were incorrect.'
            );
        }

        return $user;
    }

    /**
     * Get the providers authorization method.
     *
     * @return string
     */
    public function getAuthorizationMethod()
    {
        return 'bearer';
    }
}
