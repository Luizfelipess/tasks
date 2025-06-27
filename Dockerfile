# Usa imagem oficial PHP com FPM, Alpine para leveza
FROM php:8.4-fpm-alpine

# Instala extensões necessárias e pacotes do sistema
RUN apk update && apk upgrade \
    && apk add --no-cache bash \
    && apk add -U ca-certificates \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    tzdata \
    php84-pear \
    nodejs \
    npm \
    && cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime \
    && apk del tzdata

# Instala o facilitador de instalação de extensões PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Define permissões para o script do Composer
RUN chmod +x /usr/local/bin/install-php-extensions

# Instala o Composer
RUN install-php-extensions \
    @composer \
    intl \
    pdo_mysql \
    pcntl \
    redis

# Cria usuário não-root para segurança
RUN adduser -u 1000 -D -s /bin/sh laravel

# Define diretório de trabalho
WORKDIR /var/www

# Copia arquivos da aplicação
COPY backend/ /var/www/

# Dá permissões para o diretório de storage e bootstrap/cache
RUN chown -R laravel:laravel storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Troca para o usuário não-root
USER laravel

# Expõe porta web da aplicação
EXPOSE 8000

CMD ["composer", "run", "dev"]
