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

    'edit_user' : 'Edit User "{name}"',

    'data_manager' : {
        'users' : {
            'main_title': 'Users',
            'empty_message' : 'Nothing to display here.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'user_group_id': {
                    'title': 'Group',
                },
                'name': {
                    'title': 'Name',
                },
                'email': {
                    'title': 'Email address',
                },
                'password': {
                    'title': 'Password',
                },
                'created_at' : {
                    'title' : 'Created At',
                },
                'updated_at' : {
                    'title' : 'Updated At',
                }
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Create New User',
                    'title_template' : 'Create New User',
                    'fields' : {
                        'user_group_id' : {
                            'title': 'Group',
                            'help': 'User Group',
                        },
                        'name' : {
                            'title' : 'User Name',
                            'help' : 'Full name',
                        },
                        'email' : {
                            'title': 'Email address',
                            'help': 'Valid Email address.',
                        },
                        'password': {
                            'title' : 'Password',
                            'help' : 'At least 8 chars.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Edit User "<%- resourceRow.name %>"',
                    'fields' : {
                        'user_group_id' : {
                            'title': 'Group',
                            'help': 'User Group',
                        },
                        'name' : {
                            'title' : 'User Name',
                            'help' : 'Full name',
                        },
                        'email' : {
                            'title': 'Email address',
                            'help': 'Valid Email address.',
                        },
                        'password': {
                            'title' : 'Password',
                            'help' : 'At least 8 chars.<br /> Fill this field to update the password.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete User',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of Users',
                    'message_template' : 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },

        'user_group_users' : {
            'main_title': 'Group Users',
            'empty_message' : 'Nothing to display here.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'user_group_id': {
                    'title': 'Group',
                },
                'name': {
                    'title': 'Name',
                },
                'email': {
                    'title': 'Email address',
                },
                'password': {
                    'title': 'Password',
                },
                'created_at' : {
                    'title' : 'Created At',
                },
                'updated_at' : {
                    'title' : 'Updated At',
                }
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Create New User',
                    'title_template' : 'Create New User',
                    'fields' : {
                        'user_group_id' : {
                            'title': 'Group',
                            'help': 'User Group',
                        },
                        'name' : {
                            'title' : 'User Name',
                            'help' : 'Full name',
                        },
                        'email' : {
                            'title': 'Email address',
                            'help': 'Valid Email address.',
                        },
                        'password': {
                            'title' : 'Password',
                            'help' : 'At least 8 chars.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Edit User "<%- resourceRow.name %>"',
                    'fields' : {
                        'user_group_id' : {
                            'title': 'Group',
                            'help': 'User Group',
                        },
                        'name' : {
                            'title' : 'User Name',
                            'help' : 'Full name',
                        },
                        'email' : {
                            'title': 'Email address',
                            'help': 'Valid Email address.',
                        },
                        'password': {
                            'title' : 'Password',
                            'help' : 'At least 8 chars.<br /> Fill this field to update the password.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete User',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of Users',
                    'message_template' : 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },

        'administrator_users' : {
            'main_title' : 'Project\'s administrators',
            'empty_message' : 'No administered projects.',
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
            },
            'buttons_column' : {
                'see': 'See User',
            }
        }
    }
}