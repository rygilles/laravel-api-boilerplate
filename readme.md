# Laravel API Boilerplate #

This is a Laravel [Laravel 5.*](https://laravel.com/) based project.


## Prerequisites ##


- [PHP 7.*+](http://php.net/) (for Laravel 5.5+ framework)
- [Node.js 6.*+](https://nodejs.org)
- [Redis 3+](https://redis.io/)
- [Laravel Echo Server 1.3.*+](https://github.com/tlaverdure/laravel-echo-server) installed globally
- [PM 2](http://pm2.keymetrics.io/) (Optional : Run Laravel Echo Server as a "daemon")


## Setup ##


Run this command and make sure to chmod properly the storage and cache folders.

```bash
composer create-project --prefer-dist rygilles/laravel-api-boilerplate your-project-name
```

Or install this project manually by cloning with git.
In this case, you must copy the [.env.example](./.env.example) file to .env and run this command :

```bash
php artisan key:generate
```


### .env file ###


Check the [.env](./.env.example) file and change the values according to you preferences.


## Libs ##


This project uses the same libraries as Laravel common projects.

But also (Check [composer.json](./composer.json) and [package.json](./package.json) file for details) :


### Production environment ###


#### PHP, with composer ####

- [alsofronie/eloquent-uuid](https://github.com/alsofronie/eloquent-uuid) for User, UserGroup and Notification models.
- [bugsnag/bugsnag-laravel](https://github.com/bugsnag/bugsnag-laravel) for debug purpose (Set BUGSNAG_API_KEY in your [.env](./.env.example#L48) file).
- [dingo/api](https://github.com/dingo/api) for Api features.
- [felixkiss/uniquewith-validator](https://github.com/felixkiss/uniquewith-validator) for advanced validation rule.
- [filp/whoops](https://github.com/filp/whoops) for better error display in debug mode.
- [predis/predis](https://github.com/nrk/predis) for interactions with redis server and [laravel-echo-server](https://github.com/tlaverdure/laravel-echo-server).
- [rygilles/laravel-apidoc-generator](https://github.com/rygilles/laravel-apidoc-generator) for generating Api documentation.
- [rygilles/laravel-openapi-schema-generator](https://github.com/rygilles/laravel-openapi-schema-generator) for generating Open API json file.


#### Back-office, Node.js dependencies ####

- [laravel-echo](https://github.com/laravel/echo) : Laravel Echo is a JavaScript library that makes it painless to subscribe to channels and listen for events broadcast by Laravel.
- [socket.io-client](https://github.com/socketio/socket.io-client) : Realtime application framework (client) used with Laravel Echo.

### Development environment ###


- [nikic/php-parser](https://github.com/nikic/PHP-Parser) : PHP parsing (Used with the `php artisan app:makeApiModelResource` command).
- [twig/twig](https://github.com/twigphp/Twig) : Twig template rendering (Used with the `php artisan app:makeApiModelResource` command).
- [barryvdh/laravel-ide-helper package](https://github.com/barryvdh/laravel-ide-helper) : Tool for generating Laravel definitions (PhpDoc) php file. Adding auto-complete in your IDE.


#### Back-office, Node.js dependencies ####

Vue.js :

- [vue](https://github.com/vuejs/vue) : Vue.js javascript framework for back-office UI.
- [vuex](https://github.com/vuejs/vuex) : Centralized state management for Vue.js.
- [vue-router](https://github.com/vuejs/vue-router) : Official router for Vue.js.
- [vue-i18n](https://github.com/kazupon/vue-i18n) : Translations management in Vue.js.
- [vue-gravatar](https://github.com/JiriChara/vue-gravatar) : A dead-simple gravatar component for Vue.js.

Graphics :

- [admin-lte](https://github.com/almasaeed2010/AdminLTE) : Back-office dashboard and control panel.
- [bootstrap-less](https://github.com/distros/bootstrap-less) and [bootstrap-sass](https://github.com/twbs/bootstrap-sass) : Used with AdminLTE.
- [node-sass](https://github.com/sass/node-sass) : Used with AdminLTE.
- [font-awesome](https://github.com/FortAwesome/Font-Awesome) : Used with AdminLTE.
- [ionicons](https://github.com/ionic-team/ionicons) : Used with AdminLTE.
- [noty](https://github.com/needim/noty) : Live notifications UI.
- [datatables.net-select-dt](https://github.com/DataTables/Dist-DataTables-Select-DataTables) : Used for custom data table component styles.

Laravel :

- [laravel-mix](https://github.com/JeffreyWay/laravel-mix) : An elegant wrapper around Webpack for the 80% use case.
- [cross-env](https://github.com/kentcdodds/cross-env) : Cross platform setting of environment scripts.

Miscellaneous :

- [jquery](https://github.com/jquery/jquery) : Used with AdminLTE.
- [axios](https://github.com/mzabriskie/axios) : Authentication and Api requesting.
- [pace](https://github.com/HubSpot/pace) : Dynamic loading bar (Top of the screen).
- [lodash](https://github.com/lodash/lodash) : JavaScript utility library used with Vue.js.
- [moment](https://github.com/moment/moment) : Dates formatter.


## Database ##


This application use InnoDB tables for foreign keys constraint support and utf8mb4_unicode_ci encoding for modern chars support (including emoji).
It also use UUID (128 bits).


### Initialize ###

Run this command to create the database basics with default migrations (check [database/migrations](./database/migrations) directory).

*Make sure Redis is installed properly.*

```bash
php artisan app:makeFresh
```

This will install :

**Laravel basic tables** : user, password_resets, notification, jobs

**Passport bundle tables** : oauth_auth_codes, oauth_access_tokens, oauth_refresh_tokens, oauth_clients_table, oauth_personal_access_clients)

**Boilerplate tables** : i18n_lang, user_group

### Samples Data ###

An Artisan command (See below) can supply your database with samples data for users, projects, etc, for testing and documentation generation purpose.

*Check [database/seeds/Samples](./database/seeds/Samples) folder for more information.*


| User ID                                | User Group ID | Name         | Email                   | Password    |
|----------------------------------------|:-------------:|:------------:|:-----------------------:|:-----------:|
| `41abdec2-1389-11e7-93ae-92361f002671` | Developer     | John Doe     | john.doe@domain.tld     | johndoe     |
| `509dd5c0-1389-11e7-93ae-92361f002671` | Support       | Alan Smithee | alan.smithee@domain.tld | alansmithee |
| `605c7610-1389-11e7-93ae-92361f002671` | End-User      | John Smith   | john.smith@domain.tld   | johnsmith   |
| `82b5da82-138c-11e7-93ae-92361f002671` | End-User      | Mickey Mouse | mickey.mouse@domain.tld | mickeymouse |


## Node, Laravel Mix and Laravel Echo Server ##


### NodeJs ###


Install NodeJs dependencies (check [package.json](./package.json) file for more information).

```bash
npm install
```


### Laravel Mix ###


#### Assets ####


Create your own back-office images by replacing :

- [resources/assets/img/dashboard-logo.png](./resources/assets/img/dashboard-logo.png) (50 x 200)
- [resources/assets/img/dashboard-mini-logo.png](./resources/assets/img/dashboard-mini-logo.png) (50 x 50)
- resources/assets/img/favicon.jpg


*Check the [webpack.mix.js](./webpack.mix.js) to enable favicon.jpg copy and manage you own assets.*


#### Compilation ####


Run this command to compile the assets

```bash
npm run dev
```


### Laravel Echo Server ###


Real-time notifications and events are send by a local Node.js server, using Redis and Socket.io.

The whole process is handled by [laravel-echo-server](https://github.com/tlaverdure/laravel-echo-server).

Initialize Laravel Echo Server by creating [laravel-echo-server.json](./laravel-echo-server.json) configuration file with this command :

```bash
laravel-echo-server init
```


#### Start and Auto-restart ####


Use PM2 for auto-restart feature

*Make sure you've configured all in [laravel-echo-server.ecosystem.config.json](./laravel-echo-server.ecosystem.config.json) file.* :
```bash
pm2 start laravel-echo-server.ecosystem.config.json
```

Or use this command to manually start the server :
```bash
laravel-echo-server start
```


## Artisan commands ##


### app:makeFresh ###


```bash
php artisan app:makeFresh
```
This command will reset/refresh migrations,
re-create required database data and (optionally)
create a fresh app with samples data.


### app:generateApiDocs ###


```bash
php artisan app:generateApiDocs
```
Generate API documentation using current database resources.

*Make sure you've configured all in [config/apidocs.php](./config/apidocs.php) file.*


### app:makeApiModelResource ###


```bash
php artisan app:makeApiModelResource
```

**Only in development environment !**

Generate and **MODIFY** source files to add a new model with related files :

- Model : Created in [app/Models](./app/models) folder.
- Migration (Optional) : Created in [database/migrations](./database/migrations) folder.
- Init seeder (Optional) : Created in [database/seeds](./database/seeds) folder. That will also **MODIFY** the [database/seeds/InitSeeder.php](./database/seeds/InitSeeder.php) file !
- Samples seeder (Optional) : Created in [database/seeds/Samples](./database/seeds/Samples) folder. That will also **MODIFY** the [database/seeds/Samples/SamplesSeeder.php](./database/seeds/Samples/SamplesSeeder.php) file !
- Controller (Optional) : Created in [app/Http/Controllers/Api](./app/Http/Controllers/Api) folder. That will also **MODIFY** the [routes/api.php](./routes/api.php) file !
- Requests : Will be generated if "store" method or "update" method making is wanted. In [app/Http/Requests](./app/Http/Requests) folder.
- Transformer : Will be generated if needed. In [app/Http/Transformers/Api](./app/Http/Transformers/Api) folder.

During this command execution, the Laravel application will be down (`php artisan down` then `php artisan up` at the end, called implicitly).

Composer dump autoloads will be called at the end.


### app:makeApiModelResourceAssets ###


```bash
php artisan app:makeApiModelResourceAssets
```

**Only in development environment !**

Generate and **MODIFY** basic assets source files for a new resource model in the dashboard :

- Resource model list vue component : Created in [resources/assets/js/components/dashboard](./resources/assets/js/components/dashboard) folder.
- Resource model item vue component : Created in [resources/assets/js/components/dashboard](./resources/assets/js/components/dashboard) folder.
- Resource model locales js files : Created in [resources/assets/js/locales](./resources/assets/js/locales) folder (one file per locale).
- Routes locales js files [resources/assets/js/locales/en/routes.js](./resources/assets/js/locales/en/routes.js) and other locales file : **MODIFY** to add resource model list and item routes.
- Vuex store js file [resources/assets/js/store.js](./resources/assets/js/store.js) : **MODIFY** to add resource model state, getters, mutations and actions.
- Routes js file [resources/assets/js/routes.js](./resources/assets/js/routes.js) : **MODIFY** to add resource model list and item routes.
- Side-bar menu vue component file [resources/assets/js/components/includes/sidebar-menu.vue](./resources/assets/js/components/includes/sidebar-menu.vue) : **MODIFY** to add resource model links *(interactive)*.

During this command execution, the Laravel application will be down (`php artisan down` then `php artisan up` at the end, called implicitly).

Make sure to run `npm run dev` or `npm run watch` to check your assets compilation.

*(Upcoming upgrades to do : Model resource analysis to complete new components fields and other stuff like this.)*

### openApiSchemas:generate ###


```bash
php artisan openApiSchemas:generate
```


This command is provided by the [rygilles/laravel-openapi-schema-generator](https://github.com/rygilles/laravel-openapi-schema-generator) package.

It will analyze your laravel project files and generate a openapi json file, describing the capabilities of your Api.

Check the [config/openapischemas.php](./config/openapischemas.php) configuration file before running this command.

Some information can not be retrieve automatically by the script, you might update/add data in the ["openapi_bindings" configuration array](./config/openapischemas.php#L177#L548).


### ide-helper:generate ###


```bash
php artisan ide-helper:generate
```

This command is provided by [barryvdh/laravel-ide-helper package](https://github.com/barryvdh/laravel-ide-helper).

*Only for development environment*

This package generates a file that your IDE understands, so it can provide accurate autocompletion.
Generation is done based on the files in your project, so they are always up-to-date.
If you don't want to generate it, you can add a pre-generated file to the root folder of your Laravel project
(but this isn't as up-to-date as self generated files).
