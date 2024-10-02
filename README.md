# Larament

[![Pint](https://github.com/codewithdennis/larament/actions/workflows/pint.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PEST](https://github.com/codewithdennis/larament/actions/workflows/pest.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)

![larament.png](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/larament.png)


Kickstart your project and save time with Larament! This time-saving starter kit includes a Laravel project with FilamentPHP already installed and set up, along with extra features.

> [!NOTE]
> This starter kit includes **Laravel 11** and **FilamentPHP 3** with some packages that improve the development experience. This will not contain any bloated features or unnecessary packages. If you want to add more features, you can do so by installing the necessary packages. 


## Filament Configuration and Extra's

- The Filament Panel's primary color is set to blue.
- Single Page Application (SPA) mode is enabled by default, providing faster and smoother user experiences.
- A custom login page autofills email and password with seeded data, removing the need for manual typing in local testing.
- Global search keybinding is preset to `CTRL + K` or `CMD + K` (for macOS) for quick access to search functionality.
- A PEST test case for the `UserResource` ensures all functionalities are tested effectively.
- The global user search includes email addresses in the search results for better user discovery.
- A custom password generator action is available on the user profile and user resource pages.
- A custom profile page utilizes the password generation feature for streamlined user management.
- A ready-to-use custom theme includes a sidebar separator for better UI organization.
- Password reset functionality is available on the login page for easy password recovery.
- All component labels are automatically translatable, so there’s no need to add `->translateLabel()` to individual components.
- Archtest is included for architectural testing.

## Default User (Local)
By default, the first user will be created based on the credentials setup in the `.env` file. If you want to change the default user after running the seeders, you can update the `DEFAULT_USER_EMAIL` and `DEFAULT_USER_PASSWORD` in the `.env` file and run the seeders again.

```dotenv
DEFAULT_USER_EMAIL="admin@example.com"
DEFAULT_USER_PASSWORD="password"
```

## Composer Review
A composer script `composer review` is available to run the following commands to ensure the codebase is clean and ready for deployment.

```bash
composer review
```

The script will run the following commands:

```bash
./vendor/bin/pest --parallel
./vendor/bin/pint
./vendor/bin/phpstan analyse
```
## [Helpers](https://laravel-news.com/creating-helpers)
I've set up a Helper file for you to use in your Laravel app. You can find it at `app\Helpers.php`. This file is ready for you to add your custom helper functions, which Composer will automatically include in your project.

## [Should Be Strict](https://laravel-news.com/shouldbestrict)
This boilerplate has `shouldBeStrict` in the boot method of the `AppServiceProvider`. This setting will stop lazy loading (prevents N+1 query issues), silently discarding attributes, and prevent accessing missing attributes. This will help you catch errors early and improve the quality of your code.

## Packages

### [timokoerber/laravel-one-time-operations](https://github.com/TimoKoerber/laravel-one-time-operations)
This package lets you run one-time tasks in your Laravel application. Instead of creating a new migration for a small job, you can use this package to run the task just once. Any new one-time operations will be placed in the `database/operations` folder.

Also, adding this to your deployment can be really helpful because you won't need to manually run seeders if you want to modify data in your production environment.


### [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
This package provides a developer toolbar for debugging Laravel applications. It includes a lot of helpful information like queries, routes, views, and more.

### [pestphp/pest](https://pestphp.com/docs/installation)
PESTPHP is a testing framework with a focus on simplicity, meticulously designed to bring back the joy of testing in PHP.

> [!NOTE]
> The new version 3 is now available and is the default testing framework in this boilerplate!

#### Additional Plugins
- [pestphp/pest-plugin-faker](https://pestphp.com/docs/plugins#faker) 
- [pestphp/pest-plugin-laravel](https://pestphp.com/docs/plugins#laravel)
- [pestphp/pest-plugin-livewire](https://pestphp.com/docs/plugins#livewire)

### [phpstan/phpstan](https://phpstan.org/user-guide/getting-started)
PHPStan scans your whole codebase and looks for both obvious & tricky bugs. Even in those rarely executed if statements that certainly aren't covered by tests.

## Installation

**[Use this template](https://github.com/new?template_name=larament&template_owner=CodeWithDennis)** to create a new repository and clone it to your local machine, then navigate to the project directory to run the necessary commands.

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
```

Since [Laravel 11](https://laravel.com/docs/11.x/releases#application-defaults) the default database is SQLite, if you want to use another database, update the `.env` file with your database preferences before running the migrations.

```bash
php artisan migrate --seed
```

### Alternative Installation Method


```bash
composer create-project --prefer-dist CodeWithDennis/larament example-app
```

If you don't want to remember the composer installation syntax for future projects, you can create an alias for your terminal:

```bash
alias larament="composer create-project --prefer-dist CodeWithDennis/larament"
```

This allows you to simply use `larament project-example` in your terminal.

```bash
larament project-example
cd project-example/
npm install && npm run build
php artisan db:seed
php artisan serve
```


## Screenshots
![user-global-search](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/user-global-search.jpg)

## Boilerplate
The following files are part of the "branding" and can be removed.
- resources/images/larament.png
- resources/images/user-global-search.jpg
