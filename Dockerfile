FROM php:7.4-apache

# RUN apt-get update 
# RUN apt-get upgrade 
# RUN apt-get install -y --fix-missing \
#     apt-utils \
#     zlib1g-dev \
#     libzip-dev \
#     nodejs \
#     git

# Node.js
RUN curl -sL https://deb.nodesource.com/setup_13.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install nodejs -y
RUN node -v
RUN npm -v
COPY . /var/www/html
WORKDIR /var/www/html
RUN rm -rf node_modules
RUN ls
RUN npm install
RUN npm run prod


# RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && composer global require hirak/prestissimo --no-plugins --no-scripts
# RUN docker-php-ext-install exif
# RUN docker-php-ext-install pcntl
# RUN docker-php-ext-install bcmath
# RUN docker-php-ext-install zip
# # RUN docker-php-ext-install mbstring
# RUN docker-php-ext-install pdo_mysql
# RUN docker-php-ext-install pdo
# RUN docker-php-ext-install json


# # Apache
# ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
# RUN a2enmod rewrite
# RUN service apache2 restart


# RUN composer install
# ENTRYPOINT [ "php", "artisan", "serve" ]