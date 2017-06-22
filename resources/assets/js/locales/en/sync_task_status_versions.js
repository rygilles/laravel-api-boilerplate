export default {
    'sync_task_statuses': 'Sync. Task Status Versions',

    'data_manager' : {
        'sync_task_status_sync_task_status_versions' : {
            'main_title': 'Sync. Task Status Versions',
            'empty_message': 'Nothing to display here.',
            'columns': {
                'sync_task_status_id': {
                    'title': 'Status Id',
                },
                'i18n_lang_id' : {
                    'title' : 'Locale Id',
                },
                'description': {
                    'title': 'Description',
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
                    'show_modal_link': 'Create a new Version',
                    'title_template': 'Create a new Version',
                    'fields': {
                        'sync_task_status_id': {
                            'title': 'Status Id',
                        },
                        'i18n_lang_id' : {
                            'title' : 'Locale Id',
                        },
                        'description': {
                            'title': 'Description',
                        },
                    },
                },
                'edit': {
                    'title_template': 'Edit version of status "<%- resourceRow.sync_task_status_id %>" and locale "<%- resourceRow.i18n_lang_id %>"',
                    'fields': {
                        'sync_task_status_id': {
                            'title': 'Status Id',
                        },
                        'i18n_lang_id' : {
                            'title' : 'Locale Id',
                        },
                        'description': {
                            'title': 'Description',
                        },
                    },
                },
                'delete': {
                    'title_template': 'Delete a Version',
                    'message_template': 'Are you sure you want to delete the version of status <strong><%- resourceRow.sync_task_status_id %></strong> and locale <strong><%- resourceRow.i18n_lang_id %></strong> ?',
                },
                'mass_delete': {
                    'title_template': 'Delete a list of Versions',
                    'message_template': 'Are you sure you want to delete this list ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li>version of status <strong><%- row.sync_task_status_id %></strong> and locale <strong><%- row.i18n_lang_id %></strong> en locale</li><% }); %>',
                }
            }
        }
    }
}