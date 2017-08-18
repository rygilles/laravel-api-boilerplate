import jQuery from 'jquery'
window.$ = window.jQuery = jQuery
require('bootstrap-sass')
require('font-awesome-webpack')

import Vue from 'vue'
import Widget from './widget.vue'

window.axios = require('axios');

window.apiAxios = window.axios.create({
    baseURL : '<!-- @widget_setting(api_base_url) -->',
    withCredentials : true,
    headers : {
        'X-REQUESTED-WITH': 'XMLHttpRequest',
        'Accept-Language': '<!-- @widget_setting(request_lang) -->'
    }
});


new Vue({
    el: '#widgetContainer',
    render: h => h(Widget)
})