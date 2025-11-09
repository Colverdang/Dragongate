FROM php:8.2-apache

# Enable common PHP extensions (optional)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy your app into the container
COPY . /var/www/html/

# Expose port 80 to access it from browser
EXPOSE 8000
