# Utiliser une image de base PHP avec Apache
FROM php:8.2-apache

# Installer les dépendances système, Node.js, npm, Composer, etc.
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    nodejs \
    npm \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances Composer
RUN composer install --no-dev --optimize-autoloader

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port 80
EXPOSE 80

# Modifier DocumentRoot d'Apache vers /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
 && echo '<Directory /var/www/html/public>\n\tOptions Indexes FollowSymLinks\n\tAllowOverride All\n\tRequire all granted\n</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite
