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
        component : require('./components/dashboard/projects.vue')
    },
    {
        path : '/project/:projectId',
        name : 'project',
        component : require('./components/dashboard/project.vue'),
        props : true
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
    {
        path : '/search-engine/:searchEngineId',
        name : 'search-engine',
        component : require('./components/dashboard/search-engine.vue'),
        props : true
    },
    {
        path : '/users',
        name : 'users',
        component : require('./components/dashboard/users.vue')
    },
    {
        path : '/user/:userId',
        name : 'user',
        component : require('./components/dashboard/user.vue'),
        props : true
    },
    {
        path : '/user-groups',
        name : 'user-groups',
        component : require('./components/dashboard/user-groups.vue')
    },
    {
        path : '/user-group/:userGroupId',
        name : 'user-group',
        component : require('./components/dashboard/user-group.vue'),
        props : true
    },
];