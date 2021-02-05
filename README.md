# Egora
The Worldwide Stock-Market of Ideas

Cloud Installation [Tutorial](https://engineering.paiza.io/entry/paizacloud_laravel)

### Or
Get [PHP](https://php.net).

Install Laravel with [Composer](https://getcomposer.org/):

```nothing
git clone https://github.com/CezaryJurewicz/Egora

cd Egora

composer update

php artisan serve
```

rename .env.example to .env

### If the images URLs are missing a protocol:
 open Egora\app\Providers\AppServiceProvider.php
 
 in the boot() function
 
 comment out this line
 ```php
        //URL::forceScheme(env('FORCE_SCHEME', 'https'));
```
### Install [MariaDB](https://mariadb.org/)
```SQL
create database laravel;
```

### If there's a DB driver issue:
Go to php.ini in the php installation folder

Remove the ; from ;extension=pdo_mysql.so


```nothing
php artisan migrate

php artisan migrate:status

php artisan migrate
```

register on Egora
Either set up a mailing service (Mailgun), or change a database for your user entry
```SQL
use laravel;
select * from users;
update users set email_verified_at="2021-02-03 00:01:56";
```


<a name="initial-configuration"></a>
## Initial Configuration

All of the configuration files for the Laravel framework are stored in the `config` directory. Each option is documented, so feel free to look through the files and get familiar with the options available to you.

Laravel needs almost no additional configuration out of the box. You are free to get started developing! However, you may wish to review the `config/app.php` file and its documentation. It contains several options such as `timezone` and `locale` that you may wish to change according to your application.

<a name="environment-configuration"></a>
#### Environment Based Configuration

Since many of Laravel's configuration option values may vary depending on whether your application is running on your local computer or on a production web server, many important configuration values are defined using the `.env` file that exists at the root of your application.

Your `.env` file should not be committed to your application's source control, since each developer / server using your application could require a different environment configuration. Furthermore, this would be a security risk in the event an intruder gains access to your source control repository, since any sensitive credentials would get exposed.

> For more information about the `.env` file and environment based configuration, check out the full [configuration documentation](https://laravel.com/docs/6.x/configuration#environment-configuration).

## Next Steps
First, we strongly recommend becoming familiar with how Laravel works by reading the following documentation:

- [Request Lifecycle](https://laravel.com/docs/6.x/lifecycle)
- [Configuration](https://laravel.com/docs/6.x/configuration)
- [Directory Structure](https://laravel.com/docs/6.x/structure)
- [Service Container](https://laravel.com/docs/6.x/container)
- [Facades](https://laravel.com/docs/6.x/facades)

you are going to use Laravel to route requests to your application and render your frontend via [Blade templates](https://laravel.com/docs/6.x/blade)

you may want to check out our documentation on [routing](https://laravel.com/docs/6.x/routing), [views](https://laravel.com/docs/6.x/views), or the [Eloquent ORM](https://laravel.com/docs/6.x/eloquent). 

If you are using Laravel as a full stack framework, we also strongly encourage you to learn how to compile your application's CSS and JavaScript using [Laravel Mix](https://laravel.com/docs/6.x/mix).
