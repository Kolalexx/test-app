FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    zlib1g-dev \
    unzip \
    git \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip \
    pcntl \
    intl \
    && pecl install redis \
    && docker-php-ext-enable redis

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs
    && npm install -g npm


WORKDIR /app

COPY . .
RUN composer install --ignore-platform-reqs
RUN npm ci
RUN npm run build

CMD ["bash", "-c", "php artisan migrate --force --seed && php artisan serve --host=0.0.0.0 --port=$PORT"]
