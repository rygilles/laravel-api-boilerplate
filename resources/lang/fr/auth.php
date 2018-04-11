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
	
	'email_validation' => [
		'page' => [
			'title' => 'Confirmation de votre adresse email',
			'message' => 'Afin de vérifier votre compte utilisateur, vous devez confirmer votre adresse email en suivant les instructions dans le mail de confirmation que vous devriez avoir reçu.',
			'failed_message' => 'Ce ticket de validation n\'est pas ou plus valide.',
			'new_token_message' => 'Cliquez sur le bouton suivant pour recevoir un nouveau mail de validation :',
			'new_token_maybe_message' => 'Si besoin, vous pouvez demander à recevoir un nouveau mail de validation en cliquant sur le bouton suivant :',
			'new_token_btn' => 'Renvoyer',
			'new_token_sent_message' => 'Un nouveau mail de validation vient de vous être envoyé.'
		],
		'mail' => [
			'subject' => ':appName: : Confirmation de votre adresse email',
			'title' => 'Bienvenue,',
			'line1' => 'Merci de bien vouloir confirmer votre email pour accéder à notre service en ligne.',
			'button' => 'Confirmer',
			'line2' => 'Si vous n\'avez pas demandé la création d\'un compte sur notre service, merci d\'ignorer ce message.'
		]
	],

	'reset_password_form' => [
		'email' => 'Addresse E-mail',
		'send_password_reset_btn' => 'Envoyer le lien de réinitialisation',
		'password' => 'Mot de passe',
		'password_confirmation' => 'Confirmation du mot de passe',
		'reset_password_btn' => 'Enregistrer le nouveau mot de passe'
	],
	
	'reset_password_mail' => [
		'subject' => ':appName : Réinitialisation du mot de passe',
		'line1' => 'Vous recevez ce courriel, car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.',
		'reset_password_btn' => 'Réinitialiser le mot de passe',
		'line2' => 'Si vous n\'avez pas demandé de réinitialisation du mot de passe, aucune autre action n\'est requise.'
	],

	'oauth_clients' => [
		'title' => 'Clients OAuth',
		'create_new_client' => 'Créer un nouveau client',
		'no_client_yet' => 'Vous n\'avez créé aucun client OAuth.',
		'client_id' => 'ID Client',
		'client_name' => 'Nom',
		'client_secret' => 'Secret',
		'edit_btn' => 'Modifier',
		'delete_btn' => 'Supprimer'
	],
	
	'oauth_create_client_modal' => [
		'title' => 'Créer un client',
		'error' => '<strong>Oops!</strong> Une erreur est survenue!',
		'name' => 'Nom',
		'name_help' => 'Quelque chose de confiance que vos utilisateurs reconnaîtrons.',
		'redirect_url' => 'URL de redirection',
		'redirect_url_help' => 'L\'URL de rappel de l\'autorisation de votre application.',
		'close_btn' => 'Fermer',
		'create_btn' => 'Créer'
	],
	
	'oauth_edit_client_modal' => [
		'title' => 'Edit Client',
		'error' => '<strong>Oops!</strong> Une erreur est survenue!',
		'name' => 'Nom',
		'name_help' => 'Quelque chose de confiance que vos utilisateurs reconnaîtrons.',
		'redirect_url' => 'URL de redirection',
		'redirect_url_help' => 'L\'URL de rappel de l\'autorisation de votre application.',
		'close_btn' => 'Fermer',
		'save_btn' => 'Enregistrer les modifications'
	],
	
	'authorized_applications' => [
		'title' => 'Applications autorisées',
		'name' => 'Nom',
		'scopes' => 'Scopes',
		'revoke' => 'Révoquer'
	],
	
	'personal_access_tokens' => [
		'title' => 'Jetons d\'authentification personnel',
		'create_new_token' => 'Créer un nouveau jeton',
		'no_token_yet' => 'Vous n\'avez pas créé de jetons d\'authentification personnel.',
		'name' => 'Nom',
		'delete' => 'Supprimer'
	],

	'personal_access_tokens_create_modal' => [
		'title' => 'Créer un jeton',
		'name' => 'Nom',
		'scopes' => 'Scopes',
		'close_btn' => 'Fermer',
		'create_btn' => 'Créer'
	],
	
	'personal_access_tokens_access_modal' => [
		'title' => 'Jeton d\'authentification personnel',
		'description' => 'Voici votre nouveau jeton d\'accès personnel. C\'est la seule fois où il sera montré ainsi ne le perdez pas! Vous pouvez maintenant utiliser ce jeton pour effectuer des requêtes API.',
		'close_btn' => 'Fermer'
	],

	/* Authorization Request by Consumer API */

	'authorization_request' => [
		'authorization' => 'Authorisation',
		'authorization_request' => 'Requête d\'authorisation',
		'client_requesting_permission' => '<strong>:name</strong> demande l\'autorisation d\'accéder à votre compte.',
		'this_application_will_be_able_to' => 'Cette application sera capable de :',
		'authorize_btn' => 'Autoriser',
		'cancel_btn' => 'Annuler'
	],
	
	'register_disabled_message' => 'Les inscriptions à la plateforme sont fermées pour le moment. Réessayez plus tard.'

];
