FROM registry.cn-beijing.aliyuncs.com/ubuntu-php/php7.4:v3
COPY ./nginx/conf.d /etc/nginx/conf.d
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./run.sh /root/run.sh
COPY ./ /var/www/html/
WORKDIR /var/www/html
EXPOSE 80
ENTRYPOINT [ "bash","/root/run.sh" ]
