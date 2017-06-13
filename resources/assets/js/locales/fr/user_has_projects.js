export default {
    'user_has_projects' : 'Relations Utilisateur / Projet',

    'no_relation_yet' : 'Cet utilisateur n\'a aucun projet associé.',

    'create_new_user_has_project' : 'Créer une nouvelle relation',

    'user_name' : 'Nom de l\'utilisateur',
    'user_name_help' : '',

    'project_name' : 'Nom du projet',
    'project_name_help' : '',

    'user_role_id' : 'Rôle',
    'user_role_id_help' : 'Nature de la relation.',

    'edit_user_has_project' : 'Modifier la relation entre "{user_name}" et "{project_name}"',

    'delete_user_has_project' : 'Supprimer une relation',
    'delete_user_has_project_message' : 'Êtes-vous sûr de vouloir supprimer la relation entre <strong>{user_name}</strong> et <strong>{project_name}</strong> ?',

    'mass_delete_user_has_project' : 'Supprimer une liste de relations',
    'mass_delete_user_has_project_message_template' : 'Êtes-vous sûr de vouloir supprimer ces relations ?<br /><% _.forEach(rows, function(row) {%>Entre <strong><%- row.user.data.name %></strong> et <strong><%- row.project.data.name %></strong><br /><% }); %>',

    'user_role' : {
        'Owner' : 'Propriétaire',
        'Administrator' : 'Administrateur',
    },

    'data_manager': {
        'user_user_has_projects' : {
            'main_title' : 'Relations Utilisateur / Projet',
            'empty_message' : 'Cet utilisateur n\'a aucun projet associé.',
            'columns' : {
                'project_name' : {
                    'title' : 'Nom du projet',
                },
                'user_role_id' : {
                    'title' : 'Rôle',
                },
                'created_at' : {
                    'title' : 'Ajouté le',
                },
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Créer une nouvelle relation',
                    'title_template' : 'Créer une nouvelle relation',
                    'fields' : {
                        'user_id' : {
                            'title' : 'Nom d\'utilisateur',
                        },
                        'project_id' : {
                            'title' : 'Nom du projet',
                        },
                        'user_role_id' : {
                            'title' : 'Rôle',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer une relation',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer la relation entre l\'utilisateur <strong><%- resourceRow.user.data.name %></strong> et le projet <strong><%- resourceRow.project.data.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de relations',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces relations ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li>Entre l\'utilisateur <strong><%- row.user.data.name %></strong> et le projet <strong><%- row.project.data.name %></strong></li><% }); %></ul>',
                },
            },
            'buttons_column' : {
                'see': 'Voir Projet',
            }
        }
    }
}