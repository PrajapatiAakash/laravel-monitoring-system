<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel Monitoring System

Laravel package used for monitoring the laravel system.

# Getting started

## Installation

Define package dependencies and autoloading:
    In the composer.json file located in the root of your package.
    Add below in your composer.json
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/prajapatiaakash/laravel-monitoring-system"
            }
        ]
    
    Run the below command to install package:
        composer require prajapatiaakash/laravel-monitoring-system

Register the middleware:
    Open your Laravel project's app/Http/Kernel.php file.

    In the $middleware property, add the fully qualified class name of the middleware from your custom package. For example:
        protected $middleware = [
            // Other middleware...
            \PrajapatiAakash\LaravelMonitoringSystem\Http\Middleware\LogRequestsAndResponses::class,
        ];

    If you want to only log the api requests then above line add on your api middleware group. For example:

        protected $middlewareGroups = [
            'web' => [
                // Other middleware...
            ],
            'api' => [
                // Other middleware...
                \PrajapatiAakash\LaravelMonitoringSystem\Http\Middleware\LogRequestsAndResponses::class,
            ],
        ];

In your Laravel application, open the config/app.php file and add your package's service provider to the providers array:
    'providers' => [
        // Other service providers...
        \PrajapatiAakash\LaravelMonitoringSystem\Providers\MonitoringSystemServiceProvider:class
    ],

Publish the package's assets (optional):
    If you want to customize or modify the package's assets, you can publish them to your Laravel application. Run the following command in your Laravel application's terminal to publish the assets:

    php artisan vendor:publish --tag=laravel-monitoring-system-views
    php artisan vendor:publish --tag=laravel-monitoring-system-assets

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Test the package:
    Run the below url in your browser:

        hostname/admin/monitoring-system

**TL;DR command list**
    composer require prajapatiaakash/laravel-monitoring-system
    php artisan vendor:publish --tag=laravel-monitoring-system
    php artisan migrate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.


## License

The Laravel Monitoring System is open-sourced project licensed under the [MIT license](https://opensource.org/licenses/MIT).
