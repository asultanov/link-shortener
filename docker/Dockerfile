FROM php:apache

# Устанавливаем расширение PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Активируем модуль mod_rewrite
RUN a2enmod rewrite

# Копируем наш конфигурационный файл Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf