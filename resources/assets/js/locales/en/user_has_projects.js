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

    'user_role' : {
        'Owner' : 'Owner',
        'Administrator' : 'Administrator',
    },

    'data_manager': {
        'user_user_has_projects' : {
            'main_title' : 'User / Project Relationships',
            'empty_message' : 'This user doesn\'t have any project relationship yet.',
            'columns' : {
                'project_name' : {
                    'title' : 'Project name',
                },
                'user_role_id' : {
                    'title' : 'Role',
                },
                'created_at' : {
                    'title' : 'Added At',
                },
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Create a new relationship',
                    'title_template' : 'Create a new relationship',
                    'fields' : {
                        'user_id' : {
                            'title' : 'User name',
                        },
                        'project_id' : {
                            'title' : 'Project name',
                        },
                        'user_role_id' : {
                            'title' : 'Role',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete relationship',
                    'message_template' : 'Are you sure you want to delete the relation between the user <strong><%- resourceRow.user.data.name %></strong> and the project <strong><%- resourceRow.project.data.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of relationship',
                    'message_template' : 'Are you sure you want to delete this list of relationship ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li>Between the user <strong><%- row.user.data.name %></strong> and the project <strong><%- row.project.data.name %></strong></li><% }); %></ul>',
                },
            },
            'buttons_column' : {
                'see': 'See Projet',
            }
        }
    }
}