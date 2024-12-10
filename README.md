# Larament

[![Pint](https://github.com/codewithdennis/larament/actions/workflows/pint.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PEST](https://github.com/codewithdennis/larament/actions/workflows/pest.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PHPStan](https://github.com/CodeWithDennis/larament/actions/workflows/phpstan.yml/badge.svg)](https://github.com/CodeWithDennis/larament/actions/workflows/phpstan.yml)
[![Total Installs](https://img.shields.io/packagist/dt/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)

![larament](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/larament.png)

Kickstart your project and save time with Larament! This time-saving starter kit includes a Laravel project with FilamentPHP already installed and set up, along with extra features.

> [!NOTE]
> This starter kit includes **Laravel 11** and **FilamentPHP 3** with some packages that improve the development experience. This will not contain any bloated features or unnecessary packages. If you want to add more features, you can do so by installing the necessary packages. 

## Configuration

### Security and Testing
![pest-php](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/pest-php.png)
- A handfull of [PESTPHP](https://pestphp.com/docs/installation) test cases are included for testing.
- [Should be strict](https://laravel-news.com/shouldbestrict)
  - Prevents lazy loading (N+1) queries.
  - It prevents silently discarding attributes.
  - It prevents accessing missing attributes.
- [Prevent destructive commands from running in production](https://laravel-news.com/prevent-destructive-commands-from-running-in-laravel-11)
- Archtest is included for architectural testing.
- PHPStan is included for static analysis.
- Laravel debugbar is included for debugging.

### Quality of Life
![global-search-keybinding](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/global-search-keybinding.jpg)
- A custom login page autofills email and password with seeded data, streamlining local testing.
- A custom password generator action is available on the user profile and user resource pages.
- Global user search includes email addresses in results for better user discovery.
- All component labels are automatically translatable.
- A `composer review` command that runs PINT, PHPStan, and PEST.
- Helper file is included for custom helper functions.
- A custom `php artisan make:filament-action` command is available for creating actions.

### Design
![user-global-search](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/user-global-search.jpg)
- The Filament Panel's primary color is set to blue.
- Single Page Application (SPA) mode is enabled by default.
- Global search keybinding is preset to `CTRL + K` or `CMD + K`.
- A ready-to-use FilamentPHP [custom theme](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme) that also includes a sidebar separator.
- A custom profile that includes the password generator action.

## Default User
The default user is seeded with the following credentials which is autofilled on the login page.

```dotenv
DEFAULT_USER_EMAIL="admin@example.com"
DEFAULT_USER_PASSWORD="password"
```

## Packages

- [timokoerber/laravel-one-time-operations](https://github.com/TimoKoerber/laravel-one-time-operations)
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
- [phpstan/phpstan](https://phpstan.org/user-guide/getting-started)
- [pestphp/pest](https://pestphp.com/docs/installation)
  - [pestphp/pest-plugin-faker](https://pestphp.com/docs/plugins#faker) 
  - [pestphp/pest-plugin-laravel](https://pestphp.com/docs/plugins#laravel)
  - [pestphp/pest-plugin-livewire](https://pestphp.com/docs/plugins#livewire)

## Installation

**[Use this template](https://github.com/new?template_name=larament&template_owner=CodeWithDennis)** to create a new repository and clone it to your local machine, then navigate to the project directory to run the necessary commands.

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

###  CLI Installation

You can also use the following command to create a new project with Larament.

```bash
composer create-project --prefer-dist CodeWithDennis/larament example-app
```

If you don't want to remember the composer installation syntax for future projects, you can create an alias for your terminal:

```bash
alias larament="composer create-project --prefer-dist CodeWithDennis/larament"
```

This allows you to simply use `larament my-cool-app` in your terminal.

```bash
larament my-cool-app
```
