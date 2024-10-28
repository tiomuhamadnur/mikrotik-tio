# Gunakan PHP 8.2 CLI sebagai base image
FROM php:8.2-cli

# Update dan instal dependencies yang dibutuhkan
RUN apt-get update && \
    apt-get install -y \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql gd

# Instal Node.js dan npm (gunakan versi 16 atau sesuaikan dengan kebutuhan)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja dalam kontainer
WORKDIR /var/www/html

# Pastikan semua perintah di atas terselesaikan dan bersih
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Default command yang bisa di override di docker-compose.yaml
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
