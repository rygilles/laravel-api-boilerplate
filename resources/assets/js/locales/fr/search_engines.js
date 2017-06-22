export default {
    'search_engines': 'Moteurs de recherche',
    
    'data_manager' : {
        'search_engines': {
            'main_title': 'Moteurs de recherche',
            'empty_message': 'Aucun enregistrement à afficher.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'name': {
                    'title': 'Nom',
                },
                'projects_count': {
                    'title': 'Projets'
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
                    'show_modal_link': 'Créer un nouveau moteur de recherche',
                    'title_template': 'Créer un nouveau moteur de recherche',
                    'fields': {
                        'name': {
                            'title': 'Nom',
                            'help': 'Indiquez également la version si besoin.',
                        },
                    },
                },
                'edit': {
                    'title_template': 'Modifier "<%- resourceRow.name %>"',
                    'fields': {
                        'name': {
                            'title': 'Name',
                            'help': 'Indiquez également la version si besoin.',
                        },
                    },
                },
                'delete': {
                    'title_template': 'Supprimer un moteur de recherche',
                    'message_template': 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?<br /><br /><strong>Attention : Tous les projets associés seront supprimés également !!!</strong>',
                },
                'mass_delete': {
                    'title_template': 'Supprimer une liste de moteurs de recherche',
                    'message_template': 'Êtes-vous sûr de vouloir supprimer ces items ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.name %><br /></strong></li><% }); %></ul><br /><strong>Attention : Tous les projets associés seront supprimés également !!!</strong>',
                }
            }
        },
    }
};
