# Usa un'immagine base con PHP e Apache
FROM php:8.0-apache

# Installa estensioni necessarie per Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Installa Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Imposta la directory di lavoro
WORKDIR /var/www/html

# Copia il progetto Laravel nel container
COPY . /var/www/html

# Crea dinamicamente il file .env utilizzando le variabili di ambiente di Render
RUN echo "APP_ENV=production" > /var/www/html/.env && \
    echo "APP_KEY=${APP_KEY}" >> /var/www/html/.env && \
    echo "DB_CONNECTION=mysql" >> /var/www/html/.env && \
    echo "DB_HOST=${DB_HOST}" >> /var/www/html/.env && \
    echo "DB_PORT=${DB_PORT}" >> /var/www/html/.env && \
    echo "DB_DATABASE=${DB_DATABASE}" >> /var/www/html/.env && \
    echo "DB_USERNAME=${DB_USERNAME}" >> /var/www/html/.env && \
    echo "DB_PASSWORD=${DB_PASSWORD}" >> /var/www/html/.env

# Fornisci permessi adeguati alle directory necessarie prima di installare Composer
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

# Installa le dipendenze del progetto Laravel
RUN composer install --no-dev --optimize-autoloader --no-scripts || true

# Fornisci permessi adeguati alle directory di cache e storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Genera la chiave dell'applicazione Laravel
RUN php artisan key:generate || true

# Abilita il modulo di Apache "rewrite"
RUN a2enmod rewrite

# Esponi la porta 80 per il traffico HTTP
EXPOSE 80

# Definisci il punto di ingresso per avviare Apache
CMD ["apache2-foreground"]
