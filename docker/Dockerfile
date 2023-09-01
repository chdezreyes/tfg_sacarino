FROM php:8.2.1-apache

RUN apt-get update && apt-get install -y nano

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get update && apt-get install -y \
       libfreetype6-dev \
       libjpeg62-turbo-dev \
       libpng-dev \
       libicu-dev \
       libzip-dev \
	   libxml2-dev \
       && a2enmod rewrite \
       && docker-php-ext-install exif \
       && docker-php-ext-install bcmath \
       && docker-php-ext-install intl \
       && docker-php-ext-configure gd --with-freetype --with-jpeg \
       && docker-php-ext-install gd \
       && docker-php-ext-install zip \
	   && docker-php-ext-install dom \
       && chsh -s /bin/bash www-data \
       && rm -rf /var/lib/apt/lists/*
	  
# Set the maximum upload file size
RUN echo "upload_max_filesize = 20M" >> /usr/local/etc/php/php.ini
RUN echo "post_max_size = 20M" >> /usr/local/etc/php/php.ini
	   
# Set the working directory
WORKDIR /var/www/html

# Set the ownership of the project files
RUN chown -R www-data:www-data .