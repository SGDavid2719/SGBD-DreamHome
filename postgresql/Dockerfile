FROM postgres:14.1

ENV SOLR_VERSION 5.3.0
ENV SOLR solr-$SOLR_VERSION
ENV SOLR_USER solr
# Init cluster
RUN pg_createcluster 14 main \
    && pg_ctlcluster 14 main start