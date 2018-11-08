<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class VerifyUserEmailConfirm.
 *
 * Check if current user has confirmed email (confirmation_token should be null)
 */
class VerifyUserEmailConfirm
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
        if (! Auth::user()) {
            return redirect()->route('dashboard');
        }

        if (! Auth::user()->isConfirmed()) {
            return redirect()->route('confirm');
        }

        return $next($request);
    }
}
