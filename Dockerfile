FROM php:8.2-apache

# Instala mysqli
RUN docker-php-ext-install mysqli

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Permissões corretas
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Ativa mod_rewrite (se precisar de URLs amigáveis)
RUN a2enmod rewrite

EXPOSE 80
