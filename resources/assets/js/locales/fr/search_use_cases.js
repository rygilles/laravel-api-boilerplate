export default {
    'search_use_cases': 'Cas d\'utilisations de recherche',
    'id' : 'Id',

    'data_manager' : {
        'project_search_use_cases' : {
            'main_title' : 'Cas d\'utilisations de recherche du projet',
            'empty_message' : 'Aucun enregistrement à afficher.',
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
                    'show_modal_link' : 'Créer un nouveau cas d\'utilisation',
                    'title_template' : 'Créer un nouveau cas d\'utilisation',
                    'fields' : {
                        'name' : {
                            'title' : 'Nom',
                            'help' : '5 caractères minimum.',
                        },
                        'project_id': {
                            'title' : 'Projet',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Modifier le cas d\'utilisation "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Nom',
                            'help' : '5 caractères minimum.',
                        },
                        'project_id': {
                            'title' : 'Projet',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un cas d\'utilisation',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
            }
        },
    }
};
