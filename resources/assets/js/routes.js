export default [
    {
        path : '/home',
        name : 'home',
        component : require('./components/dashboard/home.vue'),
        alias : '/'
    },
    {
        path : '/api-configuration',
        name : 'api-configuration',
        component : require('./components/dashboard/api-configuration.vue'),
        props : true
    },
    {
        path : '/user-projects',
        name : 'user-projects',
        component : require('./components/dashboard/user-projects.vue')
    },
    {
        path : '/user-project/:projectId',
        name : 'user-project',
        component : require('./components/dashboard/user-project.vue'),
        props : true
    },
    {
        path : '/all-projects',
        name : 'all-projects',
        component : require('./components/dashboard/all-projects.vue')
    },
    {
        path : '/i18n-langs',
        name : 'i18n-langs',
        component : require('./components/dashboard/i18n-langs.vue')
    },
    {
        path : '/i18n-lang/:i18nLangId',
        name : 'i18n-lang',
        component : require('./components/dashboard/i18n-lang.vue'),
        props : true
    },
];