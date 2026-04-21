FROM php:7-apache as silverstripe
LABEL maintainer="SilverStripe Cloud <dev@silverstripecloud.com>"
RUN echo "ServerName localhost" > /etc/apache2/conf-available/fqdn.conf \
    && echo "date.timezone = Europe/Berlin" > /usr/local/etc/php/conf.d/timezone.ini \
    && a2enmod \
        rewrite \
        expires \
        remoteip \
        cgid \
    && apt-get update -y \
    && apt-get install -y --no-install-recommends \
        autoconf \
        libpng-dev \
        libxslt-dev \
        make \
        imagemagick-common \
        libgd-dev \
        libicu-dev \
        libmagickwand-dev \
        libtidy-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-configure gd --with-libdir=/usr/include/ --enable-gd --with-jpeg --with-freetype \
    && pecl channel-update pecl.php.net \
    && pecl install imagick \
    && docker-php-ext-install \
        intl \
        gd \
        mysqli \
        pdo \
        pdo_mysql \
        soap \
        tidy \
        xsl \
    && docker-php-ext-enable imagick \
    && apt-get purge -y \
        autoconf \
        libpng-dev \
        libxslt-dev \
        make \
        imagemagick-common \
        libgd-dev \
        libicu-dev \
        libmagickwand-dev \
        libtidy-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update -y \
    && apt-get install -y --no-install-recommends \
        build-essential

RUN apt-get update -y \
    && apt-get install -y --no-install-recommends \
        bash \
        coreutils \
        git \
        make \
        mercurial \
        openssh-client \
        patch \
        subversion \
        tini \
        unzip \
        zip

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp
ENV COMPOSER_INSTALLER_URL https://raw.githubusercontent.com/composer/getcomposer.org/cb19f2aa3aeaa2006c0cd69a7ef011eb31463067/web/installer
ENV COMPOSER_INSTALLER_HASH 48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5

RUN printf "# composer php cli ini settings\n\
date.timezone=UTC\n\
memory_limit=-1\n\
" > $PHP_INI_DIR/php.ini \
    && curl --silent --fail --location --retry 3 --output /tmp/installer.php --url ${COMPOSER_INSTALLER_URL} \
    && php -r " \
        \$signature = '${COMPOSER_INSTALLER_HASH}'; \
        \$hash = hash('sha384', file_get_contents('/tmp/installer.php')); \
        if (!hash_equals(\$signature, \$hash)) { \
          unlink('/tmp/installer.php'); \
          echo 'Integrity check failed, installer is either corrupt or worse.' . PHP_EOL; \
          exit(1); \
        }" \
    && php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer \
    && composer --ansi --version --no-interaction \
    && rm -f /tmp/installer.php \
    && find /tmp -type d -exec chmod -v 1777 {} +

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer config --no-plugins allow-plugins.composer/installers true
RUN composer config --no-plugins allow-plugins.silverstripe/recipe-plugin true
RUN composer config --no-plugins allow-plugins.silverstripe/vendor-plugin true
#RUN composer require --with-all-dependencies \
#        silverstripe/recipe-core:^4.5

CMD ["composer"]