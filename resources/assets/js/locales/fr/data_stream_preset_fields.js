export default {
    'data_stream_preset_fields': 'Champs du preset de flux de données',

    'data_manager' : {
        'data_stream_preset_fields' : {
            'main_title' : 'Champs du preset de flux de données',
            'empty_message' : 'Aucun champ.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'data_stream_preset_id' : {
                    'title' : 'Preset',
                },
                'name' : {
                    'title' : 'Nom',
                },
                'path' : {
                    'title' : 'Chemin',
                },
                'versioned' : {
                    'title' : '<span class="fa fa-language" title="Versionné"></span>',
                },
                'searchable' : {
                    'title' : '<span class="fa fa-search" title="Cherchable"></span>',
                },
                'to_retrieve' : {
                    'title' : '<span class="fa fa-search-plus" title="A retourner"></span>',
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
                    'show_modal_link' : 'Créer un nouveau champ de preset',
                    'title_template' : 'Créer un nouveau champ de preset',
                    'fields' : {
                        'data_stream_preset_id' : {
                            'title' : 'Preset',
                        },
                        'name' : {
                            'title' : 'Nom du champ',
                            'help' : 'Au moins 1 caractère',
                        },
                        'path' : {
                            'title' : 'Chemin du champ',
                            'help' : 'Au moins 1 caractère',
                        },
                        'versioned' : {
                            'title' : '<span class="fa fa-fw fa-language" title="Versionné"></span> Versionné',
                        },
                        'searchable' : {
                            'title' : '<span class="fa fa-fw fa-search" title="Cherchable"></span> Cherchable',
                        },
                        'to_retrieve' : {
                            'title' : '<span class="fa fa-fw fa-search-plus" title="A retourner"></span> A retourner',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Modifier champ de preset "<%- resourceRow.name %>"',
                    'fields' : {
                        'data_stream_preset_id' : {
                            'title' : 'Preset',
                        },
                        'name' : {
                            'title' : 'Nom du champ',
                            'help' : 'Au moins 1 caractère',
                        },
                        'path' : {
                            'title' : 'Chemin du champ',
                            'help' : 'Au moins 1 caractère',
                        },
                        'versioned' : {
                            'title' : '<span class="fa fa-fw fa-language" title="Versionné"></span> Versionné',
                        },
                        'searchable' : {
                            'title' : '<span class="fa fa-fw fa-search" title="Cherchable"></span> Cherchable',
                        },
                        'to_retrieve' : {
                            'title' : '<span class="fa fa-fw fa-search-plus" title="A retourner"></span> A retourner',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un champ de preset de flux de données',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de champs de flux de données',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces champs ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %></strong></li><% }); %></ul>',
                }
            }
        },
    }
};
