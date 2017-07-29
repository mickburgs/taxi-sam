#!/usr/bin/env bash

composer install
php bin/console assets:install

cp ~/domains/servicetaxiflevoland.nl/var/.htaccess ../.htaccess
