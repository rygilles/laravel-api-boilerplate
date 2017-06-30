export default {
    'data_stream_presets': 'Décodeurs de flux de données',

    'id' : 'Id',
    'name' : 'Nom',
    'class_name' : 'Nom de classe',
    'file_mime_type' : 'Type MIME des fichiers',

    'data_stream_presets' : 'Presets des flux de données',
    'data_streams' : 'Flux de données',

    'data_manager' : {
        'data_stream_decoders' : {
            'main_title' : 'Décodeurs de flux de données',
            'empty_message' : 'Aucun décodeur.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Nom',
                },
                'class_name' : {
                    'title' : 'Nom de classe',
                },
                'file_mime_type' : {
                    'title' : 'Type MIME des fichiers',
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
                    'show_modal_link' : 'Créer un nouveau décodeur',
                    'title_template' : 'Créer un nouveau décodeur',
                    'fields' : {
                        'name' : {
                            'title' : 'Nom du décodeur',
                        },
                        'class_name' : {
                            'title' : 'Nom de la classe',
                            'help' : 'Nom de la classe dans le namespace App\\DataStreamDecoders.',
                        },
                        'file_mime_type' : {
                            'title' : 'Type MIME des fichiers',
                            'help' : 'Type des fichiers qui seront décodés.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Modifier décodeur "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Nom du décodeur',
                        },
                        'class_name' : {
                            'title' : 'Nom de la classe',
                            'help' : 'Nom de la classe dans le namespace App\\DataStreamDecoders.',
                        },
                        'file_mime_type' : {
                            'title' : 'Type MIME des fichiers',
                            'help' : 'Type des fichiers qui seront décodés.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un décodeur',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de décodeurs',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces décodeurs ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
    }
}