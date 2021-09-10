FROM php:7.3.6-fpm
ARG TZ
ARG BLOG_SPA_API_APP_ROOT_DIR

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    curl \
    libicu-dev \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    libxml2-dev \
    libbz2-dev \
    libjpeg62-turbo-dev \
    openssl \
    curl \
    git \
    unzip \
    gcc \
    autoconf \
    wget \
    libzip-dev \
    subversion \
    && rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql \
    && docker-php-ext-configure pdo_pgsql --with-pgsql \
    && docker-php-ext-configure mbstring --enable-mbstring \
    && docker-php-ext-configure soap --enable-soap \
    && docker-php-ext-install \
        bcmath \
        intl \
        mbstring \
        mysqli \
        pcntl \
        pdo_mysql \
        pdo_pgsql \
        soap \
        sockets \
        zip \
    && docker-php-ext-configure gd \
        --enable-gd-native-ttf \
        --with-jpeg-dir=/usr/lib \
        --with-freetype-dir=/usr/include/freetype2 && \
        docker-php-ext-install gd \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable opcache


##
## Configure locale to en_US.UTF-8
##
RUN apt-get update && \
    apt-get install -y locales && \
    sed -i 's/^# *\(en_US.UTF-8\)/\1/' /etc/locale.gen && \
    locale-gen && \
    echo "export LC_ALL=en_US.UTF-8" >> ~/.bashrc && \
    echo "export LANG=en_US.UTF-8" >> ~/.bashrc && \
    echo "export LANGUAGE=en_US.UTF-8" >> ~/.bashrc


## Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version


## Set timezone
RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TZ} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"


## Update Memory limit
RUN echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;


##
## Install PHPUnit & phpcov
##
RUN wget -O phpunit https://phar.phpunit.de/phpunit-8.phar && chmod +x phpunit && ./phpunit --version
RUN wget https://phar.phpunit.de/phpcov.phar && chmod +x phpcov.phar && mv phpcov.phar /usr/local/bin/phpcov


WORKDIR ${BLOG_SPA_API_APP_ROOT_DIR}