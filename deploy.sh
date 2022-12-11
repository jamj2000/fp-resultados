#!/bin/bash

php artisan config:clear
php artisan config:cache
php artisan cache:clear
php artisan serve --host=0.0.0.0 --port=80 
