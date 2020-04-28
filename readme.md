Requirements
-----------

This Website Front End requires:

* PHP (Version >= 7.2.5)
* MySQL (Version >= 5.0)


# Setup

Install Composer Dependencies:

`composer install`

Install NPM Dependencies:

`npm install`

Create a copy of your .env file:

`cp .env.example .env`

Generate an app encryption key:

`php artisan key:generate`

Migrate the database:

`php artisan migrate`


# Running the app

Run project with this command:

`php artisan serve`
