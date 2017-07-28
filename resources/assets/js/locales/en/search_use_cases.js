export default {
    'search_use_cases': 'Search Use Cases',
    'id' : 'Id',

    'data_manager' : {
        'project_search_use_cases' : {
            'main_title' : 'Project\'s Search Use Cases',
            'empty_message' : 'Nothing to display.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Name',
                },
                'created_at' : {
                    'title' : 'Create At',
                },
                'updated_at' : {
                    'title' : 'Updated At',
                }
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Create New Search Use Case',
                    'title_template' : 'Create New Search Use Case',
                    'fields' : {
                        'name' : {
                            'title' : 'Name',
                            'help' : '5 chars min.',
                        },
                        'project_id': {
                            'title' : 'Project',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Edit Search Use Case "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Name',
                            'help' : '5 chars min.',
                        },
                        'project_id': {
                            'title' : 'Project',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete Search Use Case',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
            }
        },
    }
};
