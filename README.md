# Laravel Windmill Presets

[![License](https://img.shields.io/github/license/Kamona-WD/laravel-windmill-presets)](https://github.com/Kamona-WD/laravel-windmill-presets/blob/master/LICENSE.md)
[![License](https://img.shields.io/github/release/Kamona-WD/laravel-windmill-presets)](https://github.com/Kamona-WD/laravel-windmill-presets/releases)

A Laravel 7.0+ front-end scaffolding preset for [Windmill-Dashboard](https://github.com/estevanmaito/windmill-dashboard)

## Note

We recommend installing this preset on a project that you are starting from scratch, otherwise your project's design might break.

IF you want to use [laravel/fortify](https://github.com/laravel/fortify) check this repo [kamona/fortify-windmill](https://github.com/Kamona-WD/fortify-windmill) .

## Usage

1. Fresh install Laravel >= 7.0 and `cd` to your app.
2. Install this preset via `composer require kamona/laravel-windmill-presets`. Laravel will automatically discover this package. No need to register the service provider.

### a. For Presets without Authentication

1. Use `php artisan ui windmill` for the basic CSS, JS preset it also update your `package.json`, `webpack.mix.js` and put `tailwind.config.js`
2. `npm install && npm run dev`
3. `php artisan serve`

### b. For Presets with Authentication

1. Use `php artisan ui windmill --auth` for the basic preset, auth route entry, and Windmill auth views in one go. (NOTE: If you run this command several times, be sure to clean up the duplicate Auth entries in `routes/web.php` and run `npm install && npm run dev` again)
2. `npm install && npm run dev`
3. Configure your favorite database (mysql, sqlite etc.)
4. `php artisan migrate` to create basic user tables.
5. `php artisan serve` (or equivalent) to run server and test preset.

## Edit views

Sidebar links `views/partials/sidebar/sidebar-content.blade.php`.

Sidebar header `views/partials/sidebar/sidebar-header.blade.php`.

Sidebar footer `views/partials/sidebar/sidebar-footer.blade.php`.

Navbar right links `views/partials/navbar/navbar-links.blade.php`.

Layouts `views/layouts`.

Dashboard `views/home.blade.php`

## Side note

I know my English is horrible so please forgive me. I hope you will understand what I want to say in this read me file.

### Screenshots

| Welcome Light                                | Welcome Dark                               |
| -------------------------------------------- | ------------------------------------------ |
| ![Welcome Light](/screens/welcome-light.png) | ![Welcome Dark](/screens/welcome-dark.png) |

| Register Light                                 | Register Dark                                |
| ---------------------------------------------- | -------------------------------------------- |
| ![Register Light](/screens/register-light.png) | ![Register Dark](/screens/register-dark.png) |

| Login Light                              | Login Dark                             |
| ---------------------------------------- | -------------------------------------- |
| ![Login Light](/screens/login-light.png) | ![Login Dark](/screens/login-dark.png) |

| Reset Password Light                                       | Reset Password Dark                                      |
| ---------------------------------------------------------- | -------------------------------------------------------- |
| ![Reset Password Light](/screens/password-email-light.png) | ![Reset Password Dark](/screens/password-email-dark.png) |

| Dashboard Light                                  | Dashboard Dark                                 |
| ------------------------------------------------ | ---------------------------------------------- |
| ![Dashboard Light](/screens/dashboard-light.png) | ![Dashboard Dark](/screens/dashboard-dark.png) |

| Mobile Light                                         | Mobile Dark                                        |
| ---------------------------------------------------- | -------------------------------------------------- |
| ![Mobile Light](/screens/dashboard-mobile-light.png) | ![Mobile Dark](/screens/dashboard-mobile-dark.png) |
| ![Mobile Light](/screens/login-light-mobile.png)     | ![Mobile Dark](/screens/login-dark-mobile.png)     |
