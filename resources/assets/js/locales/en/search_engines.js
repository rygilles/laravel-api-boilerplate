export default {
    'search_engines': 'Search Engines',

    'data_manager' : {
        'search_engines': {
            'main_title': 'Search Engines',
            'empty_message': 'Nothing to display here.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'name': {
                    'title': 'Name',
                },
                'projects_count': {
                    'title': 'Projects'
                },
                'created_at' : {
                    'title' : 'Created At',
                },
                'updated_at' : {
                    'title' : 'Updated At',
                }
            },
            'modals': {
                'create': {
                    'show_modal_link': 'Create a new Search Engine',
                    'title_template': 'Create a new Search Engine',
                    'fields': {
                        'name': {
                            'title': 'Name',
                            'help': 'Specify the version number too.',
                        },
                    },
                },
                'edit': {
                    'title_template': 'Edit "<%- resourceRow.name %>"',
                    'fields': {
                        'name': {
                            'title': 'Name',
                            'help': 'Specify the version number too.',
                        },
                    },
                },
                'delete': {
                    'title_template': 'Delete a Search Engine',
                    'message_template': 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?<br /><br/><strong>Warning : All related projects will be deleted too !!!</strong>',
                },
                'mass_delete': {
                    'title_template': 'Delete a list of Search Engine',
                    'message_template': 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul><br/><strong>Warning : All related projects will be deleted too !!!</strong>',
                }
            }
        },
    }
};
