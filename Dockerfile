FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install

# =========================
# APP USER
# =========================
RUN groupadd --gid 1000 appuser \
    && useradd --uid 1000 -g appuser -G www-data,root --shell /bin/bash --create-home appuser

USER appuser

CMD ["php-fpm"]