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
 * @type {string[]}
 */
var files = [
    'common',
    'routes',
    'auth',
    'api',
    'topbar',
    'home',
    'projects'
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