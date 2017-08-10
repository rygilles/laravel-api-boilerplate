const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const widget_id = 'b070b438-781d-11e7-b5a5-be2e44b06b34';

const assets_dir = 'storage/app/widgets/assets/' + widget_id + '/';
const public_dir = 'storage/app/widgets/public/' + widget_id + '/';

mix.setResourceRoot(assets_dir);
mix.setPublicPath(public_dir);

mix.js('js/widget.js', 'js');

if (mix.config.inProduction) {
    mix.version();
}