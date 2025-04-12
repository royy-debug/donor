# Gunakan PHP versi 8.2 CLI image sebagai base image
FROM php:8.2-cli

# Install dependensi yang dibutuhkan oleh Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer (Dependency manager untuk PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory di container Docker
WORKDIR /var/www

# Salin semua file project Laravel ke dalam Docker container
COPY . .

# Set permission untuk folder storage dan cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port 10000 untuk akses Laravel (default port)
EXPOSE 10000

# Jalankan Laravel menggunakan php artisan serve di port 10000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
