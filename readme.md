![logo.png](https://bitbucket.org/repo/KrMXBpk/images/1444268910-logo.png)
## Laravel based web application ##

### Dev VM links : ###

- Front entry point : [http://emsearch.ryan.ems-dev.net](http://emsearch.ryan.ems-dev.net/)
- API entry point : [http://emsearch.ryan.ems-dev.net/api](http://emsearch.ryan.ems-dev.net/api/)
- API documentation entry point :
    - Developer : [http://emsearch.ryan.ems-dev.net/docs/developer/v1](http://emsearch.ryan.ems-dev.net/docs/developer/v1)
    - End-User : [http://emsearch.ryan.ems-dev.net/docs/end-user/v1](http://emsearch.ryan.ems-dev.net/docs/end-user/v1)
- OAuth2 consumer application : [http://emsearch-api-consumer.ryan.ems-dev.net](http://emsearch-api-consumer.ryan.ems-dev.net/) (**DEV ONLY !**)

### Database ###

This application use InnoDB tables for foreign keys constraint support and utf8mb4_unicode_ci encoding for modern chars support (including emoji).

It also use UUID (128 bits).

#### Samples Data ####

An Artisan command (See below) can supply your database with samples data for users, projects, etc, for testing and documentation generation purpose.

Check `[database/seeds/Samples](src/database/seeds/Samples)` folder for more information.


| User ID                                 | User Group ID | Name         | Email                   | Password    |
|-----------------------------------------|---------------|--------------|-------------------------|-------------|
| 41abdec2\-1389\-11e7\-93ae-92361f002671 | Developer     | John Doe     | john.doe@domain.tld     | johndoe     |
| 509dd5c0\-1389\-11e7\-93ae-92361f002671 | Support       | Alan Smithee | alan.smithee@domain.tld | alansmithee |
| 605c7610\-1389\-11e7\-93ae-92361f002671 | End-User      | John Smith   | john.smith@domain.tld   | johnsmith   |
| 82b5da82\-138c\-11e7\-93ae-92361f002671 | End-User      | Mickey Mouse | mickey.mouse@domain.tld | mickeymouse |

### Artisan commands ###


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

**Make sure you've configured all in `[config/apidocs.php](src/config/apidocs.php)` file**