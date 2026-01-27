FROM php:8.2-apache

# Active mod_rewrite (utile pour les projets PHP)
RUN a2enmod rewrite

# Copie ton code dans le dossier web d’Apache
COPY src/ /var/www/html/

# Donne les bons droits
RUN chown -R www-data:www-data /var/www/html
