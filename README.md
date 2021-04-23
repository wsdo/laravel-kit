## 环境准备
```
https://getcomposer.org/download/
```

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

## 环境设置
```
cp .env.example .env
```
## 安装依赖包
```
composer install
```

## 开发
```
php artisan serve
```  
## 生产环境
```
修改run.sh dns 解析成prod 数据库地址
```

## 集成

* 路由组 V1
* 配置
* Docker
* jwt token验证
* 统一配置跨域：EnableCrossRequestMiddleware
