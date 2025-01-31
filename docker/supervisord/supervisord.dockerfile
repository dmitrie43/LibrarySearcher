FROM library-searcher-app

USER root

RUN mkdir -p /etc/supervisord/conf.d \
    && mkdir /var/log/supervisord

RUN apt-get update && apt-get install -y \
    supervisor \
    cron

COPY supervisord.conf /etc/supervisord/
COPY laravel-queue-workers.conf /etc/supervisord/conf.d/

COPY cron /etc/cron.d/cron
RUN chmod 0777 /etc/cron.d/cron \
    && crontab /etc/cron.d/cron

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord/supervisord.conf"]
