FROM php:8.3-apache

# Install necessary dependencies
RUN apt-get update -y && apt-get install -y openssl zip unzip git libonig-dev nodejs npm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install pdo mbstring pdo_mysql

# Set the working directory
WORKDIR /app

# Copy your application files
COPY . /app

# Install Composer dependencies
RUN composer install

# Expose port
EXPOSE 8181
# EXPOSE 5173

# Define the command to run your PHP application
CMD php artisan serve --host=0.0.0.0 --port=8181
