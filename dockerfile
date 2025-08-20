# Use uma imagem base oficial do PHP com Apache
FROM php:8.2-apache

# Instale as dependências do sistema necessárias para as extensões
# libpq-dev é para o PostgreSQL
# libicu-dev é para a extensão intl
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Agora, com as dependências instaladas, podemos instalar as extensões do PHP
RUN docker-php-ext-install pdo pdo_pgsql pgsql intl

# Habilite o mod_rewrite do Apache para URLs amigáveis do CodeIgniter
RUN a2enmod rewrite

# Copia o arquivo de configuração customizado do Apache para a imagem
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copie os arquivos da sua aplicação para o diretório do servidor web no contêiner
COPY . /var/www/html/

# Defina o dono e as permissões corretas para a pasta 'writable' do CodeIgniter
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 777 /var/www/html/writable

# Expõe a porta 80, que é a porta padrão do Apache
EXPOSE 80
