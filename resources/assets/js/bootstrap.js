
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

window.moment = require('moment');

require('moment/locale/fr');

window.Noty = require('noty');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

require('bootstrap-less');

// Admin LTE main javascript
require('admin-lte');

// Admin LTE plugins

// Pace loading shall be externalized of the mixed file !
//require('admin-lte/plugins/pace/pace');
require('admin-lte/plugins/daterangepicker/daterangepicker');
require('admin-lte/plugins/datepicker/bootstrap-datepicker');
require('admin-lte/plugins/datepicker/locales/bootstrap-datepicker.fr');
require('admin-lte/plugins/slimScroll/jquery.slimscroll');
require('admin-lte/plugins/fastclick/fastclick');
require('admin-lte/plugins/select2/select2');
require('admin-lte/plugins/select2/i18n/fr');
require('admin-lte/plugins/datatables/jquery.dataTables');
require('datatables.net-select');
//require('admin-lte/plugins/datatables/dataTables.bootstrap');