export default {
    'data_stream_preset_fields': 'Data Stream Presets Fields',

    'data_manager' : {
        'data_stream_preset_fields' : {
            'main_title' : 'Data Stream Presets Fields',
            'empty_message' : 'Nothing to display here.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'data_stream_preset_id' : {
                    'title' : 'Preset',
                },
                'name' : {
                    'title' : 'Name',
                },
                'path' : {
                    'title' : 'Path',
                },
                'versioned' : {
                    'title' : '<span class="fa fa-fw fa-language" title="Versioned"></span>',
                },
                'searchable' : {
                    'title' : '<span class="fa fa-fw fa-search" title="Searchable"></span>',
                },
                'to_retrieve' : {
                    'title' : '<span class="fa fa-fw fa-search-plus" title="To Retrieve"></span>',
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
                    'show_modal_link' : 'Create New Preset Field',
                    'title_template' : 'Create New Preset Field',
                    'fields' : {
                        'data_stream_preset_id' : {
                            'title' : 'Preset',
                        },
                        'name' : {
                            'title' : 'Field Name',
                            'help' : '1 char min.',
                        },
                        'path' : {
                            'title' : 'Field path',
                            'help' : '1 char min.',
                        },
                        'versioned' : {
                            'title' : '<span class="fa fa-fw fa-language" title="Versioned"></span> Versioned',
                        },
                        'searchable' : {
                            'title' : '<span class="fa fa-fw fa-search" title="Searchable"></span> Searchable',
                        },
                        'to_retrieve' : {
                            'title' : '<span class="fa fa-fw fa-search-plus" title="To Retrieve"></span> To Retrieve',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Edit Preset Field "<%- resourceRow.name %>"',
                    'fields' : {
                        'data_stream_preset_id' : {
                            'title' : 'Preset',
                        },
                        'name' : {
                            'title' : 'Field Name',
                            'help' : '1 char min.',
                        },
                        'path' : {
                            'title' : 'Field path',
                            'help' : '1 char min.',
                        },
                        'versioned' : {
                            'title' : '<span class="fa fa-language" title="Versioned"></span> Versioned',
                        },
                        'searchable' : {
                            'title' : '<span class="fa fa-search" title="Searchable"></span> Searchable',
                        },
                        'to_retrieve' : {
                            'title' : '<span class="fa fa-search-plus" title="To Retrieve"></span> To Retrieve',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Delete Preset Field',
                    'message_template' : 'Are you sure you want to delete <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Delete a list of Preset Fields',
                    'message_template' : 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
    }
};
