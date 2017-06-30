export default {
    'data_stream_decoders': 'Data Stream Decoders',

    'id' : 'Id',
    'name' : 'Name',
    'class_name' : 'Class Name',
    'file_mime_type' : 'File MIME Type',

    'data_stream_presets' : 'Data Stream Presets',
    'data_streams' : 'Data Streams',

    'data_manager' : {
        'data_stream_decoders' : {
            'main_title' : 'Data Stream Decoders',
            'empty_message' : 'Nothing to display here.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Name',
                },
                'class_name' : {
                    'title' : 'Class Name',
                },
                'file_mime_type' : {
                    'title' : 'File MIME Type',
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
                    'show_modal_link' : 'Create New Decoder',
                    'title_template' : 'Create New Decoder',
                    'fields' : {
                        'name' : {
                            'title' : 'Decoder Name',
                        },
                        'class_name' : {
                            'title' : 'Decoder Class Name',
                            'help' : 'Name of the class in App\\DataStreamDecoders namespace.',
                        },
                        'file_mime_type' : {
                            'title' : 'File MIME Type',
                            'help' : 'Of the files that will be decoded.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Edit Decoder "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Decoder Name',
                        },
                        'class_name' : {
                            'title' : 'Decoder Class Name',
                            'help' : 'Name of the class in App\\DataStreamDecoders namespace.',
                        },
                        'file_mime_type' : {
                            'title' : 'File MIME Type',
                            'help' : 'Of the files that will be decoded.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete Decoder',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of Decoders',
                    'message_template' : 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
    }
}