import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

var store = new Vuex.Store({
    state: {
        laravel : null,
        me: null,

        notifications: [],

        ownerProjects: {
            data: [],
            meta: {}
        },
        ownerProjectsLoading: true,

        adminProjects: {
            data: [],
            meta: {}
        },
        adminProjectsLoading: true,

        allProjects: {
            data: [],
            meta: {}
        },
        allProjectsLoading: true,

        i18nLangs: {
            data: [],
            meta: {}
        },
        i18nLangsLoading: true,

        users: {
            data: [],
            meta: {}
        },
        usersLoading: true,

        userGroups: {
            data: [],
            meta: {}
        },
        userGroupsLoading: true,
    },
    getters: {
        laravel(state) {
          return state.laravel;
        },
        me(state) {
            if (state.me === null) {
                // return empty data object
                return {
                    'id' : '',
                    'email' : '',
                    'name' : '',
                    'user_group_id' : ''
                };
            }
            return state.me;
        },

        notifications(state) {
            return state.notifications;
        },
        notificationsCount(state) {
            return state.notifications.length;
        },

        ownerProjects(state) {
            return state.ownerProjects;
        },
        ownerProjectsLoading(state) {
            return state.ownerProjectLoading;
        },

        adminProjects(state) {
            return state.adminProjects;
        },
        adminProjectsLoading(state) {
            return state.adminProjectsLoading;
        },

        allProjects(state) {
            return state.allProjects;
        },
        allProjectsLoading(state) {
            return state.allProjectsLoading;
        },

        i18nLangs(state) {
            return state.i18nLangs;
        },
        i18nLangsLoading(state) {
            return state.i18nLangsLoading;
        },

        users(state) {
            return state.users;
        },
        usersLoading(state) {
            return state.usersLoading;
        },

        userGroups(state) {
            return state.userGroups;
        },
        userGroupsLoading(state) {
            return state.userGroupsLoading;
        },
    },
    mutations: {
        setLaravel(state, laravel) {
            state.laravel = laravel;
        },
        setMe(state, me) {
            state.me = me;
        },
        addNotification(state, notification) {
            // Remove duplicate before
            var oldNotification = _.find(state.notifications, {'id' : notification.id});
            if (oldNotification) {
                state.notifications.pop(oldNotification);
            }

            state.notifications.push(notification);
        },
        removeNotification(state, notification) {
            state.notifications.pop(notification);
        },

        setOwnerProjects(state, ownerProjects) {
            state.ownerProjects = ownerProjects;
        },
        setOwnerProjectsLoading(state, loading) {
            state.ownerProjectsLoading = loading;
        },

        setAdminProjects(state, adminProjects) {
            state.adminProjects = adminProjects;
        },
        setAdminProjectsLoading(state, loading) {
            state.adminProjectsLoading = loading;
        },

        setAllProjects(state, allProjects) {
            state.allProjects = allProjects;
        },
        setAllProjectsLoading(state, loading) {
            state.allProjectsLoading = loading;
        },

        setI18nLangs(state, i18nLangs) {
            state.i18nLangs = i18nLangs;
        },
        setI18nLangsLoading(state, loading) {
            state.i18nLangsLoading = loading;
        },

        setUsers(state, users) {
            state.users = users;
        },
        setUsersLoading(state, loading) {
            state.usersLoading = loading;
        },

        setUserGroups(state, users) {
            state.userGroups = users;
        },
        setUserGroupsLoading(state, loading) {
            state.userGroupsLoading = loading;
        },
    },
    actions: {
        getUserOwnerProjects(state, options) {
            state.commit('setOwnerProjectsLoading', true);

            var config = {
                params: {
                    page: (options.page ? options.page : 1),
                    limit: (options.limit ? options.limit : 20),
                    user_role_id: 'Owner',
                }
            };

            if ('order_by' in options) {
                config.params.order_by = options.order_by.column + ',' + options.order_by.direction;
            }

            if ('search' in options) {
                if (options.search != '') {
                    config.params.search = options.search;
                }
            }

            apiAxios.get('/me/project', config)
                .then(response => {
                    state.commit('setOwnerProjects', response.data);
                    state.commit('setOwnerProjectsLoading', false);
                }).catch(error => {
                    this.$root.axiosError(error);
                });
        },

        getUserAdminProjects(state) {
            state.commit('setAdminProjectsLoading', true);
            apiAxios.get('/me/project?user_role_id=Administrator')
                .then(response => {
                    state.commit('setAdminProjects', response.data);
                    state.commit('setAdminProjectsLoading', false);
                }).catch(error => {
                this.$root.axiosError(error);
            });
        },

        getAllProjects(state, options) {
            state.commit('setAllProjectsLoading', true);

            var config = {
                params: {
                    page: (options.page ? options.page : 1),
                    limit: (options.limit ? options.limit : 20),
                }
            };

            if ('order_by' in options) {
                config.params.order_by = options.order_by.column + ',' + options.order_by.direction;
            }

            if ('search' in options) {
                if (options.search != '') {
                    config.params.search = options.search;
                }
            }

            if ('include' in options) {
                if (Array.isArray(options.include)) {
                    config.params.include = _.join(options.include, ',');
                } else if (typeof options.include == 'string') {
                    config.params.include = options.include;
                }
            }

            apiAxios.get('/project', config)
                .then(response => {
                    state.commit('setAllProjects', response.data);
                    state.commit('setAllProjectsLoading', false);
                }).catch(error => {
                this.$root.axiosError(error);
            });
        },

        getI18nLangs(state, options) {
            state.commit('setI18nLangsLoading', true);

            var config = {
                params: {
                    page: (options.page ? options.page : 1),
                    limit: (options.limit ? options.limit : 20),
                }
            };

            if ('order_by' in options) {
                config.params.order_by = options.order_by.column + ',' + options.order_by.direction;
            }

            if ('search' in options) {
                if (options.search != '') {
                    config.params.search = options.search;
                }
            }

            apiAxios.get('/i18nLang', config)
                .then(response => {
                    state.commit('setI18nLangs', response.data);
                    state.commit('setI18nLangsLoading', false);
                }).catch(error => {
                this.$root.axiosError(error);
            });
        },

        getUsers(state, options) {
            state.commit('setUsersLoading', true);

            var config = {
                params: {
                    page: (options.page ? options.page : 1),
                    limit: (options.limit ? options.limit : 20),
                }
            };

            if ('order_by' in options) {
                config.params.order_by = options.order_by.column + ',' + options.order_by.direction;
            }

            if ('search' in options) {
                if (options.search != '') {
                    config.params.search = options.search;
                }
            }

            apiAxios.get('/user', config)
                .then(response => {
                    state.commit('setUsers', response.data);
                    state.commit('setUsersLoading', false);
                }).catch(error => {
                this.$root.axiosError(error);
            });
        },

        getUserGroups(state, options) {
            state.commit('setUserGroupsLoading', true);

            var config = {
                params: {
                    page: (options.page ? options.page : 1),
                    limit: (options.limit ? options.limit : 20),
                }
            };

            if ('order_by' in options) {
                config.params.order_by = options.order_by.column + ',' + options.order_by.direction;
            }

            if ('search' in options) {
                if (options.search != '') {
                    config.params.search = options.search;
                }
            }

            apiAxios.get('/userGroup', config)
                .then(response => {
                    state.commit('setUserGroups', response.data);
                    state.commit('setUserGroupsLoading', false);
                }).catch(error => {
                this.$root.axiosError(error);
            });
        },
    }
});

export default store