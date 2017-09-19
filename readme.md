# Laravel API Boilerplate #

This is a Laravel [Laravel 5.*](https://laravel.com/) based project.

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

Check the [.env](./.env) and change the values according to you preferences.

## Libs ##

Check [composer.json](./composer.json) file for details.

## Database ##

This application use InnoDB tables for foreign keys constraint support and utf8mb4_unicode_ci encoding for modern chars support (including emoji).
It also use UUID (128 bits).

### Initialize ###

Run this command to create the database basics with default migrations (check [database/migrations](./database/migrations) directory).

```bash
php artisan app:makeFresh
```

This will install :

*Laravel basic tables* : user, password_resets, notification, jobs
*Passport bundle tables* : oauth_auth_codes, oauth_access_tokens, oauth_refresh_tokens, oauth_clients_table, oauth_personal_access_clients)
*Boilerplate tables* : i18n_lang, user_group

### Samples Data ###

An Artisan command (See below) can supply your database with samples data for users, projects, etc, for testing and documentation generation purpose.

*Check [database/seeds/Samples](https://bitbucket.org/emonsite/emsearch/src/master/database/seeds/Samples) folder for more information.*


| User ID                                | User Group ID | Name         | Email                   | Password    |
|----------------------------------------|:-------------:|:------------:|:-----------------------:|:-----------:|
| `41abdec2-1389-11e7-93ae-92361f002671` | Developer     | John Doe     | john.doe@domain.tld     | johndoe     |
| `509dd5c0-1389-11e7-93ae-92361f002671` | Support       | Alan Smithee | alan.smithee@domain.tld | alansmithee |
| `605c7610-1389-11e7-93ae-92361f002671` | End-User      | John Smith   | john.smith@domain.tld   | johnsmith   |
| `82b5da82-138c-11e7-93ae-92361f002671` | End-User      | Mickey Mouse | mickey.mouse@domain.tld | mickeymouse |

## Artisan commands ##


```bash
php artisan app:makeFresh
```
This command will reset/refresh migrations,
re-create required database data and (optionally)
create a fresh app with samples data.



```bash
php artisan app:generateApiDocs
```
Generate API documentation using current database resources.

*Make sure you've configured all in [config/apidocs.php](./config/apidocs.php) file.*

## Laravel Echo Server ##

Real-time notifications and events are send by a local Node.js server, using Redis and Socket.io.

The whole process is handled by [laravel-echo-server](https://github.com/tlaverdure/laravel-echo-server).

*Make sure you've configured all in :*


*[.env](https://bitbucket.org/emonsite/emsearch/src/master/.env) file.*

*[laravel-echo-server.json](./laravel-echo-server.json) file.*

*And Redis & PM2 are installed properly*


Use PM2 for auto-restart feature

*Make sure you've configured all in [laravel-echo-server.ecosystem.config.json](./laravel-echo-server.ecosystem.config.json) file.* :
```bash
pm2 start laravel-echo-server.ecosystem.config.json
```

Or use this command to manually start the server :
```bash
laravel-echo-server start
```
