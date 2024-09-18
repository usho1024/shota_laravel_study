FROM amazonlinux:2023

# 必要なパッケージのインストール
RUN dnf update \
    && dnf install -y nginx php8.2-fpm php8.2 php8.2-pdo php8.2-mysqlnd git \
    php8.2-zip php8.2-mbstring unzip \
    && dnf clean all

# DNFではsupervisorをインストールできなかったのでpip経由でインストール
RUN dnf install -y python3-pip \
    && pip3 install supervisor

# supervisor, nginxの設定ファイルをコンテナにコピー・ソケットファイルを保存するためのディレクトリを作成
COPY ./supervisord.conf /etc/supervisor/conf.d/
COPY ./nginx.conf /etc/nginx/conf.d/
RUN mkdir /run/php-fpm

# Composerのインストール（1つのRUNステップにまとめる）
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

RUN php --ini

WORKDIR /var/www/html

# supervisorを起動する
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]