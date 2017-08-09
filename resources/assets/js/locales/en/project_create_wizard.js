export default {
    'title': 'New Project Wizard',
    'steps': [
        {
            'description': 'Create a new project easily with this form.',
        },
        {
            'description': 'Your project is created ! Now, you need to specify which lang',
        },
    ],
    'fields': {
        'projectName': {
            'label': 'Project Name',
            'placeholder': 'My Project',
            'help': '',
        },
        'projectSearchEngineId': {
            'label': 'Search Engine (internal)',
            'help': 'Only Developers and End-Users can see/set this field.',
        },
        'dataStreamFeedUrl': {
            'label': 'DataStream Feed URL',
            'help': '',
        },
        'dataStreamPresetId': {
            'label': 'DataStream Preset',
            'help': 'Select a preset according to your data stream nature.',
        },
        'i18nLangsIds': {
            'label': 'I18n Langs',
            'help': 'Select langs locales of your data stream.',
        },
        'widgetPresetId': {
            'label': 'Widget Preset',
            'help': 'Select a widget preset according to your use case.',
        },
    },
    'buttons': {
        'next_step': 'Next step',
        'previous_step': 'Previous step',
    },
}