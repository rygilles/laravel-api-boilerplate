export default {
    'i18n_langs': 'I18n Langs',

    'data_manager' : {
        'i18n_langs': {
            'main_title': 'I18n Langs',
            'empty_message': 'Aucun enregistrement à afficher.',
            'columns': {
                'id': {
                    'title': 'Id',
                },
                'description': {
                    'title': 'Description',
                },
            },
            'modals': {
                'create': {
                    'show_modal_link': 'Créer une nouvelle I18n Lang',
                    'title_template': 'Créer une nouvelle I18n Lang',
                    'fields': {
                        'id': {
                            'title': 'Id',
                            'help': 'Étiquette d\'identification de langues IETF (<a href="https://fr.wikipedia.org/wiki/%C3%89tiquette_d%27identification_de_langues_IETF">Wikipedia</a>).',
                        },
                        'description': {
                            'title': 'Description',
                            'help': 'Description de la langue',
                        },
                    },
                },
                'edit': {
                    'title_template': 'Modifier "<%- resourceRow.id %>"',
                    'fields': {
                        'description': {
                            'title': 'Description',
                            'help': 'Description de la langue',
                        },
                    },
                },
                'delete': {
                    'title_template': 'Supprimer I18n Lang',
                    'message_template': 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.id %></strong> ?',
                },
                'mass_delete': {
                    'title_template': 'Supprimer une liste de 18n Lang',
                    'message_template': 'Êtes-vous sûr de vouloir supprimer ces items ?<br /><br /><ul><% _.forEach(resourceRows, function(row) {%><li><strong><%- row.id %></strong></li><% }); %></ul>',
                }
            }
        },
    }
};
