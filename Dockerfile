# Upgrade to PHP 8.3 to match modern Laravel defaults
FROM php:8.3-cli

# 1. Install system dependencies
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

# 2. Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

# 4. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy application code
COPY . .

# 7. Install dependencies (With flags to ignore version errors)
# We use --ignore-platform-reqs to prevent "PHP version" errors
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 8. Permission Fix
RUN chmod +x start.sh

# 9. Start
CMD ["./start.sh"]