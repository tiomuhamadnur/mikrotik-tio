# Menggunakan PHP 8.2 sebagai dasar
FROM php:8.2-fpm

# Install dependencies dan Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nano \
    gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy aplikasi Laravel
COPY . .

# Install dependencies Laravel dan Node.js
RUN composer install --optimize-autoloader --no-dev \
    && npm install \
    && npm run build

# Setel izin untuk direktori storage dan cache
RUN chmod -R 775 storage bootstrap/cache

# Copy .env dan generate app key Laravel
RUN cp .env.example .env \
    && php artisan key:generate

# Perintah default untuk container
CMD ["php-fpm"]
