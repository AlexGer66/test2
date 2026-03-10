FROM php:8.1-apache

# enable PDO MySQL extension required by the app
RUN docker-php-ext-install pdo_mysql
