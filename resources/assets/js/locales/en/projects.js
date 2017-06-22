export default {
    'projects': 'Projects',
    'id' : 'Id',
    'project_id': 'Project Id',
    'name' : 'Name',
    'project_name': 'Project Name',
    'see_project_btn' : 'See Project',
    'owner_name' : 'Owner',
    'search_engine_name' : 'Search Engine',

    'data_manager' : {
        'all_projects' : {
            'main_title' : 'All Projects',
            'empty_message' : 'Nothing to display here.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Name',
                },
                'search_engine_id' : {
                    'title' : 'Search Engine',
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
                    'show_modal_link' : 'Create New Project',
                    'title_template' : 'Create New Project',
                    'fields' : {
                        'name' : {
                            'title' : 'Project Name',
                            'help' : '5 chars min.',
                        },
                        'search_engine_id': {
                            'title' : 'Search Engine',
                            'help' : 'Only <a href="https://www.algolia.com/">Algolia</a> is supported at this moment.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Edit Project "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Project Name',
                            'help' : '5 chars min.',
                        },
                        'search_engine_id': {
                            'title' : 'Search Engine',
                            'help' : 'Only <a href="https://www.algolia.com/">Algolia</a> is supported at this moment.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete Project',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of Projects',
                    'message_template' : 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
        'owner_projects' : {
            'main_title' : 'Owned projects',
            'empty_message' : 'You have not created any project.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Name',
                },
                'search_engine_id' : {
                    'title' : 'Search Engine',
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
                    'show_modal_link' : 'Create New Project',
                    'title_template' : 'Create New Project',
                    'fields' : {
                        'name' : {
                            'title' : 'Project Name',
                            'help' : '5 chars min.',
                        },
                        'search_engine_id': {
                            'title' : 'Search Engine',
                            'help' : 'Only <a href="https://www.algolia.com/">Algolia</a> is supported at this moment.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Edit Project "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Project Name',
                            'help' : '5 chars min.',
                        },
                        'search_engine_id': {
                            'title' : 'Search Engine',
                            'help' : 'Only <a href="https://www.algolia.com/">Algolia</a> is supported at this moment.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete Project',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of Projects',
                    'message_template' : 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><strong><%- row.name %></strong><% }); %></ul>',
                }
            }
        },
        'admin_projects' : {
            'main_title' : 'Administered projects',
            'empty_message' : 'Nothing to display here.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Name',
                },
                'search_engine_id' : {
                    'title' : 'Search Engine',
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
                    'show_modal_link' : 'Create New Project',
                    'title_template' : 'Create New Project',
                },
                'edit' : {
                    'title_template' : 'Edit Project "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Project Name',
                            'help' : '5 chars min.',
                        },
                        'search_engine_id': {
                            'title' : 'Search Engine',
                            'help' : 'Only <a href="https://www.algolia.com/">Algolia</a> is supported at this moment.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete Project',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of Projects',
                    'message_template' : 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><strong><%- row.name %></strong><% }); %></ul>',
                }
            }
        }
    }
};
