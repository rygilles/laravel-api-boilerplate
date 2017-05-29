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
    }
}