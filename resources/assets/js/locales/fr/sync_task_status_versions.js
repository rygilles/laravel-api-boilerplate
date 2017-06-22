export default {
    'sync_task_statuses': 'Versions des status de synchronisation',

    'data_manager' : {
        'sync_task_status_sync_task_status_versions' : {
            'main_title': 'Versions du status de synchronisation ',
            'empty_message': 'Aucun status.',
            'columns': {
                'sync_task_status_id': {
                    'title': 'Id du status',
                },
                'i18n_lang_id' : {
                    'title' : 'Id de la locale',
                },
                'description': {
                    'title': 'Description',
                },
                'created_at' : {
                    'title' : 'Créé le',
                },
                'updated_at' : {
                    'title' : 'Modifié le',
                }
            },
            'modals': {
                'create': {
                    'show_modal_link': 'Créer une nouvelle version',
                    'title_template': 'Créer une nouvelle version',
                    'fields': {
                        'sync_task_status_id': {
                            'title': 'Id du status',
                        },
                        'i18n_lang_id': {
                            'title': 'Id de la locale',
                        },
                        'description': {
                            'title': 'Description',
                        },
                    },
                },
                'edit': {
                    'title_template': 'Modifier la version du status "<%- resourceRow.sync_task_status_id %>" avec "<%- resourceRow.i18n_lang_id %>" en locale',
                    'fields': {
                        'sync_task_status_id': {
                            'title': 'Id du status',
                        },
                        'i18n_lang_id': {
                            'title': 'Id de la locale',
                        },
                        'description': {
                            'title': 'Description',
                        },
                    },
                },
                'delete': {
                    'title_template': 'Supprimer une version',
                    'message_template': 'Êtes-vous sûr de vouloir supprimer la version du status <strong><%- resourceRow.sync_task_status_id %></strong> avec <strong><%- resourceRow.i18n_lang_id %></strong> en locale ?',
                },
                'mass_delete': {
                    'title_template': 'Supprimer une liste de versions',
                    'message_template': 'Êtes-vous sûr de vouloir supprimer ces versions ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li>version du status <strong><%- row.sync_task_status_id %></strong> avec <strong><%- row.i18n_lang_id %></strong> en locale</li><% }); %>',
                }
            }
        }
    }
}