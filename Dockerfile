# Use PHP 7.4 CLI with Alpine
FROM php:7.4-cli-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    zip \
    curl \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app code
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage
RUN chown -R 1000:1000 /var/www/html/storage \
    && chmod -R 755 /var/www/html/storage

# Entrypoint
COPY docker/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Start Lumen built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
