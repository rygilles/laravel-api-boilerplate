export default {
    'data_stream_presets': 'Data Stream Presets',

    'id' : 'Id',
    'name' : 'Name',

    'data_stream_preset_fields' : 'Fields',
    'widget_presets' : 'Widget Presets',

    'data_manager' : {
        'data_stream_presets' : {
            'main_title' : 'Data Stream Presets',
            'empty_message' : 'Nothing to display here.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Name',
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
                    'show_modal_link' : 'Create New Preset',
                    'title_template' : 'Create New Preset',
                    'fields' : {
                        'name' : {
                            'title' : 'Preset Name',
                            'help' : '5 chars min.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Edit Preset "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Preset Name',
                            'help' : '5 chars min.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete Preset',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of Presets',
                    'message_template' : 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
    }
};
