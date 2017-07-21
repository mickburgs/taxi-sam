#!/usr/bin/env bash

composer install
npm install
npm install -g bower
bower install
grunt build
php bin/console assets:install

cp ~/domains/servicetaxiflevoland.nl/var/.htaccess ../.htaccess
