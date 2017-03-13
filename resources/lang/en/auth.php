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
		'subject' => ':appName : Reset Password',
		'line1' => 'You are receiving this email because we received a password reset request for your account.',
		'reset_password_btn' => 'Reset Password',
		'line2' => 'If you did not request a password reset, no further action is required.'
	],

	'oauth_clients' => [
		'title' => 'OAuth Clients',
		'create_new_client' => 'Create New Client',
		'no_client_yey' => 'You have not created any OAuth clients.',
		'client_id' => 'Client ID',
		'client_name' => 'Name',
		'client_secret' => 'Secret',
		'edit_btn' => 'Edit',
		'delete_btn' => 'Delete'
	],

	'oauth_create_client_modal' => [
		'title' => 'Create Client',
		'error' => '<strong>Whoops!</strong> Something went wrong!',
		'name' => 'Name',
		'name_help' => 'Something your users will recognize and trust.',
		'redirect_url' => 'Redirect URL',
		'redirect_url_help' => 'Your application\'s authorization callback URL.',
		'close_btn' => 'Close',
		'create_btn' => 'Create'
	],

	'oauth_edit_client_modal' => [
		'title' => 'Edit Client',
		'error' => '<strong>Whoops!</strong> Something went wrong!',
		'name' => 'Name',
		'name_help' => 'Something your users will recognize and trust.',
		'redirect_url' => 'Redirect URL',
		'redirect_url_help' => 'Your application\'s authorization callback URL.',
		'close_btn' => 'Close',
		'create_btn' => 'Create'
	],

	'authorized_applications' => [
		'title' => 'Authorized Applications',
		'name' => 'Name',
		'scopes' => 'Scopes',
		'revoke' => 'Revoke'
	],

	'personal_access_tokens' => [
		'title' => 'Personnal Access Tokens',
		'create_new_token' => 'Create New Token',
		'no_token_yet' => 'You have not created any personal access tokens.',
		'name' => 'Name',
		'delete' => 'Delete'
	],

	'personal_access_tokens_create_modal' => [
		'title' => 'Create Token',
		'name' => 'Name',
		'scopes' => 'Scopes',
		'close_btn' => 'Close',
		'create_btn' => 'Create'
	],

	'personal_access_tokens_access_modal' => [
		'title' => 'Personal Access Token',
		'description' => 'Here is your new personal access token. This is the only time it will be shown so don\'t lose it! You may now use this token to make API requests.',
		'close_btn' => 'Close'
	],

	/* Authorization Request by Consumer API */

	'authorization_request' => [
		'authorization' => 'Authorization',
		'authorization_request' => 'Authorization Request',
		'client_requesting_permission' => '<strong>:name</strong> is requesting permission to access your account.',
		'this_application_will_be_able_to' => 'This application will be able to:',
		'authorize_btn' => 'Authorize',
		'cancel_btn' => 'Cancel'
	],
];
