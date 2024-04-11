# Use a imagem oficial do PHP com a versão 8.2
FROM php:8.2

# Defina variável de ambiente para permitir a execução de plugins como root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Atualize o sistema e instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instale os drivers PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho como o diretório do aplicativo
WORKDIR /var/www/html

# Copie todos os arquivos do aplicativo para o contêiner primeiro
COPY . .

# Limpe o diretório vendor para remover quaisquer mudanças não confirmadas
RUN rm -rf vendor

# Execute o composer update para atualizar as dependências do PHP
RUN composer update

# Exponha a porta 8000 para o servidor web interno do Laravel
EXPOSE 8000

# Comando para iniciar o servidor PHP embutido usando o Artisan
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
