FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update && \
    apt-get install -y libxml2-dev


RUN apt-get update \
    && apt-get -y --no-install-recommends install php8.2-mysql \
    && apt-get -y --no-install-recommends install php8.2-intl \
    && apt-get install -y mysql-client \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
	# Install Composer
    && curl \
        --location \
        --silent \
        --show-error \
        https://github.com/composer/composer/releases/download/2.5.5/composer.phar \
        > \
        /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer
