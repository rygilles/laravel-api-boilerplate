import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

/**
 * Dispatch helper : Get basic options and return config object
 * @param object options
 * @returns Object
 */
function filterOptionsConfig(options) {
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
            if (options.include != '') {
                config.params.include = options.include;
            }
        }
    }

    return config;
}

/**
 * Dispatch helper : Perform resource get
 * @param Object state
 * @param String path
 * @param Object options
 * @param String resourceMutation
 * @param String resourceLoadingMutation
 * @param Object extraParameters
 */
function resourceLoad(state, path, options, resourcesStateName, extraParameters) {
    state.commit('setState', {
        stateName: resourcesStateName + 'Loading',
        payload: true
    });

    var config = filterOptionsConfig(options);

    if (typeof extraParameters !== 'undefined') {
        config.params = _.merge(config.params, extraParameters);
    }

    apiAxios.get(path, config)
        .then(response => {
            state.commit('setState', {
                stateName: resourcesStateName,
                payload: response.data
            });
            state.commit('setState', {
                stateName: resourcesStateName + 'Loading',
                payload: false
            });
        }).catch(error => {
        this.$root.axiosError(error);
    });
}

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

        searchEngines: {
            data: [],
            meta: {}
        },
        searchEnginesLoading: true,

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

        userHasProjects: {
            data: [],
            meta: {}
        },
        userHasProjectsLoading: true,

        userUserHasProjects: {
            data: [],
            meta: {}
        },
        userUserHasProjectsLoading: true,

        projectUserHasProjects: {
            data: [],
            meta: {}
        },
        projectUserHasProjectsLoading: true,

        projectOwnerUserHasProjects: {
            data: [],
            meta: {}
        },
        projectOwnerUserHasProjectsLoading: true,

        projectAdminUserHasProjects: {
            data: [],
            meta: {}
        },
        projectAdminUserHasProjectsLoading: true,

        projectSyncItems: {
            data: [],
            meta: {}
        },
        projectSyncItemsLoading: true,

        userGroups: {
            data: [],
            meta: {}
        },
        userGroupsLoading: true,

        userGroupUsers: {
            data: [],
            meta: {}
        },
        userGroupUsersLoading: true,

        syncTaskStatuses: {
            data: [],
            meta: {}
        },
        syncTaskStatusesLoading: true,

        syncTaskStatusSyncTaskStatusVersions: {
            data: [],
            meta: {}
        },
        syncTaskStatusSyncTaskStatusVersionsLoading: true,

        syncTaskTypes: {
            data: [],
            meta: {}
        },
        syncTaskTypesLoading: true,

        syncTaskTypeSyncTaskTypeVersions: {
            data: [],
            meta: {}
        },
        syncTaskTypeSyncTaskTypeVersionsLoading: true,

        projectRootSyncTasks: {
            data: [],
            meta: {}
        },
        projectRootSyncTasksLoading: true,

        projectChildrenSyncTasks: {
            data: [],
            meta: {}
        },
        projectChildrenSyncTasksLoading: true,

        projectRootSyncTaskSyncTaskLogs: {
            data: [],
            meta: {}
        },
        projectRootSyncTaskSyncTaskLogsLoading: true,

        projectChildrenSyncTaskSyncTaskLogs: {
            data: [],
            meta: {}
        },
        projectChildrenSyncTaskSyncTaskLogsLoading: true,

        rootSyncTasks: {
            data: [],
            meta: {}
        },
        rootSyncTasksLoading: true,

        syncTaskChildrenSyncTasks: {
            data: [],
            meta: {}
        },
        syncTaskChildrenSyncTasksLoading: true,

        syncTaskSyncTaskLogs: {
            data: [],
            meta: {}
        },
        syncTaskSyncTaskLogsLoading: true,

        dataStreamDecoders: {
            data: [],
            meta: {}
        },
        dataStreamDecodersLoading: true,

        dataStreamPresets: {
            data: [],
            meta: {}
        },
        dataStreamPresetsLoading: true,

        dataStreamPresetDataStreamPresetFields: {
            data: [],
            meta: {}
        },
        dataStreamPresetDataStreamPresetFieldsLoading: true,

        dataStreams: {
            data: [],
            meta: {}
        },
        dataStreamsLoading: true,

        dataStreamDataStreamFields: {
            data: [],
            meta: {}
        },
        dataStreamDataStreamFieldsLoading: true,

        dataStreamDataStreamHasI18nLangs: {
            data: [],
            meta: {}
        },
        dataStreamDataStreamHasI18nLangsLoading: true,
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

        searchEngines(state) {
            return state.searchEngines;
        },
        searchEnginesLoading(state) {
            return state.searchEnginesLoading;
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

        userHasProjects(state) {
            return state.userHasProjects;
        },
        userHasProjectsLoading(state) {
            return state.userHasProjectsLoading;
        },

        userUserHasProjects(state) {
            return state.userUserHasProjects;
        },
        userUserHasProjectsLoading(state) {
            return state.userUserHasProjectsLoading;
        },

        projectUserHasProjects(state) {
            return state.projectUserHasProjects;
        },
        projectUserHasProjectsLoading(state) {
            return state.projectUserHasProjectsLoading;
        },

        projectOwnerUserHasProjects(state) {
            return state.projectOwnerUserHasProjects;
        },
        projectOwnerUserHasProjectsLoading(state) {
            return state.projectOwnerUserHasProjectsLoading;
        },

        projectAdminUserHasProjects(state) {
            return state.projectAdminUserHasProjects;
        },
        projectAdminUserHasProjectsLoading(state) {
            return state.projectAdminUserHasProjectsLoading;
        },

        projectSyncItems(state) {
            return state.projectSyncItems;
        },
        projectSyncItemsLoading(state) {
            return state.projectSyncItemsLoading;
        },

        userGroups(state) {
            return state.userGroups;
        },
        userGroupsLoading(state) {
            return state.userGroupsLoading;
        },

        userGroupUsers(state) {
            return state.userGroupUsers;
        },
        userGroupUsersLoading(state) {
            return state.userGroupUsersLoading;
        },

        syncTaskStatuses(state) {
            return state.syncTaskStatuses;
        },
        syncTaskStatusesLoading(state) {
            return state.syncTaskStatusesLoading;
        },

        syncTaskStatusSyncTaskStatusVersions(state) {
            return state.syncTaskStatusSyncTaskStatusVersions;
        },
        syncTaskStatusSyncTaskStatusVersionsLoading(state) {
            return state.syncTaskStatusSyncTaskStatusVersionsLoading;
        },

        syncTaskTypes(state) {
            return state.syncTaskTypes;
        },
        syncTaskTypesLoading(state) {
            return state.syncTaskTypesLoading;
        },

        syncTaskTypeSyncTaskTypeVersions(state) {
            return state.syncTaskTypeSyncTaskTypeVersions;
        },
        syncTaskTypeSyncTaskTypeVersionsLoading(state) {
            return state.syncTaskTypeSyncTaskTypeVersionsLoading;
        },

        projectRootSyncTasks(state) {
            return state.projectRootSyncTasks;
        },
        projectRootSyncTasksLoading(state) {
            return state.projectRootSyncTasksLoading;
        },

        projectChildrenSyncTasks(state) {
            return state.projectChildrenSyncTasks;
        },
        projectChildrenSyncTasksLoading(state) {
            return state.projectChildrenSyncTasksLoading;
        },

        projectRootSyncTaskSyncTaskLogs(state) {
            return state.projectRootSyncTaskSyncTaskLogs
        },
        projectRootSyncTaskSyncTaskLogsLoading(state) {
            return state.projectRootSyncTaskSyncTaskLogsLoading
        },

        projectChildrenSyncTaskSyncTaskLogs(state) {
            return state.projectChildrenSyncTaskSyncTaskLogs
        },
        projectChildrenSyncTaskSyncTaskLogsLoading(state) {
            return state.projectChildrenSyncTaskSyncTaskLogsLoading
        },

        rootSyncTasks(state) {
            return state.rootSyncTasks;
        },
        rootSyncTaskLoading(state) {
            return state.rootSyncTasksLoading;
        },

        syncTaskChildrenSyncTasks(state) {
            return state.syncTaskChildrenSyncTasks;
        },
        syncTaskChildrenSyncTasksLoading(state) {
            return state.syncTaskChildrenSyncTasksLoading;
        },

        syncTaskSyncTaskLogs(state) {
            return state.syncTaskSyncTaskLogs;
        },
        syncTaskSyncTaskLogsLoading(state) {
            return state.syncTaskChildrenSyncTasksLoading;
        },

        dataStreamDecoders(state) {
            return state.dataStreamDecoders;
        },
        dataStreamDecodersLoading(state) {
            return state.dataStreamDecodersLoading;
        },

        dataStreamPresets(state) {
            return state.dataStreamPresets;
        },
        dataStreamPresetsLoading(state) {
            return state.dataStreamPresetsLoading;
        },

        dataStreamPresetDataStreamPresetFields(state) {
            return state.dataStreamPresetDataStreamPresetFields;
        },
        dataStreamPresetDataStreamPresetFieldsLoading(state) {
            return state.dataStreamPresetDataStreamPresetFieldsLoading;
        },

        dataStreams(state) {
            return state.dataStreams;
        },
        dataStreamsLoading(state) {
            return state.dataStreamsLoading;
        },

        dataStreamDataStreamFields(state) {
            return state.dataStreamDataStreamFields;
        },
        dataStreamDataStreamFieldsLoading(state) {
            return state.dataStreamDataStreamFieldsLoading;
        },

        dataStreamDataStreamHasI18nLangs(state) {
            return state.dataStreamDataStreamHasI18nLangs;
        },
        dataStreamDataStreamHasI18nLangsLoading(state) {
            return state.dataStreamDataStreamHasI18nLangsLoading;
        },
    },
    mutations: {
        setState(state, data) {
            state[data.stateName] = data.payload;
        },

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

        setSearchEngines(state, searchEngines) {
            state.searchEngines = searchEngines;
        },
        setSearchEnginesLoading(state, loading) {
            state.searchEnginesLoading = loading;
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

        setUserHasProjects(state, userHasProjects) {
            state.userHasProjects = userHasProjects;
        },
        setUserHasProjectsLoading(state, loading) {
            state.userHasProjectsLoading = loading;
        },

        setUserUserHasProjects(state, userHasProjects) {
            state.userUserHasProjects = userHasProjects;
        },
        setUserUserHasProjectsLoading(state, loading) {
            state.userUserHasProjectsLoading = loading;
        },

        setProjectUserHasProjects(state, userHasProjects) {
            state.projectUserHasProjects = userHasProjects;
        },
        setProjectUserHasProjectsLoading(state, loading) {
            state.projectUserHasProjectsLoading = loading;
        },

        setProjectOwnerUserHasProjects(state, userHasProjects) {
            state.projectOwnerUserHasProjects = userHasProjects;
        },
        setProjectOwnerUserHasProjectsLoading(state, loading) {
            state.projectOwnerUserHasProjectsLoading = loading;
        },

        setProjectAdminUserHasProjects(state, userHasProjects) {
            state.projectAdminUserHasProjects = userHasProjects;
        },
        setProjectAdminUserHasProjectsLoading(state, loading) {
            state.projectAdminUserHasProjectsLoading = loading;
        },

        setProjectSyncItems(state, syncItems) {
            state.projectSyncItems = syncItems;
        },
        setProjectSyncItemsLoading(state, loading) {
            state.projectSyncItemsLoading = loading;
        },

        setUserGroups(state, userGroups) {
            state.userGroups = userGroups;
        },
        setUserGroupsLoading(state, loading) {
            state.userGroupsLoading = loading;
        },

        setUserGroupUsers(state, users) {
            state.userGroupUsers = users;
        },
        setUserGroupUsersLoading(state, loading) {
            state.userGroupUsersLoading = loading;
        },

        setSyncTaskStatuses(state, syncTaskStatuses) {
            state.syncTaskStatuses = syncTaskStatuses;
        },
        setSyncTaskStatusesLoading(state, loading) {
            state.syncTaskStatusesLoading = loading;
        },

        setSyncTaskStatusSyncTaskStatusVersions(state, syncTaskStatusVersions) {
            state.syncTaskStatusSyncTaskStatusVersions = syncTaskStatusVersions;
        },
        setSyncTaskStatusSyncTaskStatusVersionsLoading(state, loading) {
            state.syncTaskStatusSyncTaskStatusVersionsLoading = loading;
        },

        setSyncTaskTypes(state, syncTaskTypes) {
            state.syncTaskTypes = syncTaskTypes;
        },
        setSyncTaskTypesLoading(state, loading) {
            state.syncTaskTypesLoading = loading;
        },

        setSyncTaskTypeSyncTaskTypeVersions(state, syncTaskTypeVersions) {
            state.syncTaskStatusSyncTaskStatusVersions = syncTaskTypeVersions;
        },
        setSyncTaskTypeSyncTaskTypeVersionsLoading(state, loading) {
            state.syncTaskTypeSyncTaskTypeVersionsLoading = loading;
        },

        setProjectRootSyncTasks(state, syncTasks) {
            state.projectRootSyncTasks = syncTasks;
        },
        setProjectRootSyncTasksLoading(state, loading) {
            state.projectRootSyncTasksLoading = loading;
        },

        setProjectChildrenSyncTasks(state, syncTasks) {
            state.projectChildrenSyncTasks = syncTasks;
        },
        setProjectChildrenSyncTasksLoading(state, loading) {
            state.projectChildrenSyncTasksLoading = loading;
        },

        setProjectRootSyncTaskSyncTaskLogs(state, syncTaskLogs) {
            state.projectRootSyncTaskSyncTaskLogs = syncTaskLogs;
        },
        setProjectRootSyncTaskSyncTaskLogsLoading(state, loading) {
            state.projectRootSyncTaskSyncTaskLogsLoading = loading;
        },

        setProjectChildrenSyncTaskSyncTaskLogs(state, syncTaskLogs) {
            state.projectChildrenSyncTaskSyncTaskLogs = syncTaskLogs;
        },
        setProjectChildrenSyncTaskSyncTaskLogsLoading(state, loading) {
            state.projectChildrenSyncTaskSyncTaskLogsLoading = loading;
        },

        setRootSyncTasks(state, syncTasks) {
            state.rootSyncTasks = syncTasks;
        },
        setRootSyncTasksLoading(state, loading) {
            state.rootSyncTasksLoading = loading;
        },

        setSyncTaskChildrenSyncTasks(state, syncTasks) {
            state.syncTaskChildrenSyncTasks = syncTasks;
        },
        setSyncTaskChildrenSyncTasksLoading(state, loading) {
            state.syncTaskChildrenSyncTasksLoading = loading;
        },

        setSyncTaskSyncTaskLogs(state, syncTaskLogs) {
            state.syncTaskSyncTaskLogs = syncTaskLogs;
        },
        setSyncTaskSyncTaskLoadingsLoading(state, loading) {
            state.syncTaskSyncTaskLogsLoading = loading;
        },

        setDataStreamDecoders(state, dataStreamDecoders) {
            state.dataStreamDecoders = dataStreamDecoders;
        },
        setDataStreamDecodersLoading(state, loading) {
            state.dataStreamDecodersLoading = loading;
        },

        setDataStreamPresets(state, dataStreamPresets) {
            state.dataStreamPresets = dataStreamPresets;
        },
        setDataStreamPresetsLoading(state, loading) {
            state.dataStreamPresetsLoading = loading;
        },

        setDataStreamPresetDataStreamPresetFields(state, dataStreamPresetFields) {
            state.dataStreamPresetDataStreamPresetFields = dataStreamPresetFields;
        },
        setDataStreamPresetDataStreamPresetFieldsLoading(state, loading) {
            state.dataStreamPresetDataStreamPresetFieldsLoading = loading;
        },

        setDataStreams(state, dataStreams) {
            state.dataStreams = dataStreams;
        },
        setDataStreamsLoading(state, loading) {
            state.dataStreamsLoading = loading;
        },

        setDataStreamDataStreamFields(state, dataStreamFields) {
            state.dataStreamDataStreamFields = dataStreamFields;
        },
        setDataStreamDataStreamFieldsLoading(state, loading) {
            state.dataStreamDataStreamFieldsLoading = loading;
        },

        setDataStreamDataStreamHasI18nLangs(state, dataStreamDataStreamHasI18nLangs) {
            state.dataStreamDataStreamHasI18nLangs = dataStreamDataStreamHasI18nLangs;
        },
        setDataStreamDataStreamHasI18nLangsLoading(state, loading) {
            state.dataStreamDataStreamFieldsLoading = loading;
        },
    },
    actions: {
        getUserOwnerProjects(state, options) {
            resourceLoad(state, '/me/project', options, 'ownerProjects', {user_role_id: 'Owner'});
        },

        getUserAdminProjects(state, options) {
            resourceLoad(state, '/me/project', options, 'adminProjects', {user_role_id: 'Administrator'});
        },

        getAllProjects(state, options) {
            resourceLoad(state, '/project', options, 'allProjects');
        },

        getSearchEngines(state, options) {
            resourceLoad(state, '/searchEngine', options, 'searchEngines');
        },

        getI18nLangs(state, options) {
            resourceLoad(state, '/i18nLang', options, 'i18nLangs');
        },

        getUsers(state, options) {
            resourceLoad(state, '/user', options, 'users');
        },

        getUserHasProjects(state, options) {
            resourceLoad(state, '/userHasProject', options, 'userHasProjects');
        },

        getUserUserHasProjects(state, options) {
            resourceLoad(state, '/user/' + options.userId + '/userHasProject', options, 'userUserHasProjects');
        },

        getProjectUserHasProjects(state, options) {
            resourceLoad(state, '/project/' + options.projectId + '/userHasProject', options, 'projectUserHasProjects');
        },

        getProjectOwnerUserHasProjects(state, options) {
            resourceLoad(state, '/project/' + options.projectId + '/userHasProject', options, 'projectOwnerUserHasProjects', {user_role_id: 'Owner'});
        },

        getProjectAdminUserHasProjects(state, options) {
            resourceLoad(state, '/project/' + options.projectId + '/userHasProject', options, 'projectAdminUserHasProjects', {user_role_id: 'Administrator'});
        },

        getProjectSyncItems(state, options) {
            resourceLoad(state, '/project/' + options.projectId + '/syncItem', options, 'projectSyncItems');
        },

        getUserGroups(state, options) {
            resourceLoad(state, '/userGroup', options, 'userGroups');
        },

        getUserGroupUsers(state, options) {
            resourceLoad(state, '/userGroup/' + options.userGroupId + '/user', options, 'userGroupUsers');
        },

        getSyncTaskStatuses(state, options) {
            resourceLoad(state, '/syncTaskStatus/', options, 'syncTaskStatuses');
        },

        getSyncTaskStatusSyncTaskStatusVersions(state, options) {
            resourceLoad(state, '/syncTaskStatus/' + options.syncTaskStatusId + '/version', options, 'syncTaskStatusSyncTaskStatusVersions');
        },

        getSyncTaskTypes(state, options) {
            resourceLoad(state, '/syncTaskType/', options, 'syncTaskTypes');
        },

        getSyncTaskTypeSyncTaskTypeVersions(state, options) {
            resourceLoad(state, '/syncTaskType/' + options.syncTaskTypeId + '/version', options, 'syncTaskTypeSyncTaskTypeVersions');
        },

        getProjectRootSyncTasks(state, options) {
            resourceLoad(state, '/project/' + options.projectId + '/syncTask', options, 'projectRootSyncTasks', { root: 1 });
        },

        getProjectChildrenSyncTasks(state, options) {
            resourceLoad(state, '/syncTask/' + options.syncTaskId + '/children', options, 'projectChildrenSyncTasks');
        },

        getProjectRootSyncTaskSyncTaskLogs(state, options) {
            resourceLoad(state, '/syncTask/' + options.syncTaskId + '/syncTaskLog', options, 'projectRootSyncTaskSyncTaskLogs');
        },

        getProjectChildrenSyncTaskSyncTaskLogs(state, options) {
            resourceLoad(state, '/syncTask/' + options.syncTaskId + '/syncTaskLog', options, 'projectChildrenSyncTaskSyncTaskLogs');
        },

        getRootSyncTasks(state, options) {
            resourceLoad(state, '/syncTask', options, 'rootSyncTasks', { root: 1 });
        },

        getSyncTaskChildrenSyncTasks(state, options) {
            resourceLoad(state, '/syncTask/' + options.syncTaskId + '/children', options, 'syncTaskChildrenSyncTasks');
        },

        getSyncTaskSyncTaskLogs(state, options) {
            resourceLoad(state, '/syncTask/' + options.syncTaskId + '/syncTaskLog', options, 'syncTaskSyncTaskLogs');
        },

        getDataStreamDecoders(state, options) {
            resourceLoad(state, '/dataStreamDecoder', options, 'dataStreamDecoders');
        },

        getDataStreamPresets(state, options) {
            resourceLoad(state, '/dataStreamPreset', options, 'dataStreamPresets');
        },

        getDataStreamPresetDataStreamPresetFields(state, options) {
            resourceLoad(state, '/dataStreamPreset/' + options.dataStreamPresetId + '/dataStreamPresetField', options, 'dataStreamPresetDataStreamPresetFields');
        },
        
        getDataStreams(state, options) {
            resourceLoad(state, '/dataStream', options, 'dataStreams');
        },

        getDataStreamDataStreamFields(state, options) {
            resourceLoad(state, '/dataStream/' + options.dataStreamId + '/dataStreamField', options, 'dataStreamDataStreamFields');
        },

        getDataStreamDataStreamHasI18nLangs(state, options) {
            resourceLoad(state, '/dataStream/' + options.dataStreamId + '/dataStreamHasI18nLang', options, 'dataStreamDataStreamHasI18nLangs');
        },

    }
});

export default store