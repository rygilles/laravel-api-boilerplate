export default {
    'data_stream_has_i18n_langs' : 'I18n Langs de flux de données',

    'data_manager': {
        'data_stream_has_i18n_langs' : {
            'main_title' : 'I18n Langs de flux de données',
            'empty_message' : 'Rien à afficher.',
            'columns' : {
                'data_stream_id' : {
                    'title' : 'Flux de données',
                },
                'i18n_lang_id' : {
                    'title' : 'I18n Lang',
                },
                'created_at' : {
                    'title' : 'Ajouté le',
                },
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Ajouter une langue',
                    'title_template' : 'Ajouter une langue',
                    'fields' : {
                        'data_stream_id' : {
                            'title' : 'Flux de données',
                        },
                        'i18n_lang_id' : {
                            'title' : 'I18n Lang',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer une relation',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer la relation entre le flux de données <strong><%- resourceRow.dataStream.data.name %></strong> et le i18n lang <strong><%- resourceRow.i18n_lang_id %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de relations',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces relations ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li>Entre le flux de données <strong><%- row.dataStream.data.name %></strong> et le i18n lang <strong><%- row.i18n_lang_id %></strong></li><% }); %></ul>',
                },
            },
        }
    }
}