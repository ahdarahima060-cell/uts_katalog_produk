FROM php:8.2-apache

# Install ekstensi PDO dan MySQL sesuai soal
RUN docker-php-ext-install pdo pdo_mysql

# Aktifkan mod_rewrite (opsional, standar apache)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html