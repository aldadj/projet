FROM richarvey/php-apache-heroku:latest

# Copie le projet
COPY . /var/www/html

# Définit le dossier public de Laravel comme racine Web
ENV WEBROOT /var/www/html/public
ENV APP_ENV production

# Installation des dépendances
RUN composer install --no-dev --optimize-autoloader

# Droits sur les dossiers storage
RUN chmod -R 777 /var/www/html/storage