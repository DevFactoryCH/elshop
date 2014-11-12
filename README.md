#ElShop

This package is a simple e-commerce engine made by DevFactory

## Installation

Using Composer, edit your `composer.json` file to require `devfactory/elshop`.

  "require": {
    "devfactory/elshop": "dev-master"
  }

Then from the terminal run

    composer update

Then register the  service provider by opening `app/config/app.php`

    'Devfactory\Elshop\ElshopServiceProvider'

If you want you can publish the config files if you want to change them

    php artisan config:publish devfactory/elshop

Perform the DB migrations to install the required tables

    php artisan migrate --package=devfactory/elshop
