#!/usr/bin/env bash

cp ~/domains/servicetaxiflevoland.nl/var/.htaccess ../.htaccess

SYMFONY_ENV=prod composer install --no-dev --optimize-autoloader

./resources/clear_cache_prod.sh

