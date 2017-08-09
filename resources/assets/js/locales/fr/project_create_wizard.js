export default {
    'title': 'Wizard de création d\'un nouveau projet',
    'steps': [
        {
            'description': 'Créez un nouveau projet facilement en entrant les données demandées ci-dessous.',
        },
        {
            'description': 'Step 2 Description',
        },
    ],
    'fields': {
        'projectName': {
            'label': 'Nom du projet',
            'placeholder': 'Mon Projet',
            'help': '',
        },
        'projectSearchEngineId': {
            'label': 'Moteur de recherche (interne)',
            'help': 'Seul les utilisateurs du support et les développeurs peuvent voir/définir la valeur de ce champ.',
        },
        'dataStreamFeedUrl': {
            'label': 'Url du flux de données',
            'help': '',
        },
        'dataStreamPresetId': {
            'label': 'Preset de flux de données',
            'help': 'Choisissez le preset correspondant à votre flux de données.',
        },
        'i18nLangsIds': {
            'label': 'I18n Langues',
            'help': 'Choisissez les langues disponibles dans votre flux de données.',
        },
        'widgetPresetId': {
            'label': 'Preset de Widget',
            'help': 'Choisissez un preset de widget correspondant à vos besoins.',
        },
    },
    'buttons': {
        'next_step': 'Étape suivante',
        'previous_step': 'Étape précédente',
    },
}