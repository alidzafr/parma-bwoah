# Use official PHP image with required extensions
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl zip unzip git libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install dependencies
RUN composer install

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Link Image dir into storage
RUN php artisan storage:link || true

# Expose port
EXPOSE 9000

CMD ["php-fpm"]
