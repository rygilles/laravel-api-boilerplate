/**
 * Load locales files
 */

/**
 * Specify langs folder here
 * @type {string[]}
 */
var langs = ['en' , 'fr'];

/**
 * Specify lang subfolders files path here
 * @fixme dynamic require/loading for all the zone/file instead of using this array
 * @type {string[]}
 */
var files = [
    'common',
    'routes',
    'auth',
    'api',
    'sidebar',
    'topbar',
    'notifications',
    'home',
    'projects',
    'search_engines',
    'i18n_langs',
    'user_groups',
    'users',
    'user_has_projects',
    'sync_items',
    'sync_tasks',
    'sync_task_statuses',
    'sync_task_status_versions',
    'sync_task_types',
    'sync_task_type_versions',
    'sync_task_logs',
];

// Create locales from file hierarchy

var locales = {};

for (var l in langs)
{
    var lang = langs[l];
    locales[lang] = {};

    for (var f in files)
    {
        var file = files[f];
        locales[lang][file] = require('./locales/' + lang + '/' + file).default;
    }
}

export default locales;