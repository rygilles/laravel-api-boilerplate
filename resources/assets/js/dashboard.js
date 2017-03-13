
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * OAuth Axios for token requesting
 */

window.oauthAxios = window.axios.create({
    withCredentials : true,
    headers : {
        'X-CSRF-TOKEN': window.Laravel.csrfToken,
        'X-REQUESTED-WITH': 'XMLHttpRequest'
    }
});

/**
 * Api Axios
 */

window.apiAxios = window.axios.create({
    baseURL : 'http://emsearch.ryan.ems-dev.net/api',
    withCredentials : true,
    headers : {
        'X-CSRF-TOKEN': window.Laravel.csrfToken,
        'X-REQUESTED-WITH': 'XMLHttpRequest'
    }
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

/**
 * Vue i18n
 */

import VueI18n from 'vue-i18n';

Vue.use(VueI18n);
Vue.config.lang = document.getElementsByTagName('html')[0].getAttribute('lang');

import locales from './locales';

var i18n = new VueI18n({
    locale: Vue.config.lang,
    messages : locales
})

/**
 * Vue router
 */

import VueRouter from 'vue-router';

Vue.use(VueRouter);

// Import the actual routes, aliases, ...
import routes from './routes';

// Create our router object and set options on it
const DashboardRouter = new VueRouter({
    mode: 'hash',
    routes: routes
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const DashboardVue = Vue.extend(require('./dashboard.vue'));

window.Dashboard = new DashboardVue({
    i18n : i18n,
    router : DashboardRouter
}).$mount('#dashboard');

/**
 * Handle date rendering with local browser timezone
 */

window.Vue.prototype.momentLocalDate = (date) => {
    return moment.utc(date, 'YYYY-MM-DD H:mm:ss').local().format(window.Dashboard.$i18n.messages[window.Dashboard.$i18n.locale].common.datetime_format);
};