# Gunakan PHP 8.2 CLI sebagai base image
FROM php:8.2-cli

# Update dan instal dependencies yang dibutuhkan
RUN apt-get update && \
    apt-get install -y \
    curl \
    unzip && \
    docker-php-ext-install pdo pdo_mysql

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja dalam kontainer
WORKDIR /var/www/html

# Pastikan semua perintah di atas terselesaikan dan bersih
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Perintah default untuk menjalankan server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
