FROM php:7.4-apache

COPY api/ /var/www/html/
COPY .htaccess /var/www/html/
RUN docker-php-ext-install mysqli pdo pdo_mysql
EXPOSE 80
