<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# [Project] Stuck Neverflow

Stuck Neverflow is a forum application created using the Laravel web development framework, this application uses a template from SBadmin

### Requirement:

- PHP >= 7.4
- Laravel 8.x
- Composer 2.x
- NodeJS Stable v.14

### Install

- Clone this repository
- Run `composer install`
- Run `cp .env.example .env`
- Run `php artisan key:generate`
- Settings `.env` file (mail driver, database, github API)
- Run `npm install && npm run dev`

### Database Migration and Seeder

- Run `php artisan migrate --seed`

### Run your server
- Run `php artisan serve`

### Open Browser
- at `http://localhost:8000/`