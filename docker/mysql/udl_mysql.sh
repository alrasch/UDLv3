#!/bin/bash

docker stop udldb
docker rm udldb
docker run -it \
           -e MYSQL_ROOT_PASSWORD=udl \
           -v $HOME/Dev/UDLv3/docker/mysql/devdb:/docker-entrypoint-initdb.d \
           --name udldb \
           udldb
