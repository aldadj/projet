FROM php:8.3-apache

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Installation des extensions PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Activation de Apache Rewrite (pour Laravel)
RUN a2enmod rewrite

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie du projet
WORKDIR /var/www/html
COPY . .

# Droits sur les dossiers
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configuration du dossier public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Installation des dépendances Laravel
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# Nettoyage manuel des fichiers de cache pour éviter l'erreur Boost
RUN rm -rf bootstrap/cache/*.php
RUN rm -rf storage/framework/cache/data/*
RUN rm -rf storage/framework/views/*.php
RUN rm -rf storage/framework/sessions/*

# Active le module rewrite d'Apache
RUN a2enmod rewrite

# Autorise le .htaccess à surcharger la configuration Apache
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Donne les droits d'écriture à Apache sur la base de données SQLite
RUN chown -R www-data:www-data /var/www/html/database
RUN chmod -R 775 /var/www/html/database

# Création du lien symbolique pour le stockage des images
RUN php artisan storage:link

# Permissions pour le dossier storage
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

EXPOSE 80