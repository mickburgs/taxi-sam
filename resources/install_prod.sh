#!/usr/bin/env bash

composer install
grunt init
grunt build
php bin/console assets:install

cp ~/domains/servicetaxiflevoland.nl/var/.htaccess ../.htaccess
