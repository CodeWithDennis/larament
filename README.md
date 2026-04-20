# Larament

[![Pint](https://github.com/codewithdennis/larament/actions/workflows/pint.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PEST](https://github.com/codewithdennis/larament/actions/workflows/pest.yml/badge.svg)](https://packagist.org/packages/codewithdennis/larament)
[![PHPStan](https://github.com/CodeWithDennis/larament/actions/workflows/phpstan.yml/badge.svg)](https://github.com/CodeWithDennis/larament/actions/workflows/phpstan.yml)
[![Total Installs](https://img.shields.io/packagist/dt/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/larament.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/larament)

A **bloat-free starter kit** for Laravel 13.x with FilamentPHP 5.x pre-configured. Only essential development tools included.

> [!NOTE]
> Requires **PHP 8.3** or higher.

## What's Included

### Core Dependencies
- **Laravel 13.x** - The PHP framework
- **FilamentPHP 5.x** - Admin panel with SPA mode, custom theme, and MFA enabled
- **nunomaduro/essentials** - Better Laravel defaults (strict models, auto-eager loading, immutable dates)

### Development Tools
- **larastan/larastan** - Static analysis
- **laravel/pint** - Code style fixer
- **pestphp/pest** - Testing framework
- **rector/rector** - Automated refactoring
- **fruitcake/laravel-debugbar** - Development insights

### Testing
Includes a comprehensive test suite with **PEST 4.x** including browser testing - perfect for learning testing or as a reference for your own tests.

![Tests](resources/images/tests.png)

## GitHub Workflows

Comes with pre-configured GitHub Actions workflows for automated quality assurance:

- **Tests** - PEST 4.x testing with 4 parallel shards for faster CI/CD
- **PHPStan** - Static analysis and type checking
- **Pint** - Automated code style fixing with auto-commit

## Quick Start

```bash
composer create-project codewithdennis/larament your-project-name
cd your-project-name 
composer install
php artisan boost:install
npm install
npm run build
php artisan serve
```

After `composer install`, run **`php artisan boost:install`** once per project. [Laravel Boost](https://github.com/laravel/boost) writes the editor and assistant integrations this stack expects—guidance rules, MCP configuration, and the rest—already scoped to your paths and environment. Those files are intentionally omitted from the starter kit, so you generate them locally after install.

If you use an AI-powered editor or coding assistant, enable **MCP** (Model Context Protocol) for this project in that tool’s settings, then turn on the Laravel Boost MCP server. Your assistant can then reach Boost’s Laravel-aware tools instead of working without project context.

## Features

### Filament Admin Panel
- SPA mode enabled
- Custom login page with autofilled credentials in local environment
- Custom theme included
- Profile management enabled
- MFA (App Authentication) enabled

![Login](resources/images/login-page.png)

### Filament Tables
- Striped rows for better visual separation
- Deferred loading for improved performance

![Users Table](resources/images/users-table.png)

### Development Workflow
```bash
composer review  # Runs Pint, Rector, PHPStan, and Pest
```

## Customizations

### Migration Stubs
Custom stubs remove the `down()` method by default. Remove the custom stubs to use Laravel's default templates.

### Helper Functions
Add your own helpers in `app/Helpers.php`:

```php
if (! function_exists('example')) {
    function example(): string
    {
        return 'Your helper function here.';
    }
}
```

## Terminal Aliases

### Simple Alias
```bash
alias larament="composer create-project --prefer-dist CodeWithDennis/larament"
larament my-project
```

### Advanced Function (Example with Herd)

Add this to your `~/.bashrc`, `~/.zshrc`, or shell configuration file:

```bash
function larament() {
  local cmd="$1"
  shift

  case "$cmd" in
    new)
      if [[ -z "$1" ]]; then
        return 1
      fi

      local project_name="$1"
      composer create-project --prefer-dist CodeWithDennis/larament "$project_name" || return 1
      cd "$project_name" || return 1

      # Update APP_URL in .env
      if [[ -f ".env" ]]; then
        sed -i '' "s|^APP_URL=.*|APP_URL=https://${project_name}.test|" .env
      fi

      herd link --secure && herd open
      ;;
    *)
      return 1
      ;;
  esac
}
```

Usage:

```bash
larament new my-project
```
