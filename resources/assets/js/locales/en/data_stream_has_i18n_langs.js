export default {
    'data_stream_has_i18n_langs' : 'Data Stream I18n Langs',

    'data_manager': {
        'data_stream_has_i18n_langs' : {
            'main_title' : 'Data Stream I18n Langs',
            'empty_message' : 'No relationship yet.',
            'columns' : {
                'data_stream_id' : {
                    'title' : 'Data Stream name',
                },
                'i18n_lang_id' : {
                    'title' : 'I18n Lang',
                },
                'created_at' : {
                    'title' : 'Added At',
                },
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Add a I18n Lang',
                    'title_template' : 'Add a I18n Lang',
                    'fields' : {
                        'data_stream_id' : {
                            'title' : 'Data Stream name',
                        },
                        'i18n_lang_id' : {
                            'title' : 'I18n Lang',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete relationship',
                    'message_template' : 'Are you sure you want to delete the relation between the data stream <strong><%- resourceRow.dataStream.data.name %></strong> and the i18n lang <strong><%- resourceRow.i18n_lang_id %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of relationship',
                    'message_template' : 'Are you sure you want to delete this list of relationship ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li>Between the data stream <strong><%- row.dataStream.data.name %></strong> and the i18n lang <strong><%- row.project.i18n_lang_id %></strong></li><% }); %></ul>',
                },
            },
        }
    }
}