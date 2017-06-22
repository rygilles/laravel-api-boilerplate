export default [
    {
        path : '/home',
        name : 'home',
        component : require('./components/dashboard/home.vue'),
        alias : '/',
        meta : {
            breadcrumbIconClass : 'fa fa-home',
        }
    },
    {
        path : '/api-configuration',
        name : 'api-configuration',
        component : require('./components/dashboard/api-configuration.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-cubes',
            parentRouteName : 'home',
        }
    },
    {
        path : '/user-projects',
        name : 'user-projects',
        component : require('./components/dashboard/user-projects.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-sticky-note',
            parentRouteName : 'home',
        }
    },
    {
        path : '/all-projects',
        name : 'all-projects',
        component : require('./components/dashboard/projects.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-sticky-note-o',
            parentRouteName : 'home',
        }
    },
    {
        path : '/project/:projectId',
        name : 'project',
        component : require('./components/dashboard/project.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-sticky-note-o',
            parentRouteName : 'all-projects',
        }
    },
    {
        path : '/i18n-langs',
        name : 'i18n-langs',
        component : require('./components/dashboard/i18n-langs.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-language',
            parentRouteName : 'home',
        }
    },
    {
        path : '/i18n-lang/:i18nLangId',
        name : 'i18n-lang',
        component : require('./components/dashboard/i18n-lang.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-language',
            parentRouteName : 'i18n-langs',
        }
    },
    {
        path : '/search-engines',
        name : 'search-engines',
        component : require('./components/dashboard/search-engines.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-search',
            parentRouteName : 'home',
        }
    },
    {
        path : '/search-engine/:searchEngineId',
        name : 'search-engine',
        component : require('./components/dashboard/search-engine.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-search',
            parentRouteName : 'search-engines',
        }
    },
    {
        path : '/users',
        name : 'users',
        component : require('./components/dashboard/users.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-user',
            parentRouteName : 'home',
        }
    },
    {
        path : '/user/:userId',
        name : 'user',
        component : require('./components/dashboard/user.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-user',
            parentRouteName : 'users',
        }
    },
    {
        path : '/user-groups',
        name : 'user-groups',
        component : require('./components/dashboard/user-groups.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-users',
            parentRouteName : 'home',
        }
    },
    {
        path : '/user-group/:userGroupId',
        name : 'user-group',
        component : require('./components/dashboard/user-group.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-users',
            parentRouteName : 'user-groups',
        }
    },
    {
        path : '/sync-task-statuses',
        name : 'sync-task-statuses',
        component : require('./components/dashboard/sync-task-statuses.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-tasks',
            parentRouteName : 'home',
        }
    },
    {
        path : '/sync-task-status/:syncTaskStatusId',
        name : 'sync-task-status',
        component : require('./components/dashboard/sync-task-status.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-tasks',
            parentRouteName : 'sync-task-statuses',
        }
    },
    {
        path : '/sync-task-types',
        name : 'sync-task-types',
        component : require('./components/dashboard/sync-task-types.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-tasks',
            parentRouteName : 'home',
        }
    },
    {
        path : '/sync-task-type/:syncTaskTypeId',
        name : 'sync-task-type',
        component : require('./components/dashboard/sync-task-type.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-tasks',
            parentRouteName : 'sync-task-types',
        }
    },
    {
        path : '/sync-tasks',
        name : 'sync-tasks',
        component : require('./components/dashboard/sync-tasks.vue'),
        meta : {
            breadcrumbIconClass : 'fa fa-tasks',
            parentRouteName : 'home',
        }
    },
    {
        path : '/sync-task/:syncTaskId',
        name : 'sync-task',
        component : require('./components/dashboard/sync-task.vue'),
        props : true,
        meta : {
            breadcrumbIconClass : 'fa fa-tasks',
            parentRouteName : 'sync-tasks',
        }
    },
    {
        path : '/test',
        name : 'test',
        component : require('./components/dashboard/test.vue'),
        alias : '/',
        meta : {
            breadcrumbIconClass : 'fa fa-thumbs-o-down',
        }
    },
];