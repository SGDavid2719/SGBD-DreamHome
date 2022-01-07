FROM php:8.0-apache

ENV SOLR_VERSION 5.3.0
ENV SOLR solr-$SOLR_VERSION
ENV SOLR_USER solr
# Install PDO and PGSQL Drivers
RUN apt-get update
RUN apt-get install -y libpq-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install pdo pdo_pgsql pgsql