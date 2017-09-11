#!/usr/bin/env bash

SYMFONY_ENV=prod composer install --no-dev --optimize-autoloader

./clear_cache_prod.sh

cp ~/domains/servicetaxiflevoland.nl/var/.htaccess ../.htaccess
