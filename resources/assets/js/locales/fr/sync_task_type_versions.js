export default {
    'sync_task_types': 'Versions des types de synchronisation',

    'data_manager' : {
        'sync_task_type_sync_task_type_versions' : {
            'main_title': 'Versions du type de synchronisation ',
            'empty_message': 'Aucun type.',
            'columns': {
                'sync_task_type_id': {
                    'title': 'Id du type',
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
                        'sync_task_type_id': {
                            'title': 'Id du type',
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
                    'title_template': 'Modifier la version du type "<%- resourceRow.sync_task_type_id %>" avec "<%- resourceRow.i18n_lang_id %>" en locale',
                    'fields': {
                        'sync_task_type_id': {
                            'title': 'Id du type',
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
                    'message_template': 'Êtes-vous sûr de vouloir supprimer la version du type <strong><%- resourceRow.sync_task_type_id %></strong> avec <strong><%- resourceRow.i18n_lang_id %></strong> en locale ?',
                },
                'mass_delete': {
                    'title_template': 'Supprimer une liste de versions',
                    'message_template': 'Êtes-vous sûr de vouloir supprimer ces versions ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li>version du type <strong><%- row.sync_task_type_id %></strong> avec <strong><%- row.i18n_lang_id %></strong> en locale</li><% }); %>',
                }
            }
        }
    }
}