FROM php:8.2-apache

# Active mod_rewrite
RUN a2enmod rewrite

# Installe les extensions MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli


# Droits
RUN chown -R www-data:www-data /var/www/html