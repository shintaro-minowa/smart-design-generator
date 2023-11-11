# 使用する基本イメージを指定
FROM php:8-fpm

# 必要なパッケージのインストール。zip、unzip、gitを含めます
RUN apt-get update && \
    apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git && \
    docker-php-ext-install pdo pdo_pgsql

# 作業ディレクトリを指定
WORKDIR /var/www

# Composerをコピー
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Composerのglobal installにPATHを設定
ENV PATH $PATH:/root/composer/vendor/bin

# PHPのiniファイルをカスタマイズ（必要に応じて）
# COPY ./php.ini /usr/local/etc/php/conf.d/custom.ini
