# Usar uma imagem oficial do PHP com extensão FPM
FROM php:8.2-fpm

# Definir o diretório de trabalho dentro do container
WORKDIR /var/www/html

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensões do PHP necessárias
RUN docker-php-ext-install zip

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar o arquivo composer.lock e composer.json para o diretório de trabalho
COPY composer.json composer.lock ./

# Copiar todo o projeto para o diretório de trabalho
COPY . .

# Expor a porta 8000 para acesso ao servidor Laravel
EXPOSE 8000

# Comando CMD para rodar o Composer e o servidor Laravel conforme indicado
CMD composer install && php artisan serve --host=0.0.0.0
