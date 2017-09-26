#!/usr/bin/env bash

composer install
npm install
npm install -g bower
bower install
grunt build
./resources/clear_cache_dev.sh
php bin/console server:run
