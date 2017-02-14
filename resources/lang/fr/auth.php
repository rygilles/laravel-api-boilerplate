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

	'failed'   => 'Ces identifiants ne correspondent pas à nos enregistrements',
	'throttle' => 'Trop de tentatives de connexion. Veuillez essayer de nouveau dans :seconds secondes.',

	'login' => 'S\'identifier',
	'register' => 'S\'inscrire',
	'logout' => 'Se déconnecter',
	'reset_password' => 'Réinitialiser le mot de passe',

	'login_form' => [
		'email' => 'Addresse E-mail',
		'password' => 'Mot de passe',
		'rememberme' => 'Se souvenir de moi',
		'submit_btn' => 'S\'identifier',
		'forgot_your_password_btn' => 'Mot de passe oublié ?'
	],
	
	'register_form' => [
		'name' => 'Nom',
		'email' => 'Addresse E-mail',
		'password' => 'Mot de passe',
		'password_confirm' => 'Confirmation du mot de passe',
		'register_btn' => 'S\'inscrire'
	],

	'reset_password_form' => [
		'email' => 'Addresse E-mail',
		'send_password_reset_btn' => 'Envoyer le lien de réinitialisation',
		'password' => 'Mot de passe',
		'password_confirmation' => 'Confirmation du mot de passe',
		'reset_password_btn' => 'Enregistrer le nouveau mot de passe'
	],
	
	'reset_password_mail' => [
		'line1' => 'Vous recevez ce courriel, car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.',
		'reset_password_btn' => 'Réinitialiser le mot de passe',
		'line2' => 'Si vous n\'avez pas demandé de réinitialisation du mot de passe, aucune autre action n\'est requise.'
	]
];
