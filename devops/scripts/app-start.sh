#!/bin/bash

NAME_PREFIX="$1"

NETWORK=$(docker network ls --format="{{.Name}}" -f name=sarah-connor-network | grep sarah-connor-network$)

if [[ -z ${NETWORK} ]]
then
    # create project network
    docker network create sarah-connor-network
fi

# ensure that old containers are removed
docker-compose -p $NAME_PREFIX stop
docker-compose -p $NAME_PREFIX rm -f

# start application
docker-compose -p $NAME_PREFIX build --pull
docker-compose -p $NAME_PREFIX up -d --force-recreate

# up application
$WINPTY docker-compose -p $NAME_PREFIX $COMPOSE_FILES exec php-fpm sh -c "cd /var/www; composer info"
