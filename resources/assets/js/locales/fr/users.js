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

    'create_new_user': 'Créer un nouvel utilisateur',
    'edit_user' : 'Modifier l\'utilisateur "{name}"',

    'delete_user' : 'Supprimer un utilisateur',
    'delete_user_message' : 'Êtes-vous sûr de vouloir supprimer <strong>{name}</strong> ?',

    'mass_delete_user' : 'Supprimer une liste d\'utilisateurs',
    'mass_delete_user_message_template' : 'Êtes-vous sûr de vouloir supprimer ces utilisateurs ?<br /><strong><% _.forEach(rows, function(row) {%><%- row.name %><br /><% }); %></strong>',

    'see_user_btn' : 'Voir Utilisateur',
    'edit_btn': 'Modifier',
    'delete_btn': 'Supprimer',

    'named_user' : 'Utilisateur <strong>{name}</strong>',

    'data_manager' : {
        'administrator_users' : {
            'main_title' : 'Administrateurs du projet',
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
            }
        }
    }
}