FROM php:8.2-apache

# Instalar as dependências necessárias
RUN apt-get update && apt-get install -y git unzip libpq-dev libcurl4-openssl-dev zip \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite do Apache para URLs amigáveis
RUN a2enmod rewrite

# Alterar o DocumentRoot para a pasta 'public'
RUN sed -i 's|/var/www/html|/var/www/html/web/public|g' /etc/apache2/sites-available/000-default.conf

# Definir DirectoryIndex
RUN echo 'DirectoryIndex index.php index.html' >> /etc/apache2/apache2.conf

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar os arquivos do projeto para dentro do contêiner
WORKDIR /var/www/html
COPY . .

# Rodar o Composer para instalar as dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Expor a porta 80 (padrão do Apache)
EXPOSE 80

# Comando para iniciar o Apache
CMD ["apache2-foreground"]
