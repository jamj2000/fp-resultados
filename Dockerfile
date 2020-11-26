FROM php:5.6-apache

WORKDIR /var/www/html
COPY . .

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
 && curl -S https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
 && apt-get update && apt-get install -y unzip git libmcrypt-dev \
 && docker-php-ext-install pdo pdo_mysql mcrypt \
 && docker-php-ext-enable mcrypt \
 && a2enmod rewrite

RUN composer install \ 
 && chown -R www-data:www-data .  && chmod -R 777 app/storage \
 && composer update
