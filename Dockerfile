# Use PHP 8.2
FROM php:8.2-cli

# 1. Install system dependencies (git, zip, unzip, and database drivers)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev

# 2. Clear cache to keep image small
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

# 4. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy your application code
COPY . .

# 7. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 8. Make sure the start script is executable
RUN chmod +x start.sh

# 9. Start the app
CMD ["./start.sh"]