<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

	'login' => 'Login',
	'register' => 'Register',
	'logout' => 'Logout',
	'reset_password' => 'Reset Password',

	'login_form' => [
		'email' => 'E-Mail Address',
		'password' => 'Password',
		'rememberme' => 'Remember Me',
		'submit_btn' => 'Login',
		'forgot_your_password_btn' => 'Forgot Your Password?'
	],

	'register_form' => [
		'name' => 'Nom',
		'email' => 'E-Mail Address',
		'password' => 'Password',
		'password_confirm' => 'Confirm Password',
		'register_btn' => 'Register'
	],

	'reset_password_form' => [
		'email' => 'E-Mail Address',
		'send_password_reset_btn' => 'Send Password Reset Link',
		'password' => 'Password',
		'password_confirmation' => 'Confirm Password',
		'reset_password_btn' => 'Reset Password'
	],

	'reset_password_mail' => [
		'line1' => 'You are receiving this email because we received a password reset request for your account.',
		'reset_password_btn' => 'Reset Password',
		'line2' => 'If you did not request a password reset, no further action is required.'
	]
];
