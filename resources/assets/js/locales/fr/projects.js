export default {
    'projects': 'Projets',
    'id' : 'Id',
    'project_id': 'Id du Project',
    'name' : 'Nom',
    'project_name': 'Nom du projet',
    'see_project_btn' : 'Voir Projet',

    'data_manager' : {
        'all_projects' : {
            'main_title' : 'Tous projets',
            'empty_message' : 'Aucun enregistrement à afficher.',
            'columns' : {
                'id' : {
                    'title' : 'Id',
                },
                'name' : {
                    'title' : 'Nom',
                },
                'search_engine_id' : {
                    'title' : 'Moteur de recherche',
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
                    'show_modal_link' : 'Créer un nouveau projet',
                    'title_template' : 'Créer un nouveau projet',
                    'fields' : {
                        'name' : {
                            'title' : 'Nom',
                            'help' : '5 caractères minimum.',
                        },
                        'search_engine_id': {
                            'title' : 'Moteur de recherche',
                            'help' : 'Seul <a href="https://www.algolia.com/">Algolia</a> est supporté pour le moment.',
                        },
                    },
                },
                'edit' : {
                    'title_template' : 'Modifier le projet "<%- resourceRow.name %>"',
                    'fields' : {
                        'name' : {
                            'title' : 'Nom',
                            'help' : '5 caractères minimum.',
                        },
                        'search_engine_id': {
                            'title' : 'Moteur de recherche',
                            'help' : 'Seul <a href="https://www.algolia.com/">Algolia</a> est supporté pour le moment.',
                        },
                    },
                },
                'delete' : {
                    'title_template' : 'Supprimer un projet',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de projets',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces projets ?<br /><strong><% _.forEach(resourceRows, function(row) {%><%- row.name %><br /><% }); %></strong>',
                }
            }
        },
        'owner_projects' : {
            'main_title' : 'Projets créés',
            'empty_message' : 'Vous n\'avez pas créé de projets pour le moment.',
            'columns' : {
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
                    'show_modal_link' : 'Créer un nouveau projet',
                    'title_template' : 'Créer un nouveau projet',
                },
                'edit' : {
                   'title_template' : 'Modifier le projet "<%- resourceRow.name %>"',
                },
                'delete' : {
                    'title_template' : 'Supprimer un projet',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de projets',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces projets ?<br /><strong><% _.forEach(resourceRows, function(row) {%><%- row.name %><br /><% }); %></strong>',
                }
            }
        },
        'admin_projects' : {
            'main_title' : 'Projets administrés',
            'empty_message' : 'Aucun enregistrement à afficher.',
            'columns' : {
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
                    'show_modal_link' : 'Créer un nouveau projet',
                    'title_template' : 'Créer un nouveau projet',
                },
                'edit' : {
                    'title_template' : 'Modifier le projet "<%- resourceRow.name %>"',
                },
                'delete' : {
                    'title_template' : 'Supprimer un projet',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer <strong><%- resourceRow.name %></strong> ?',
                },
                'mass_delete' : {
                    'title_template' : 'Supprimer une liste de projets',
                    'message_template' : 'Êtes-vous sûr de vouloir supprimer ces projets ?<br /><strong><% _.forEach(resourceRows, function(row) {%><%- row.name %><br /><% }); %></strong>',
                }
            }
        }
    }
};
