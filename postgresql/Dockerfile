FROM postgres:14.1

RUN pg_createcluster 14 main \
    && pg_ctlcluster 14 main start