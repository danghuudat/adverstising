FROM ubuntu:latest

RUN export LANG=en_US.UTF-8 \
  && apt-get update \
  && apt-get -y install apache2

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
RUN ln -sf /dev/stdout /var/log/apache2/access.log && \
    ln -sf /dev/stderr /var/log/apache2/error.log
RUN mkdir -p $APACHE_RUN_DIR $APACHE_LOCK_DIR $APACHE_LOG_DIR

RUN apt-get -y install libapache2-mod-php7.4 php7.4 php7.4-cli php-xdebug php7.4-mbstring \
  sqlite3 php7.4-mysql php-imagick php-memcached php-pear curl imagemagick php7.4-dev \
  php7.4-phpdbg php7.4-gd npm nodejs-legacy php7.4-json php7.4-curl php7.4-sqlite3 php7.4-intl \
  apache2 vim git-core wget libsasl2-dev libssl-dev libsslcommon2-dev libcurl4-openssl-dev \
  autoconf g++ make openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev \
  && a2enmod headers \
  && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN curl -sL https://deb.nodesource.com/setup_7.x | bash -
RUN apt-get update && apt-get install git

VOLUME [ "/var/www/html" ]
WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT [ "/usr/sbin/apache2" ]
CMD ["-D", "FOREGROUND"]
