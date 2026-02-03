# Use PHP 8.2
FROM php:8.2-cli

# 1. Install system dependencies (drivers for the database)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Get Composer (to install PHP packages)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Set the working directory
WORKDIR /var/www/html

# 4. Copy your application code
COPY . .

# 5. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 6. Make sure the start script is executable
RUN chmod +x start.sh

# 7. Start the app using your script
CMD ["./start.sh"]