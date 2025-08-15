# Usa imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instala extensões do PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Ativa o mod_rewrite do Apache (importante para frameworks)
RUN a2enmod rewrite

# Copia arquivo de configuração customizado
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Define permissões
RUN chown -R www-data:www-data /var/www/html

