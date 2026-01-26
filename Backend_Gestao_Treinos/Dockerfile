# Use imagem oficial do PHP com FPM
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install exif \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install gd \
    && docker-php-ext-install sockets \
    && docker-php-ext-enable opcache

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Criar usuário para segurança (não rodar como root)
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos da aplicação
COPY . .

# Ajustar propriedade dos arquivos
RUN chown -R www:www /var/www/html

# Instalar dependências do Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Ajustar permissões do Laravel (MUITO IMPORTANTE!)
RUN chmod -R 775 storage bootstrap/cache

# Mudar para usuário não-root
USER www

# Expor porta 9000 (padrão do PHP-FPM)
EXPOSE 9000

CMD ["php-fpm"]