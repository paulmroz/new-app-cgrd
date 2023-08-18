FROM php:8.1-apache
RUN a2enmod rewrite
RUN echo "<Directory /var/www/html>\n    AllowOverride All\n</Directory>" >> /etc/apache2/apache2.conf
COPY . /var/www/html/
COPY .htaccess /var/www/html/
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get upgrade -y