# Larament

[![Pint](https://github.com/codewithdennis/larament/actions/workflows/pint.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PEST](https://github.com/codewithdennis/larament/actions/workflows/pest.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PHPStan](https://github.com/CodeWithDennis/larament/actions/workflows/phpstan.yml/badge.svg)](https://github.com/CodeWithDennis/larament/actions/workflows/phpstan.yml)
[![Total Installs](https://img.shields.io/packagist/dt/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)

![Larament](https://raw.githubusercontent.com/CodeWithDennis/larament/main/resources/images/larament.png)

**Larament** is a time-saving starter kit to quickly launch Laravel `12.x` projects. It includes **FilamentPHP** `4.x` pre-installed and configured, along with additional tools and features to streamline your development workflow.

## Dependencies

This project includes several core dependencies that provide essential functionality:

- **[nunomaduro/essentials](https://github.com/nunomaduro/essentials)**: A collection of essential Laravel tools and helpers

### Development

This project includes several development dependencies to ensure code quality and streamline the development process:

- **[larastan/larastan](https://github.com/larastan/larastan)**: Static analysis tool for Laravel applications
- **[laravel/pint](https://laravel.com/docs/12.x/pint)**: PHP code style fixer for Laravel projects
- **[pestphp/pest](pestphp.com/docs/installation)**: Elegant PHP testing framework
- **[pestphp/pest-plugin-faker](https://pestphp.com/docs/plugins)**: Faker integration for Pest
- **[pestphp/pest-plugin-laravel](https://pestphp.com/docs/plugins)**: Laravel integration for Pest
- **[pestphp/pest-plugin-livewire](https://pestphp.com/docs/plugins)**: Livewire testing utilities for Pest
- **[rector/rector](https://github.com/rectorphp/rector)**: Automated code refactoring tool

These tools help maintain code quality, provide testing capabilities, and improve the development experience.

## Installation

Create a new Larament project and set it up with a single command:

```bash
composer create-project codewithdennis/larament your-project-name
cd your-project-name 
composer install
npm install
php artisan serve
```
