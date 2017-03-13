export default [
    {
        path : '/home',
        component : require('./components/dashboard/home.vue'),
        alias : '/'
    },
    {
        path : '/api-configuration',
        name : 'api-configuration',
        component : require('./components/dashboard/api-configuration.vue')
    }
    ,
    {
        path : '/user-projects',
        name : 'user-projects',
        component: require('./components/dashboard/user-projects.vue')
    }
];