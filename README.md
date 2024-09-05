# Larament

![larament.png](resources/images/larament.png)


Kickstart your project and save time with Larament! This time-saving starter kit includes a Laravel project with FilamentPHP already installed and set up, along with extra features.

> [!NOTE]
> This starter kit includes **Laravel 11** and **FilamentPHP 3** with some packages that improve the development experience. This will not contain any bloated features or unnecessary packages. If you want to add more features, you can do so by installing the necessary packages. 


## Filament Configuration and Extra's

- The primary [color](https://filamentphp.com/docs/3.x/support/colors) for the Filament Panel is set to `Color::Blue`.
- [SPA](https://filamentphp.com/docs/3.x/panels/configuration#spa-mode) (Single Page Application) is enabled by default.
- A custom login page that automatically pre-fills the email and password with seeded data, allowing for easy local testing without the need to manually enter credentials.
- The global search keybinding is set to `CTRL + K` or `CMD + K` for macOS by default.
- A PEST case for the UserResource that tests all functionalities.
- A global search for users that contains the email in the search results.
- A [custom action](https://github.com/CodeWithDennis/larament/blob/main/app/Filament/Actions/GeneratePasswordAction.php) for generating passwords on the user's profile page and user resource.
- A [custom profile page](https://github.com/CodeWithDennis/larament/blob/main/app/Filament/Pages/App/Profile.php) that uses the above mentioned generate password action.
- A [custom theme](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme) that is ready to be used which includes a sidebar separator.
- All component labels are automatically translatable which means that you do not need to add `->translateLabel()` to your components.

## Helpers
You can also create your own helper functions for Laravel apps and PHP packages by having Composer automatically import them. Fortunately, this is already set up, and you can find the file in `app\Helpers.php`.

## Packages

### [timokoerber/laravel-one-time-operations](https://github.com/TimoKoerber/laravel-one-time-operations)
This package allows you to run one-time operations in your Laravel application. Instead of adding a new migration for a simple task, you can use this package to run the operation only once. New one time operations will be added in the `database/operations` directory.


### [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
This package provides a developer toolbar for debugging Laravel applications. It includes a lot of helpful information like queries, routes, views, and more.

> This package is only installed in the development environment.

### [pestphp/pest](https://pestphp.com/docs/installation)
Pest is a testing framework with a focus on simplicity, meticulously designed to bring back the joy of testing in PHP.

> This package is only installed in the development environment.

#### Additional Plugins
- [pestphp/pest-plugin-faker](https://pestphp.com/docs/plugins#faker) 
- [pestphp/pest-plugin-laravel](https://pestphp.com/docs/plugins#laravel)
- [pestphp/pest-plugin-livewire](https://pestphp.com/docs/plugins#livewire)

### [phpstan/phpstan](https://phpstan.org/user-guide/getting-started)
PHPStan scans your whole codebase and looks for both obvious & tricky bugs. Even in those rarely executed if statements that certainly aren't covered by tests.

> This package is only installed in the development environment.

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

### Additional way to install Larament

```bash
composer create-project --prefer-dist CodeWithDennis/larament example-app
```

## Screenshots
![user-global-search](resources/images/user-global-search.jpg)

## Boilerplate
The following files are part of the "branding" and can be removed.
- resources/images/larament.png
- resources/images/user-global-search.jpg
