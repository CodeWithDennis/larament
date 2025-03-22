# Larament

[![Pint](https://github.com/codewithdennis/larament/actions/workflows/pint.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PEST](https://github.com/codewithdennis/larament/actions/workflows/pest.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PHPStan](https://github.com/CodeWithDennis/larament/actions/workflows/phpstan.yml/badge.svg)](https://github.com/CodeWithDennis/larament/actions/workflows/phpstan.yml)
[![Total Installs](https://img.shields.io/packagist/dt/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)

![Larament](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/larament.png)

**Larament** is a time-saving starter kit to quickly launch Laravel projects. It includes **FilamentPHP** pre-installed and configured, along with additional tools and features to streamline your development workflow.

---

## Table of Contents

- [Features](#features)
  - [Security and Testing](#security-and-testing)
  - [Quality of Life](#quality-of-life)
  - [Design](#design)
- [Default User](#default-user)
- [Included Packages](#included-packages)
- [Installation](#installation)
  - [CLI Installation](#cli-installation)

---

## Features

### Security and Testing

- **PESTPHP**: Preconfigured with test cases for streamlined testing. ([Learn more](https://pestphp.com/docs/installation))
- **Strict mode enabled** via [Should Be Strict](https://laravel-news.com/shouldbestrict):
  - Prevents lazy loading (N+1 queries).
  - Guards against discarding or accessing missing attributes.
- **Production safeguards**: Prevents destructive commands in production. ([Learn more](https://laravel-news.com/prevent-destructive-commands-from-running-in-laravel-11))
- **Architectural testing** with Archtest.
- **Static analysis** using PHPStan.
- **Debugging** with Laravel Debugbar.

### Quality of Life

- Custom login page autofills email and password with seeded data for quicker testing.
- Built-in password generator action on the user profile and user resource pages.
- Enhanced global search includes email addresses for better discoverability.
- Auto-translatable component labels.
- `composer review`: A single command to run Pint, PHPStan, and PEST.
- Helper functions available through a dedicated helper file.
- Custom `php artisan make:filament-action` command for generating Filament actions.

### Design
![User Global Search](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/user-global-search.jpg)

- Filament Panel's primary color is preset to blue.
- Single Page Application (SPA) mode enabled by default.
- Global search keybinding set to `CTRL + K` or `CMD + K`.
- A ready-to-use FilamentPHP custom theme, including a sidebar separator.
- Enhanced profile page with a built-in password generator.

---

## Default User

A default user is seeded with the following credentials, pre-filled on the login page for quick access:

```dotenv
DEFAULT_USER_NAME="John Doe"
DEFAULT_USER_EMAIL="admin@example.com"
DEFAULT_USER_PASSWORD="password"
```

## Included Packages

The following packages are pre-installed:

- [timokoerber/laravel-one-time-operations](https://github.com/TimoKoerber/laravel-one-time-operations)
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
- [phpstan/phpstan](https://phpstan.org/user-guide/getting-started)
- [pestphp/pest](https://pestphp.com/docs/installation)
  - [pestphp/pest-plugin-faker](https://pestphp.com/docs/plugins#faker)
  - [pestphp/pest-plugin-laravel](https://pestphp.com/docs/plugins#laravel)
  - [pestphp/pest-plugin-livewire](https://pestphp.com/docs/plugins#livewire)

## Installation
### Using the Template
- Create a repository using the Larament template.
- Clone your repository to your local machine.
 Navigate to the project directory and run the following commands:
```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### CLI Installation
Alternatively, you can use the following command to create a new project with Larament:

```bash
composer create-project --prefer-dist CodeWithDennis/larament example-app
```

### Create a Terminal Alias
For easier usage in future projects, create an alias in your terminal:

```bash
alias larament="composer create-project --prefer-dist CodeWithDennis/larament"
```

Now, you can create a new project with a simple command:

```bash
larament my-cool-app
```
