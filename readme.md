#![logo.png](https://bitbucket.org/repo/KrMXBpk/images/1444268910-logo.png)#

## Libs ##

*emsearch* is a [Laravel 5.*](https://laravel.com/) based web application.
Check [composer.json](https://bitbucket.org/emonsite/emsearch/src/master/composer.json) file for more details.

## Database ##

This application use InnoDB tables for foreign keys constraint support and utf8mb4_unicode_ci encoding for modern chars support (including emoji).

It also use UUID (128 bits).

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
php artisan app:reset
```
This command will reset all your database data and (optionally)
seed your app with samples data.


```bash
php artisan app:generateApiDocs
```
Generate API documentation using current database resources.

*Make sure you've configured all in [config/apidocs.php](https://bitbucket.org/emonsite/emsearch/src/master/config/apidocs.php) file.*

## Laravel Echo Server ##

Real-time notifications and events are send by a local Node.js server, using redis and Socket.io

*Make sure you've configured all in :*
*[.env](https://bitbucket.org/emonsite/emsearch/src/master/.env) file.*
*[laravel-echo-server.json](https://bitbucket.org/emonsite/emsearch/src/master/laravel-echo-server.json) file.*
*And Redis & PM2 are installed properly*


Use PM2 for auto-restart feature
*Make sure you've configured all in [laravel-echo-server.ecosystem.config.json](https://bitbucket.org/emonsite/emsearch/src/master/laravel-echo-server.ecosystem.config.json) file.* :
```bash
pm2 start laravel-echo-server.ecosystem.config.json
```

Or use this command to manually start the server :
```bash
laravel-echo-server start
```


## emsearch.ryan.ems-dev.net VM ##

- Front entry point : [https://emsearch.ryan.ems-dev.net](https://emsearch.ryan.ems-dev.net/)
- API entry point : [https://emsearch.ryan.ems-dev.net/api](https://emsearch.ryan.ems-dev.net/api/)
- API documentation entry point :
    - Developer : [https://emsearch.ryan.ems-dev.net/docs/Developer/v1](https://emsearch.ryan.ems-dev.net/docs/Developer/v1)
    - Support : [https://emsearch.ryan.ems-dev.net/docs/Support/v1](https://emsearch.ryan.ems-dev.net/docs/Support/v1)
    - End-User : [https://emsearch.ryan.ems-dev.net/docs/End-User/v1](https://emsearch.ryan.ems-dev.net/docs/End-User/v1)
- OAuth2 consumer application : [https://emsearch-api-consumer.ryan.ems-dev.net](https://emsearch-api-consumer.ryan.ems-dev.net/) (**DEV ONLY !**)