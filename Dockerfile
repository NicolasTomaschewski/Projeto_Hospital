FROM php:8.2-apache

# Instala extensões necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ativa mod_rewrite
RUN a2enmod rewrite

# Copia configuração personalizada do Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Copia os arquivos do projeto
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
