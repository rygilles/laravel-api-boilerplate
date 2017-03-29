![logo.png](https://bitbucket.org/repo/KrMXBpk/images/1444268910-logo.png)
## Laravel based web application ##
#### Dev VM links : ####

- Front entry point : [http://emsearch.ryan.ems-dev.net](http://emsearch.ryan.ems-dev.net/)
- API entry point : [http://emsearch.ryan.ems-dev.net/api](http://emsearch.ryan.ems-dev.net/api/)
- API documentation entry point :
    - Developer : [http://emsearch.ryan.ems-dev.net/docs/developer/v1](http://emsearch.ryan.ems-dev.net/docs/)
    - End-User : [http://emsearch.ryan.ems-dev.net/docs/end-user/v1](http://emsearch.ryan.ems-dev.net/docs/)
- OAuth2 consumer application : [http://emsearch-api-consumer.ryan.ems-dev.net](http://emsearch-api-consumer.ryan.ems-dev.net/) (**DEV ONLY !**)

#### Artisan commands : ####


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

**Make sure you've configured all in `config/apidocs.php` file**