export default {
    'users': 'Utilisateurs',

    'user_id': 'Id',

    'user_group_id': 'Groupe',
    'user_group_id_help': 'Groupe d\'utilisateurs',

    'user_name': 'Nom de l\'utilisateur',
    'user_name_help': 'Nom complet.',

    'user_email': 'Adresse E-mail',
    'user_email_help': 'Une adresse E-mail valide.',

    'user_password': 'Mot de passe',
    'user_password_help': 'Au moins 8 caractères.<br /> Remplissez ce champ pour modifier le mot de passe.',

    'edit_user' : 'Modifier l\'utilisateur "{name}"',

    'data_manager' : {
        'users' : {
            'main_title': 'Utilisateurs',
            'empty_message' : 'Aucun utilisateur.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'user_group_id': {
                    'title': 'Groupe',
                },
                'name': {
                    'title': 'Nom',
                },
                'email': {
                    'title': 'Adresse E-mail',
                },
                'password': {
                    'title': 'Mot de passe',
                },
                'created_at' : {
                    'title' : 'Créé le',
                },
                'updated_at' : {
                    'title' : 'Modifié le',
                }
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Créer un nouvel utilisateur',
                    'title_template' : 'Créer un nouvel utilisateur',
                    'fields' : {
                        'user_group_id' : {
                            'title': 'Groupe',
                            'help': 'Groupe d\'utilisateurs',
                        },
                        'name' : {
                            'title' : 'Nom de l\'utilisateur',
                            'help' : 'Nom complet.',
                        },
                        'email' : {
                            'title': 'Adresse E-mail',
                            'help': 'Une adresse E-mail valide.',
                        },
                        'password': {
                            'title' : 'Mot de passe',
                            'help' : 'Au moins 8 caractères.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Modifier l\'utilisateur "<%- resourceRow.name %>"',
                    'fields' : {
                        'user_group_id' : {
                            'title': 'Groupe',
                            'help': 'Groupe d\'utilisateurs',
                        },
                        'name' : {
                            'title' : 'Nom de l\'utilisateur',
                            'help' : 'Nom complet.',
                        },
                        'email' : {
                            'title': 'Adresse E-mail',
                            'help': 'Une adresse E-mail valide.',
                        },
                        'password': {
                            'title' : 'Mot de passe',
                            'help' : 'Au moins 8 caractères.<br /> Remplissez ce champ pour modifier le mot de passe.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un utilisateur',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste d\'utilisateurs',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces utilisateurs ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },

        'user_group_users' : {
            'main_title': 'Utilisateurs du groupe',
            'empty_message' : 'Aucun utilisateur.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'user_group_id': {
                    'title': 'Groupe',
                },
                'name': {
                    'title': 'Nom',
                },
                'email': {
                    'title': 'Adresse E-mail',
                },
                'password': {
                    'title': 'Mot de passe',
                },
                'created_at' : {
                    'title' : 'Créé le',
                },
                'updated_at' : {
                    'title' : 'Modifié le',
                }
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Créer un nouvel utilisateur',
                    'title_template' : 'Créer un nouvel utilisateur',
                    'fields' : {
                        'user_group_id' : {
                            'title': 'Groupe',
                            'help': 'Groupe d\'utilisateurs',
                        },
                        'name' : {
                            'title' : 'Nom de l\'utilisateur',
                            'help' : 'Nom complet.',
                        },
                        'email' : {
                            'title': 'Adresse E-mail',
                            'help': 'Une adresse E-mail valide.',
                        },
                        'password': {
                            'title' : 'Mot de passe',
                            'help' : 'Au moins 8 caractères.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Modifier l\'utilisateur "<%- resourceRow.name %>"',
                    'fields' : {
                        'user_group_id' : {
                            'title': 'Groupe',
                            'help': 'Groupe d\'utilisateurs',
                        },
                        'name' : {
                            'title' : 'Nom de l\'utilisateur',
                            'help' : 'Nom complet.',
                        },
                        'email' : {
                            'title': 'Adresse E-mail',
                            'help': 'Une adresse E-mail valide.',
                        },
                        'password': {
                            'title' : 'Mot de passe',
                            'help' : 'Au moins 8 caractères.<br /> Remplissez ce champ pour modifier le mot de passe.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un utilisateur',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste d\'utilisateurs',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces utilisateurs ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
        
        'administrator_users' : {
            'main_title' : 'Administrateurs du projet',
            'empty_message' : 'Aucun projet administré.',
            'columns' : {
                'user_name' : {
                    'title' : 'Nom',
                },
                'user_email' : {
                    'title' : 'Adresse E-mail',
                },
                'created_at' : {
                    'title' : 'Ajouté le',
                },
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Ajouter un administrateur',
                    'title_template' : 'Ajouter un administrateur',
                    'fields' : {
                        'user_id' : {
                            'title' : 'Nom d\'utilisateur',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un administrateur',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer l\'administrateur <strong><%- resourceRow.user.data.name %></strong> du projet ?',
                },
            },
            'buttons_column' : {
                'see': 'Voir Utilisateur',
            }
        }
    }
}