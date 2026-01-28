FROM php:8.2-apache

# 1. Installer les libs et nettoyer les conflits MPM (LE FIX EST ICI)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip \
    && a2dismod mpm_event && a2enmod mpm_prefork

# 2. Activer le mod_rewrite
RUN a2enmod rewrite

# 3. Copier le projet
COPY . /var/www/html

# 4. Configurer le dossier public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 5. Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Installation des dépendances
RUN composer install --no-dev --optimize-autoloader

# 7. Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Le Port standard
EXPOSE 80