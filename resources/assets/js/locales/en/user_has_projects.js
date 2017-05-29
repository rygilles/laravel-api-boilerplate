export default {
    'user_has_projects' : 'User / Project Relationships',

    'no_relation_yet' : 'This user doesn\'t have any project relationship yet.',

    'create_new_user_has_project' : 'Create a new relationship',

    'user_name' : 'User name',
    'user_name_help' : '',

    'project_name' : 'Project name',
    'project_name_help' : '',

    'user_role_id' : 'Role',
    'user_role_id_help' : 'Nature of the relationship.',

    'edit_user_has_project' : 'Edit relationship between "{user_name}" and "{project_name}"',

    'delete_user_has_project' : 'Delete relationship',
    'delete_user_has_project_message' : 'Are you sure you want to delete the relation between <strong>{user_name}</strong> and <strong>{project_name}</strong> ?',

    'mass_delete_user_has_project' : 'Delete a list of relationship',
    'mass_delete_user_has_project_message_template' : 'Are you sure you want to delete this list of relationship ?<br /><% _.forEach(rows, function(row) {%>Between <strong><%- row.user.data.name %></strong> and <strong><%- row.project.data.name %></strong><br /><% }); %>',

    'user_role' : {
        'Owner' : 'Owner',
        'Administrator' : 'Administrator',
    }
}