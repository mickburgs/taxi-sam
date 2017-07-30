#!/usr/bin/env bash

SYMFONY_ENV=prod composer install --no-dev --optimize-autoloader
php bin/console cache:clear --env=prod --no-warmup
php bin/console cache:warmup --env=prod

php bin/console assets:install --env=prod

cp ~/domains/servicetaxiflevoland.nl/var/.htaccess ../.htaccess
