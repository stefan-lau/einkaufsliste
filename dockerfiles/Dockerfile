# syntax=docker/dockerfile:1
FROM php:8.3-apache
WORKDIR /root
RUN rm /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/# //g' /etc/apt/sources.list.d/debian.sources && apt update
RUN apt install git -y && apt install sudo -y && apt install zip unzip -y
RUN git clone https://github.com/sw-ffm/einkaufsliste.git /var/www/html/. && chown -R www-data:www-data /var/www/html
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && mv composer.phar /usr/local/bin/composer && rm composer-setup.php
RUN apt install nodejs -y && apt install npm -y
WORKDIR /var/www/html
RUN cp dockerfiles/apache-conf/000-default.conf /etc/apache2/sites-available
RUN service apache2 restart
RUN sudo -u www-data composer install
RUN sudo -u www-data npm install
RUN sudo -u www-data npm run build
RUN sudo -u www-data cp .env.example .env
RUN sudo -u www-data php artisan key:generate
RUN sudo -u www-data touch database/database.sqlite
RUN sudo -u www-data php artisan migrate
EXPOSE 80
