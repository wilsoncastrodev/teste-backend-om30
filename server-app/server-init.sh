#!/bin/bash -it

cp .env.example .env
composer install
php artisan route:clear
php artisan cache:clear
php artisan config:clear
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
service supervisor start horizon
chmod -R 777 storage