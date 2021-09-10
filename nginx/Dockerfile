FROM nginx:latest

#
# certbot-auto
#
RUN apt-get update && \
    apt-get install -y vim cron sudo rsyslog certbot python3-certbot-nginx

COPY conf/ /
