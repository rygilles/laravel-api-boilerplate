export default {
    'data_stream_presets': 'Presets de flux de données',

    'id' : 'Id',
    'name' : 'Nom',

    'data_stream_preset_fields' : 'Champs',
    'widget_presets' : 'Presets de widget',

    'data_manager' : {
        'data_stream_presets' : {
            'main_title' : 'Presets de flux de données',
            'empty_message' : 'Aucun preset.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Nom',
                },
                'created_at' : {
                    'title' : 'Créé le',
                },
                'updated_at' : {
                    'title' : 'Modifié le',
                }
            },
            'modals' : {
                'create' : {
                    'show_modal_link' : 'Créer un nouveau preset',
                    'title_template' : 'Créer un nouveau preset',
                    'fields' : {
                        'name' : {
                            'title' : 'Nom du preset',
                            'help' : '5 caractères minimum.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Modifier le preset "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Nom du preset',
                            'help' : '5 caractères minimum.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un preset',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de presets',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces presets ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
    }
};
