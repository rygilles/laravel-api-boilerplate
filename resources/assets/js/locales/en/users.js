export default {
    'users': 'Users',

    'user_id': 'Id',

    'user_group_id': 'Group',
    'user_group_id_help': 'Users Group',

    'user_name': 'User Name',
    'user_name_help': 'Full name.',

    'user_email': 'Email address',
    'user_email_help': 'Valid Email address.',

    'user_password': 'Password',
    'user_password_help': 'At least 8 chars.<br /> Fill this field to update the password.',

    'create_new_user': 'Create New User',
    'edit_user' : 'Edit User "{name"}',

    'delete_user' : 'Delete User',
    'delete_user_message' : 'Are you sure you want to delete <strong>{name}</strong> ?',

    'mass_delete_user' : 'Delete a list of Users',
    'mass_delete_user_message_template' : 'Are you sure you want to delete this list ?<br /><strong><% _.forEach(rows, function(row) {%><%- row.name %><br /><% }); %></strong>',

    'see_user_btn' : 'See User',
    'edit_btn': 'Edit',
    'delete_btn': 'Delete',

    'named_user' : '<strong>{name}</strong> user',

    'data_manager' : {
        'administrator_users' : {
            'main_title' : 'Project\'s administrators',
            'columns' : {
                'user_name' : {
                    'title' : 'Name',
                },
                'user_email' : {
                    'title' : 'Email address',
                },
                'created_at' : {
                    'title' : 'Added At',
                },
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Add an administor',
                    'title_template' : 'Add an administor',
                    'fields' : {
                        'user_id' : {
                            'title' : 'User name',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete an administrator',
                    'message_template' : 'Are you sure you want to delete the administrator <strong><%- resourceRow.name %></strong> from your project ?',
                },
            }
        }
    }
}