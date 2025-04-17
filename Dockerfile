
FROM php:8.2-apache
WORKDIR /var/www/html 
 

RUN docker-php-ext-install mysqli pdo pdo_mysql
# instalando extensões php
COPY . .

RUN a2enmod rewrite

COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html
# privilegios de diretorio caso necessario