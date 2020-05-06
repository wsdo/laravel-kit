#!/bin/bash

echo 192.168.22.126 rm-2ze03u1v79619rwt5515.mysql.rds.aliyuncs.com >> /etc/hosts
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ && \
composer install --ignore-platform-reqs && \
composer clear && \
chown www-data:www-data -R /var/www/html && \
chmod 777 -R /var/www/html/storage/logs
php-fpm -c /etc/php/7.4/fpm/php-fpm.conf
nginx -c /etc/nginx/nginx.conf -g 'daemon off;'