# atm-demo
A very simple demo of web development using Laravel, Vuejs, MySql for an ATM system.

## Install

### Clone repo
cd into atm

### run:
````
composer install
vagrant up
````

### run: 
````
vagrant ssh
cd /var/www/atm
php artisan storage:link
php artisan migrate
php artisan passport:install
yarn
yarn run dev
````

### Browse to atm.test
### Register account
### Click on things, do stuff