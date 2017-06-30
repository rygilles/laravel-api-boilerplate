export default {
    'data_streams': 'Flux de données',

    'id' : 'Id',
    'project_name': 'Projet',
    'data_stream_decoder_name' : 'Décodeur',
    'name' : 'Nom',
    'feed_url' : 'URL du flux',

    'i18n_langs' : 'I18n Langs',
    'data_stream_fields' : 'Champs',

    'data_manager' : {
        'data_streams': {
            'main_title': 'Flux de données',
            'empty_message': 'Aucun flux de données.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'project_name': {
                    'title': 'Projet',
                },
                'data_stream_decoder_id': {
                    'title': 'Décodeur',
                },
                'name': {
                    'title': 'Nom',
                },
                'feed_url': {
                    'title': 'URL du flux',
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
                    'show_modal_link': 'Créer un noueau flux de données',
                    'title_template': 'Créer un noueau flux de données',
                    'fields': {
                        'data_stream_decoder_id': {
                            'title': 'Décodeur',
                        },
                        'name': {
                            'title': 'Nom',
                        },
                        'feed_url': {
                            'title': 'URL du flux',
                        },
                    },
                },
                'edit': {
                    'title_template': 'Modifier le flux de données "<%- resourceRow.name %>"',
                    'fields': {
                        'data_stream_decoder_id': {
                            'title': 'Décodeur',
                        },
                        'name': {
                            'title': 'Nom',
                        },
                        'feed_url': {
                            'title': 'URL du flux',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un flux de données',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de flux de données',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces flux de données ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
    }
};
