# Weight Logging App

This repo is technical test material for backend developer position at Sirclo


## Installation

* Download or clone this repository
* Make sure your machine meets Laravel requirements as described [here](https://laravel.com/docs/5.6/installation#server-requirements)
* CD to the root folder of this application
* run `composer install`
* run `php artisan key:generate`
* configure your database access in `.env` file
* run `php artisan migrate`
* run `php artisan serve`
* and access the application at `http://127.0.0.1:8000`


## Using the Application

* After opening the application, click on Register link in navbar
* Register with your own data and login with it
* You can now start managing Weight Log by accessing Weight Log menu in navbar


## Run Unit Test

* CD to the root folder of this application
* run `./vendor/bin/phpunit`