import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

var store = new Vuex.Store({
    state: {
        laravel : null,
        me: null,
        notifications: []
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
        }
    },
    mutations: {
        setLaravel(state, laravel) {
            state.laravel = laravel;
        },
        setMe(state, me) {
            state.me = me;
        },
        addNotification(state, notification) {
            state.notifications.push(notification);
        },
        removeNotification(state, notification) {
            state.notifications.pop(notification);
        }
    },
    actions: {

    }
});

export default store