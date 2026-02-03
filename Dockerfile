# Use PHP 8.3
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

# 7. Install dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 8. GENERATE THE START SCRIPT (Fixes "File not found" error)
# We write the script content directly into the container
RUN printf "#!/bin/bash\n\
set -e\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan migrate:fresh --force\n\
php artisan serve --host=0.0.0.0 --port=\$PORT" > start.sh

# 9. Make it executable
RUN chmod +x start.sh

# 10. Start the app
CMD ["./start.sh"]