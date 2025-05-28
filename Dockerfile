FROM php:8.2-apache

# Copia o código do seu projeto para dentro do contêiner
COPY . /var/www/html/

# Ajusta permissões (opcional, dependendo do seu projeto)
RUN chown -R www-data:www-data /var/www/html