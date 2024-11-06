# Usa un'immagine base con PHP e Apache
FROM php:8.0-apache

# Installa estensioni necessarie per Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installa Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia il progetto Laravel nel container
COPY . /var/www/html

# Installa le dipendenze del progetto Laravel
RUN composer install --no-dev --optimize-autoloader

# Fornisci permessi adeguati alle directory necessarie
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Abilita il modulo di Apache "rewrite"
RUN a2enmod rewrite

# Esponi la porta 80 per il traffico HTTP
EXPOSE 80

# Definisci il punto di ingresso per avviare Apache
CMD ["apache2-foreground"]
