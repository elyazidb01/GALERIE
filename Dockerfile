# Utiliser l'image PHP officielle
FROM php:8.1-fpm

# Installer les extensions nécessaires pour Laravel
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip pdo pdo_mysql

# Installer Composer (gestionnaire de dépendances PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application Laravel dans le conteneur
COPY . .

# Installer les dépendances PHP de Laravel
RUN composer install

# Exposer le port 8000
EXPOSE 8000

# Démarrer le serveur Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]




FROM mysql:8.0


# Copier un script SQL d'initialisation (optionnel)
COPY init.sql /docker-entrypoint-initdb.d/


# Exposer le port MySQL par défaut
EXPOSE 3306

