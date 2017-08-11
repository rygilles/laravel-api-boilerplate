import Vue from 'vue'
import Widget from './widget.vue'

window.axios = require('axios');

window.apiAxios = window.axios.create({
    baseURL : 'https://emsearch.ryan.ems-dev.net/api',
    withCredentials : true,
    headers : {
        'X-REQUESTED-WITH': 'XMLHttpRequest',
        'Accept-Language': 'fr'
    }
});


new Vue({
    el: '#widgetContainer',
    render: h => h(Widget)
})