export default {
    'i18n_langs': 'I18n Langs',
    
    'data_manager' : {
        'i18n_langs': {
            'main_title': 'I18n Langs',
            'empty_message': 'Nothing to display here.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'description': {
                    'title': 'Description',
                },
            },
            'modals': {
                'create': {
                    'show_modal_link': 'Create New I18n Lang',
                    'title_template': 'Create New I18n Lang',
                    'fields': {
                        'id': {
                            'title': 'Id',
                            'help': 'IETF Language Tag (<a href="https://en.wikipedia.org/wiki/IETF_language_tag#Syntax_of_language_tags">Wikipedia</a>).',
                        },
                        'description': {
                            'title': 'Description',
                            'help': 'Language description',
                        },
                    },
                },
                'edit': {
                    'title_template': 'Edit "<%- resourceRow.id %>"',
                    'fields': {
                        'description': {
                            'title': 'Description',
                            'help': 'Language description',
                        },
                    },
                },
                'delete': {
                    'title_template': 'Delete I18n Lang',
                    'message_template': 'Are you sure you want to delete <strong><%- resourceRow.id %></strong> ?',
                },
                'mass_delete': {
                    'title_template': 'Delete a list of I18n Lang',
                    'message_template': 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.id %></strong></li><% }); %></ul>',
                }
            }
        },
    }
};
