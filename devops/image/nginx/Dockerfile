FROM gcr.io/metro-markets-dev/nginx:2.5

ARG SERVER_NAME=localhost

COPY ./config/application.conf /etc/nginx/conf.d/

RUN grep -q 'server_name' /etc/nginx/conf.d/application.conf || sed -i "/listen/a server_name $SERVER_NAME;" /etc/nginx/conf.d/application.conf

# disable http basic auth for dev
RUN sed -i -e "s#include /etc/nginx/custom.d/restrictions.inc;# #g" /etc/nginx/conf.d/application.conf
