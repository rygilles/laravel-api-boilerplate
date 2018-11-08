<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Mails\UserEmailValidation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RedirectsUsers;

class EmailConfirmController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Confirm Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the user email validation.
    |
    */

    use RedirectsUsers;

    /**
     * Where to redirect users after confirm.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Handle a user email confirmation request.
     *
     * @param string $token User email confirmation token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm($token = null)
    {
        if (! is_null($token)) {
            $user = User::whereConfirmationToken($token)->first();

            if (! $user) {
                return redirect('confirm-failed');
            }

            $user->confirmed_at = Carbon::now();
            $user->confirmation_token = null;
            $user->save();

            return redirect($this->redirectPath());
        }

        if (Auth::user() && ! Auth::user()->isConfirmed()) {
            return view('auth/confirm');
        }

        return redirect($this->redirectPath());
    }

    /**
     * Handle a user email confirmation failed request.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmFailed()
    {
        return view('auth/confirm_failed');
    }

    /**
     * Send a new email confirm token to the current user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendNewToken()
    {
        $this->middleware('auth');

        $user = Auth::user();

        // Make a new token
        $user->confirmation_token = str_random(64);
        $user->save();

        // Ask for email confirm
        Mail::to($user->email)
            ->send(new UserEmailValidation($user));

        return view('auth/confirm_new_token_sent');
    }
}
