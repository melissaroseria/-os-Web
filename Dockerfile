FROM php:8.2-apache

# Gerekli PHP eklentileri
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Apache mod_rewrite aç
RUN a2enmod rewrite

# Apache'nin .htaccess'e izin vermesi için
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Proje dosyalarını kopyala
COPY . /var/www/html/

# Yazılabilir klasörlere izin ver (log, upload, notlar vs.)
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && chmod -R 777 /var/www/html/app/run/gallery/uploads \
    && chmod -R 777 /var/www/html/app/run/notes/notes_data \
    && chmod -R 777 /var/www/html/app/run/notes/notes_imgs \
    && chmod -R 777 /var/www/html/app/run/notes/uploads \
    && chmod -R 777 /var/www/html/app/run/post/settings/logs \
    && chmod -R 777 /var/www/html/app/charts/logs/logs \
    && chmod -R 777 /var/www/html/src

# pass.txt yoksa oluştur
RUN test -f /var/www/html/src/pass.txt || echo "1234" > /var/www/html/src/pass.txt

# PHP ayarları — dosya yükleme limiti
RUN echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 60" >> /usr/local/etc/php/conf.d/uploads.ini

EXPOSE 80
