#!/bin/bash

PWD=$(cd $(dirname $0) && pwd)

# Create Network
COUNT_DOCKER_NETWORK="$(docker network ls -f name=tq-twitter -q | wc -l | sed 's/^[ \t]*//')"
if [ $COUNT_DOCKER_NETWORK != "1" ]; then
    docker network create tq-twitter
fi

# Install node_modules
directory="$PWD/node_modules"
if [ -z "$(ls $directory)" ]; then
    $PWD/yarn.sh install
fi

# Install Vendor
if [ ! -d "$PWD/src/vendor" ]; then
    $PWD/composer.sh --ignore-platform-reqs install
fi

docker-compose -p tq-twitter -f $PWD/.local/docker-compose-local/docker-compose.yml $@