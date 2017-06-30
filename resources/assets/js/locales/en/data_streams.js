export default {
    'data_streams': 'Data Streams',

    'id' : 'Id',
    'project_name': 'Project',
    'data_stream_decoder_name' : 'Decoder',
    'name' : 'Name',
    'feed_url' : 'Feed URL',

    'i18n_langs' : 'I18n Langs',
    'data_stream_fields' : 'Fields',

    'data_manager' : {
        'data_streams': {
            'main_title': 'Data Streams',
            'empty_message': 'Nothing to display here.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'project_name': {
                    'title': 'Project',
                },
                'data_stream_decoder_id': {
                    'title': 'Decoder',
                },
                'name': {
                    'title': 'Name',
                },
                'feed_url': {
                    'title': 'Feed URL',
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
                    'show_modal_link': 'Create New Data Stream',
                    'title_template': 'Create New Data Stream',
                    'fields': {
                        'data_stream_decoder_id': {
                            'title': 'Decoder',
                        },
                        'name': {
                            'title': 'Name',
                        },
                        'feed_url': {
                            'title': 'Feed URL',
                        },
                    },
                },
                'edit': {
                    'title_template': 'Edit Data Stream "<%- resourceRow.name %>"',
                    'fields': {
                        'data_stream_decoder_id': {
                            'title': 'Decoder',
                        },
                        'name': {
                            'title': 'Name',
                        },
                        'feed_url': {
                            'title': 'Feed URL',
                        },
                    },
                },
                'delete': {
                    'title_template': 'Delete Data Stream',
                    'message_template': 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete': {
                    'title_template': 'Delete a list of Data Stream',
                    'message_template': 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
    }
};
